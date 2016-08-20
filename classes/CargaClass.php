<?php

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

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @return string
     */
    function moveLoadedFile() {
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
    function getCsvData($filename, $header) {
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
    function getDataColumnNames($row) {
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
    function getDBColumnNames() {
        $query = "SHOW COLUMNS FROM resumen";
        $columnArray = $this->pdo->query($query);
        return $columnArray;
    }

    /**
     * 
     * @param array $columnNames
     */
    function prepareTemp($columnNames) {
        $querydrop = "DROP TABLE IF EXISTS `cobra`.`temp`;";
        $this->pdo->query($querydrop);
        $querystart = "CREATE TABLE  `cobra`.`temp` "
                . "ENGINE=INNODB AUTO_INCREMENT=10 "
                . "DEFAULT CHARSET=utf8 "
                . "COLLATE=utf8_spanish_ci "
                . "SELECT "
                . implode(',', $columnNames)
                . "FROM resumen LIMIT 0";
        $this->pdo->query($querystart);
        $queryindex = "ALTER TABLE temp ADD INDEX nc(numero_de_cuenta(50), cliente(50));";
        $this->pdo->query($queryindex);
    }

    /**
     * 
     * @param PDO $pdo
     * @param string $filename
     * @param string $columnNames
     */
    function loadData($pdo, $filename, $columnNames) {
        $data = $this->getCsvData($filename, false);
        $n = 0;
        $queryload = "INSERT INTO temp (" . implode(",", $columnNames) . ") VALUES ";
        foreach ($data as $row) {
            if ($n > 0) {
                $limpio = str_replace("'", "", $row);
                $queryload .= "('" . implode("','", $limpio) . "'),";
            }
            $n++;
        }
        $queryloadtrim = rtrim($queryload, ",");
        $ok = $pdo->query($queryloadtrim);
        if (!$ok) {
            var_dump($pdo->errorInfo());
            die(htmlentities($queryload));
        }
    }

    /**
     * 
     * @param string $name
     * @return string
     */
    function prepareOne($name) {
        $output = 'resumen.' . $name . '=temp.' . $name;
        return $output;
    }

    /**
     * 
     * @param array $columnNames
     * @return array
     */
    function prepareUpdate($columnNames) {
        $output = array_map(array($this, 'prepareOne'), $columnNames);
        return $output;
    }

    /**
     * 
     * @param PDO $pdo
     * @param array $fieldlist
     */
    function updateResumen($pdo, $fieldlist) {
        $fl = implode(',', $fieldlist);
        $queryupd = "UPDATE temp, resumen
            SET " . $fl . " 
            where temp.numero_de_cuenta=resumen.numero_de_cuenta
            and temp.cliente=resumen.cliente";
        $pdo->query($queryupd);
    }

    /**
     * 
     * @param PDO $pdo
     * @param array $fieldlist
     */
    function insertIntoResumen($pdo, $fieldlist) {
        $fl = implode(',', $fieldlist);
        $queryins = "insert ignore into resumen (" . $fl . ") select " . $fl . " from temp;";
        $pdo->query($queryins);
    }

    /**
     * 
     * @param PDO $pdo
     */
    function updateClientes($pdo) {

        $query = "INSERT IGNORE INTO clientes "
                . "SELECT cliente FROM resumen";
        $pdo->query($query);
    }

    /**
     * 
     * @param PDO $pdo
     */
    function updatePagos($pdo) {
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
        $pdo->query($querypagoins);
    }

    /**
     * 
     * @param PDO $pdo
     */
    function createLookupTable($pdo) {
        $queryrlist1 = "truncate cobra.rlook";
        $pdo->query($queryrlist1);
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
        $pdo->query($queryrlist2);
    }

}
