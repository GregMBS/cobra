<?php

namespace cobra_salsa;

use DateTime;
use Exception;
use PDO;
use PDOException;
use PDOStatement;

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

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $filename
     * @param boolean $header
     * @return array
     */
    public function getCsvData($filename, $header) {
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
    public function getDBColumnNames() {
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
     * @param array $dataNames
     * @param array $dbNames
     * @return array
     */
    private function nameCheck($dataNames, $dbNames) {
        $oops = array();
        foreach ($dataNames as $name) {
            $match = in_array($name, $dbNames);
            if (!$match) {
                $oops[] = $name;
            }
        }
        return $oops;
    }

    /**
     *
     * @param array $columnNames
     * @throws Exception
     */
    public function prepareTemp($columnNames) {
        $query = "DROP TABLE IF EXISTS temp;";
        try {
            $this->pdo->query($query);
        } catch (PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
        $queryStart = "CREATE TABLE temp "
                . "ENGINE=INNODB AUTO_INCREMENT=10 "
                . "DEFAULT CHARSET=utf8 "
                . "COLLATE=utf8_spanish_ci "
                . "SELECT "
                . implode(',', $columnNames)
                . ", CURDATE() as fecha_de_actualizacion"
                . " FROM resumen LIMIT 0";
        try {
            $this->pdo->query($queryStart);
        } catch (PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
        $queryIndex = "ALTER TABLE temp ADD INDEX nc(numero_de_cuenta(50), cliente(50));";
        try {
            $this->pdo->query($queryIndex);
        } catch (PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
    }

    /**
     *
     * @param string $filename
     * @throws Exception
     */
    public function loadData($filename) {
        $data = $this->getCsvData($filename, false);
        if (is_array($data[0])) {
            $columnNames = $this->getDataColumnNames($data[0]);
            $dbNames = $this->getDBColumnNames();
            $oops = $this->nameCheck($columnNames, $dbNames);
            if (count($oops) > 0) {
                throw new Exception("Bad fields: ".$oops);
            }
            $count = 0;
            $glue = ",";
            $columnString = implode($glue, $columnNames);
            $queryLoad = "INSERT INTO temp (" . $columnString . ") VALUES ";
            foreach ($data as $row) {
                if ($count > 0) {
                    $limpio = str_replace("'", "", $row);
                    $queryLoad .= "('" . implode("','", $limpio) . "'),";
                }
                $count++;
            }
            $queryLoadTrim = rtrim($queryLoad, ",");
            try {
                $this->pdo->query($queryLoadTrim);
            } catch (PDOException $Exception) {
                throw new Exception($Exception->getMessage(), $Exception->getCode());
            }
        } else {
            throw new Exception("No data");
        }
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
     * @param $columnNames
     * @throws Exception
     */
    public function updateResumen($columnNames) {
        $fieldList = $this->prepareUpdate($columnNames);
        $fields = implode(',', $fieldList);
        $query = "UPDATE temp, resumen
            SET " . $fields . " 
            where temp.numero_de_cuenta=resumen.numero_de_cuenta
            and temp.cliente=resumen.cliente";
        try {
            $this->pdo->query($query);
        } catch (PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
    }

    /**
     *
     * @param array $fieldList
     * @throws Exception
     */
    public function insertIntoResumen($fieldList) {
        $fields = implode(',', $fieldList);
        $query = "insert ignore into resumen (" . $fields . ") select " . $fields . " from temp";

        try {
            $this->pdo->query($query);
        } catch (PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
        }
    }

    /**
     *
     * @param string $cliente
     */
    public function clearCargadex($cliente) {
            $query = <<<SQL
delete from cargadex where cliente = :cliente
SQL;
        try {
            $std = $this->pdo->prepare($query);
            $std->bindParam(':cliente', $cliente);
            $std->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param string $field
     * @param string $type
     * @param string $nullOk
     * @param int $position
     * @param string $cliente
     */
    public function loadCargadex($field, $type, $nullOk, $position, $cliente) {
        $query = <<<SQL
insert into cargadex (field,type,nullOk,position,cliente) values (:field, :type, :nullOk, :position, :cliente)
SQL;
        try {
            $std = $this->pdo->prepare($query);
            $std->bindParam(':field', $field);
            $std->bindParam(':type', $type);
            $std->bindParam(':nullOk', $nullOk);
            $std->bindParam(':position', $position, PDO::PARAM_INT);
            $std->bindParam(':cliente', $cliente);
            $std->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     *
     * @param string $cliente
     * @return array
     */
    public function getCargadex($cliente) {
        $query = <<<SQL
select * from cargadex where cliente = :cliente
SQL;
        try {
            $std = $this->pdo->prepare($query);
            $std->bindParam(':cliente', $cliente);
            $std->execute();
            return $std->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * 
     */
    public function updateClientes() {

        $query = "INSERT IGNORE INTO clientes "
                . "SELECT cliente FROM resumen";
        $this->pdo->query($query);
    }

    /**
     * 
     */
    public function updatePagos() {
        $query = "insert ignore into pagos (cuenta,fecha,monto,cliente,gestor,confirmado,id_cuenta)
select numero_de_cuenta, fecha_de_ultimo_pago, 
monto_ultimo_pago, cliente, c_cvge, 1, id_cuenta 
from resumen 
left join historia h1 on c_cont=id_cuenta and n_prom>0
where fecha_de_ultimo_pago>last_day(curdate() - INTERVAL 31 day) 
AND monto_ultimo_pago>0 
and not exists (select * from historia h2 
where h2.d_fech>h1.d_fech and h2.c_cont=h1.c_cont and h2.n_prom>0) 
and fecha_de_ultimo_pago < fecha_de_actualizacion 
group by id_cuenta,c_cvge having fecha_de_ultimo_pago>min(d_fech)
";
        $this->pdo->query($query);
    }

    /**
     * 
     */
    public function createLookupTable() {
        $queryTruncate = "truncate rlook";
        $this->pdo->query($queryTruncate);
        $queryInsert = "insert into rlook
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
from resumen;
";
        $this->pdo->query($queryInsert);
    }

    /**
     * @param $date
     * @param string $format
     * @return bool
     */
    public function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    /**
     * @param string $filename
     * @return bool
     */
    public function validateFilename($filename) {
        return is_uploaded_file($filename);
    }

    /**
     * @param $cliente
     * @return int|void
     */
    public function getPosition($cliente) {
        $query = "select position from cargadex where cliente= :cliente";
        try {
            $std = $this->pdo->prepare($query);
            $std->bindParam(':cliente', $cliente);
            $std->execute();
            $result = $std->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return count($result);
    }

    /**
     * @return false|PDOStatement|array
     */
    public function getNewFieldList() {
        $query = "show fields from temp where field not regexp 'nousar'";
        return $this->pdo->query($query, PDO::FETCH_ASSOC);
    }

    /**
     *
     */
    public function startTransaction() {
        $query = "START TRANSACTION";
        $this->pdo->query($query);
    }

    /**
     *
     */
    public function endTransaction() {
        $query = "COMMIT";
        $this->pdo->query($query);
    }
}
