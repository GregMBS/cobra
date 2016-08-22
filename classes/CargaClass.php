<?php

use Box\Spout\Reader;
use Box\Spout\Common\Type;

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
class CargaClass {

    /**
     *
     * @var PDO
     */
    private $pdo;

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

    private function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param boolean $result
     * @param string $query
     */
    private function dbErrorCheck($result, $query) {
        if (!$result) {
            print_r($this->pdo->errorInfo());
            die(htmlentities($query));
        }        
    }
    
    /**
     * 
     * @return string
     */
    private function moveLoadedFile() {
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
    private function getCsvData($filename, $header) {
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
    private function getDataColumnNames($row) {
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
    private function getDBColumnNames() {
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
    private function nameCheck($datanames, $dbnames) {
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
    private function prepareTemp($columnNames) {
        $querydrop = "DROP TABLE IF EXISTS temp;";
        $resultdrop = $this->pdo->query($querydrop);
        $this->dbErrorCheck($resultdrop, $querydrop);
        $querystart = "CREATE TABLE temp "
                . "ENGINE=INNODB AUTO_INCREMENT=10 "
                . "DEFAULT CHARSET=utf8 "
                . "COLLATE=utf8_spanish_ci "
                . "SELECT "
                . implode(',', $columnNames)
                . " FROM resumen LIMIT 0";
        $resultstart = $this->pdo->query($querystart);
        $this->dbErrorCheck($resultstart, $querystart);
        $queryindex = "ALTER TABLE temp ADD INDEX nc(numero_de_cuenta(50), cliente(50));";
        $resultindex = $this->pdo->query($queryindex);
        $this->dbErrorCheck($resultindex, $queryindex);
    }

    /**
     * 
     * @param string $filename
     * @param string $columnNames
     */
    private function loadData($filename, $columnNames) {
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
        $ok = $this->pdo->query($queryloadtrim);
        $this->dbErrorCheck($ok, $queryloadtrim);
    }

    /**
     * 
     * @param array $columnNames
     * @return array
     */
    private function prepareUpdate($columnNames) {
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
    private function updateResumen($fieldlist) {
        $fl = implode(',', $fieldlist);
        $queryupd = "UPDATE temp, resumen
            SET " . $fl . " 
            where temp.numero_de_cuenta=resumen.numero_de_cuenta
            and temp.cliente=resumen.cliente";
        $ok = $this->pdo->query($queryupd);
        $this->dbErrorCheck($ok, $queryupd);
    }

    /**
     * 
     * @param array $fieldlist
     */
    private function insertIntoResumen($fieldlist) {
        $fl = implode(',', $fieldlist);
        $queryins = "insert ignore into resumen (" . $fl . ") select " . $fl . " from temp";
        $ok = $this->pdo->query($queryins);
        $this->dbErrorCheck($ok, $queryins);
    }

    /**
     * 
     */
    private function updateClientes() {

        $query = "INSERT IGNORE INTO clientes "
                . "SELECT cliente FROM resumen";
        $this->pdo->query($query);
    }

    /**
     * 
     */
    private function updatePagos() {
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

    /**
     * 
     */
    private function createLookupTable() {
        $queryrlist1 = "truncate cobra.rlook";
        $this->pdo->query($queryrlist1);
        $queryrlist2 = "insert into cobra.rlook
select id_cuenta,numero_de_cuenta,nombre_deudor,cliente,status_de_credito,
nombre_referencia_1,nombre_referencia_2,nombre_referencia_3,nombre_referencia_4,
tel_1,tel_2,tel_3,tel_4,
tel_1_alterno,tel_2_alterno,tel_3_alterno,tel_4_alterno,
tel_1_verif,tel_2_verif,tel_3_verif,tel_4_verif,
tel_1_ref_1,tel_2_ref_1,
tel_1_ref_2,tel_2_ref_2,
tel_1_ref_3,tel_2_ref_3,
tel_1_ref_4,tel_2_ref_4,
tel_1_laboral,tel_2_laboral,telefonos_marcados
from cobra.resumen;
";
        $this->pdo->query($queryrlist2);
    }

}
