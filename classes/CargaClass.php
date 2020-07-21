<?php

namespace cobra_salsa;

use Exception;
use PDO;
use PDOException;

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
     * @return string
     */
    public function moveLoadedFile() {
        $destination = "/tmp/" . $_FILES['file']['name'];
        move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
        return $destination;
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
    public function getDataColumnNames($row) {
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
    public function nameCheck($dataNames, $dbNames) {
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
        $queryDrop = "DROP TABLE IF EXISTS temp;";
        try {
            $this->pdo->query($queryDrop);
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
     * @param array $columnNames
     * @throws Exception
     */
    public function loadData($filename, $columnNames) {
        $data = $this->getCsvData($filename, false);
        $count = 0;
        $glue = ',';
        $list = implode($glue, $columnNames);
        $queryLoad = "INSERT INTO temp (" . $list . ") VALUES ";
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
    }

    /**
     * 
     * @param array $columnNames
     * @return array
     */
    public function prepareUpdate($columnNames) {
        $output = array();
        foreach ($columnNames as $name) {
            $output[] = 'resumen.' . $name . '=temp.' . $name;
        }
        return $output;
    }

    /**
     *
     * @param array $fieldlist
     * @throws Exception
     */
    public function updateResumen($fieldlist) {
        $fields = implode(',', $fieldlist);
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
     * @param array $fieldlist
     * @throws Exception
     */
    public function insertIntoResumen($fieldlist) {
        $fields = implode(',', $fieldlist);
        $query = "insert ignore into resumen (" . $fields . ") select " . $fields . " from temp";

        try {
            $this->pdo->query($query);
        } catch (PDOException $Exception) {
            throw new Exception($Exception->getMessage(), $Exception->getCode());
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
        $querypagoins = "insert ignore into pagos (cuenta,fecha,monto,cliente,gestor,confirmado,id_cuenta)
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
        $this->pdo->query($querypagoins);
    }

    /**
     * 
     */
    public function createLookupTable() {
        $queryrlist1 = "truncate rlook";
        $this->pdo->query($queryrlist1);
        $queryrlist2 = "insert into rlook
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
        $this->pdo->query($queryrlist2);
    }

    /**
     * @param $con
     * @param $post
     */
    function asociar($con, $post): void
    {
        $maxc = $con->real_escape_string($post['maxc']);
        $cliente = $con->real_escape_string($post['cliente']);

        if (!empty($post['pos0'])) {
            $queryres = "show columns from resumen";
            $resultres = $con->query($queryres) or die($con->error);
            $k = 0;
            $field = array();
            $type = array();
            $nullok = array();
            while ($answerres = $resultres->fetch_row()) {
                $field[$k] = $answerres[0];
                $type[$k] = $answerres[1];
                $nullok[$k] = $answerres[2];
//                                           $position[$k] = $k;
                $k++;
            }

            for ($f = 0; $f < $maxc; $f++) {
                $pos = $con->real_escape_string($post['pos' . $f]);

                if (stripos($pos, 'nousar') === 0) {
                    $nfield = 'nousar';
                    $ntype = '';
                    $nnullok = '';
                    $nposition = '';
                } else {
                    $nfield = $field[$pos];
                    $ntype = $type[$pos];
                    $nnullok = $nullok[$pos];
                    $nposition = $pos;
                }
                $queryins = "insert into cargadex (field,type,nullok,position,cliente) values ('$nfield','$ntype','$nnullok','$nposition','$cliente');";
                $resultins = $con->query($queryins) or die('Load cargadex: ' . $con->error);
            }
        }
        $querydrop = "DROP TABLE IF EXISTS `temp`;";
        $con->query($querydrop) or die($con->error);
        $querydex = "select * from cargadex where cliente='" . $cliente . "';";
        $resultdex = $con->query($querydex) or die($con->error);
        $c = 0;

        while ($answerdex = $resultdex->fetch_row()) {
            $field[$c] = $answerdex[1];
            $type[$c] = $answerdex[2];
            $c++;
            set_time_limit(300);
        }
        $querystart = "CREATE TABLE `temp` (";
        $queryend = "`fecha_de_actualizacion` date,
`originacion` varchar(255)
) ENGINE=INNODB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;";

        for ($f = 0; $f < $c; $f++) {

            if ($field[$f] != 'nousar') {
                $qline = $field[$f] . " " . $type[$f] . ",";
            } else {
                $qline = "nousar" . $f . " varchar(1),";
            }
            $querystart = $querystart . $qline;
        }
//            die($querystart.$queryend);
        $con->query($querystart . $queryend) or die('Load temp: ' . $con->error);
        $queryindex = "ALTER TABLE temp ADD INDEX nc(numero_de_cuenta(50), cliente(50));";
        $con->query($queryindex) or die($con->error);
        $filename2 = $con->real_escape_string($post['filename']);
        $n = 0;
        $querytrans = "START TRANSACTION";
        $con->query($querytrans) or die('Start transaction:' . $con->error);
        if (($handle = fopen($filename2, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',', '"')) !== FALSE) {
                if ($n == 0) {
                    $header = $data;
                    $queryload = "INSERT INTO temp (" . implode(",", $header) . ") VALUES ";
                }
                if ($n > 0) {
                    $limpio = str_replace("'", "", $data);
                    $queryload .= "('" . implode("','", $limpio) . "'),";
//			echo $queryload."<br>";
                }
                $n++;
            }
            $queryloadtrim = rtrim($queryload, ",");
            $con->query($queryloadtrim) or die('Load temp 2:' . $con->error);
        }
        $querycommit = "COMMIT";
        $con->query($querycommit) or die('Commit:' . $con->error);
        if ($cliente == 'CrediClub') {
            $querycff = "UPDATE temp
		set cliente='CrediClub',
		fecha_de_actualizacion=curdate(),
		originacion = nombre_deudor,
		nombre_deudor=replace(nombre_deudor,'  ', ' ');";
        } else {
            $querycff = "UPDATE temp
                set cliente='" . $cliente . "',
                fecha_de_actualizacion=curdate(),
                originacion = '';";
        }
        $con->query($querycff) or die($con->error);
        $queryfcont = "show fields from temp
where field not regexp '^nousar'
and field not regexp '_cuenta$';";
        $resultfcont = $con->query($queryfcont) or die($con->error);
        $fieldlistu = '';
        $sepu = '';

        while ($answerfcont = $resultfcont->fetch_row()) {
            $fieldlistu .= $sepu . 'resumen.' . $answerfcont[0] . '=temp.' . $answerfcont[0];
            $sepu = ',';
        }

        $queryupd2 = "UPDATE temp, resumen
            SET " . $fieldlistu . " 
            where temp.numero_de_cuenta=resumen.numero_de_cuenta
            and temp.cliente=resumen.cliente";

        if ($cliente == 'CrediClub') {
            $queryupd2 = $queryupd2 . ' and temp.nombre_deudor = resumen.nombre_deudor';
        }
        $con->query($queryupd2) or die($con->error . ' UPDATE');
//            die(htmlentities($queryupd2));

        echo "Old fields updated.";
        $queryfused = "show fields from temp where field not regexp 'nousar';";
        $resultfused = $con->query($queryfused) or die($con->error);
        $fieldlist = '';
        $sep = '';

        while ($answerfused = $resultfused->fetch_row()) {
            $fieldlist = $fieldlist . $sep . $answerfused[0];
            $sep = ',';
        }
        $queryins = "insert ignore into resumen (" . $fieldlist . ") select " . $fieldlist . " from temp;";
        $resultins = $con->query($queryins) or die('Load resumen: ' . $con->error);
        $querycli = "insert ignore into clientes values ('" . $cliente . "');";
        $con->query($querycli) or die('Load clientes: ' . $con->error);
        echo "New fields inserted.";
        $querypagoins = "insert ignore into pagos (cuenta,fecha,monto,cliente,gestor,confirmado,id_cuenta)
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
        $con->query($querypagoins) or die($con->error);
        $queryrlist1 = "truncate rlook;";
        $con->query($queryrlist1) or die($con->error);
        $queryrlist2 = "insert into rlook
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
        $con->query($queryrlist2) or die($con->error);
    }

    /**
     * @param $con
     * @param $post
     * @return array
     */
    function clientePick($con, $post): array
    {
        $cliente = $con->real_escape_string($post['cliente']);

        $queryre = "delete from cargadex where cliente='" . $cliente . "';";
        $resultre = $con->query($queryre) or die($con->error);
        if (isset($post['fecha_de_actualizacion'])) {
            $fecha_de_actualizacion = $con->real_escape_string($post['fecha_de_actualizacion']);
        } else {
            $fecha_de_actualizacion = date('Y-m-d');
        }
        $filename = $con->real_escape_string($post['filename']);
        $handle = fopen($filename, "r");
        $data = fgetcsv($handle, 0, ",");
        $num = 0;

        while ($num == 0) {
            $num = count($data);
        }
        return array($cliente, $post, $fecha_de_actualizacion, $filename, $handle, $data, $num);
    }

}
