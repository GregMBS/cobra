<?php

namespace App;

use Exception;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CargaClass
 *
 * @author gmbs
 */
class CargaClass extends BaseClass {

    /**
     *
     * @var array
     */
    private $internal = array(
        'id_cuenta',
        'especial',
        'fecha_de_actualizacion',
        'locker',
        'timelock'
    );

    /**
     * 
     * @return string
     */
    protected function moveLoadedFile() {
        $deststr = "/tmp/" . $_FILES['file']['name'];
        move_uploaded_file($_FILES["file"]["tmp_name"], $deststr);
        return $deststr;
    }

    /**
     * 
     * @param string $filename
     * @param boolean $header
     * @return array
     */
    protected function getCsvData($filename, $header) {
        $handle = fopen($filename, "r");
        if ($header) {
            $data = fgetcsv($handle, 0, ",");
        } else {
            $data = array();
            while ($row = fgetcsv($handle)) {
                $data[] = $row;
            }
        }

        fclose($handle);
        return $data;
    }

    /**
     * 
     * @param array $row
     * @return array
     */
    protected function getDataColumnNames($row) {
        $columnArray = array();
        foreach ($row as $columnName) {
            $cn = $columnName;
            if ($columnName == '') {
                $cn = 'vacio';
            }
            if (in_array($cn, $this->internal)) {
                $cn = $columnName . '_solo_internal';
            }
            $columnArray[] = $cn;
        }
        return $columnArray;
    }

    /**
     * 
     * @return array
     */
    protected function getDBColumnNames() {
        $columnArray = array();
        $query = "SHOW COLUMNS FROM resumen";
        $result = $this->pdo->query($query);
        foreach ($result as $row) {
            $columnArray[] = $row['Field'];
        }
        return $columnArray;
    }

    /**
     * 
     * @param array $datanames
     * @param array $dbnames
     * @return array
     */
    protected function nameCheck($datanames, $dbnames) {
        $oops = array();
        foreach ($datanames as $name) {
            $match = in_array($name, $dbnames);
            if (!$match) {
                $oops[] = $name;
            }
        }
        return $oops;
    }

    /**
     * 
     * @param array $columnNames
     */
    protected function prepareTemp($columnNames) {
        $querydrop = "DROP TABLE IF EXISTS temp";
        try {
            $this->pdo->query($querydrop);
        } catch (\PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
        $querystart = "CREATE TABLE temp "
                . "ENGINE=INNODB AUTO_INCREMENT=10 "
                . "DEFAULT CHARSET=utf8 "
                . "COLLATE=utf8_spanish_ci "
                . "SELECT "
                . implode(',', $columnNames)
                . " FROM resumen LIMIT 0";
        try {
            $this->pdo->query($querystart);
        } catch (\PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
        $queryindex = "ALTER TABLE temp ADD INDEX nc(numero_de_cuenta(50), cliente(50))";
        try {
            $this->pdo->query($queryindex);
        } catch (\PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
    }

    /**
     * 
     * @param string $filename
     * @param string $columnNames
     */
    protected function loadData($filename, $columnNames) {
        $data = $this->getCsvData($filename, false);
        $count = 0;
        $queryload = "INSERT INTO temp (" . implode(",", $columnNames) . ") VALUES ";
        foreach ($data as $row) {
            if ($count > 0) {
                $limpio = str_replace("'", "", $row);
                $queryload .= "('" . implode("','", $limpio) . "'),";
            }
            $count++;
        }
        $queryloadtrim = rtrim($queryload, ",");
        try {
            $this->pdo->query($queryloadtrim);
        } catch (\PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
    }

    /**
     * 
     * @param array $columnNames
     * @return array
     */
    protected function prepareUpdate($columnNames) {
        $output = array();
        foreach ($columnNames as $name) {
            $output[] = 'resumen.' . $name . '=temp.' . $name;
        }
        return $output;
    }

    /**
     * 
     * @param array $fieldlist
     */
    protected function updateResumen($fieldlist) {
        $fields = implode(',', $fieldlist);
        $queryupd = "UPDATE temp, resumen
            SET " . $fields . " 
            where temp.numero_de_cuenta=resumen.numero_de_cuenta";
        try {
            $this->pdo->query($queryupd);
        } catch (\PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
    }

    /**
     * 
     * @param array $fieldlist
     */
    protected function insertIntoResumen($fieldlist) {
        $fields = implode(',', $fieldlist);
        $queryins = "insert ignore into resumen (" . $fields . ") select " . $fields . " from temp";

        try {
            $this->pdo->query($queryins);
        } catch (\PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
    }

    /**
     * 
     */
    protected function updateClientes() {

        $query = "INSERT IGNORE INTO clientes "
                . "SELECT cliente FROM resumen";
        $this->pdo->query($query);
    }

    /**
     * 
     */
    protected function updatePagos() {
        $querypagoins = "insert ignore into pagos (cuenta,fecha,monto,cliente,gestor,confirmado,id_cuenta)
select numero_de_cuenta, fecha_de_ultimo_pago, 
monto_ultimo_pago, cliente, c_cvge, 1, id_cuenta 
from resumen 
left join historia h1 on c_cont=id_cuenta and n_prom>0
where fecha_de_ultimo_pago>last_day(curdate() - INTERVAL 31 day) 
AND monto_ultimo_pago>0 
and not exists (select * from historia h2 
where h2.d_fech>h1.d_fech and h2.c_cont=h1.c_cont and h2.n_prom>0) 
and fecha_de_ultimo_pago<fecha_de_actualizacion 
group by id_cuenta,c_cvge having fecha_de_ultimo_pago>min(d_fech)
";
        $this->pdo->query($querypagoins);
    }

}
