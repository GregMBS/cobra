<?php

use gregmbs\cobra\PdoClass;

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$con = $pdoc->dbConnectAdminMysqli();
$capt = $pdoc->capt;
$post = filter_input_array(INPUT_POST);
?>
<!DOCTYPE HTML>

use cobra_salsa\PdoClass;
use cobra_salsa\CargaClass;

require_once 'classes/PdoClass.php';
require_once 'vendor/autoload.php';
require_once 'classes/CargaClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$cc = new CargaClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
if (empty($capt)) {
$capt = filter_input(INPUT_POST, 'capt');
}
$post = filter_input_array(INPUT_POST);
$go = filter_input(INPUT_POST, 'go');
$cliente = filter_input(INPUT_POST, 'cliente');
$fecha_de_actualizacion = filter_input(INPUT_POST, 'fecha_de_actualizacion');
$flag = ($_FILES["file"]["error"] == 0);
require_once 'views/cargaView.php';
if ($go == 'cargar') {
if ($flag) {
$filename = $cc->moveLoadedFile();
require_once 'views/fileLoadResultsView.php';
} else {
?>
<p>Error: <?php echo $_FILES["file"]["error"]; ?></p>
<?php
if (!empty($post['go'])) {

    if ($post['go'] == 'cargar') {

        if ($_FILES["file"]["error"] > 0) {
            echo "<p>Error: " . $_FILES["file"]["error"] . "</p>";
        } else {
            echo "<p>Upload: " . $_FILES["file"]["name"] . "<br>";
            echo "Type: " . $_FILES["file"]["type"] . "<br>";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br>";
            echo "Stored in: " . $_FILES["file"]["tmp_name"];
            $deststr = "/tmp/" . $_FILES['file']['name'];
            move_uploaded_file($_FILES["file"]["tmp_name"], $deststr);
            echo "Stored in: " . $deststr . "</p>";
            ?>
            <p>
            <form action="carga2.php" method="post" name="clientepick">
                <table summary="Eligir cliente">
                    <tr><td>Client</td>
                        <td><input type="text" name="cliente" />
                            <input type="hidden" name="filename" value="<?php
                            echo $deststr
                            ?>" />
                            <input type="hidden" name="capt" value="<?php echo $capt ?>" />
                        </td></tr>
                </table>
                <button type="submit" name="go" value="clientepick">Elegir cliente</button>
            </form>
            <?php
        }
    }

    if ($post['go'] == 'clientepick') {
        ?>
        <p>
        <form action="carga2.php" method="post" name="assoc">
            <?php
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
            $row = 1;
            $data = fgetcsv($handle, 0, ",");
            $num = 0;

            while ($num == 0) {
                $num = count($data);
            }
            $row++;
            ?>
            <input name="cliente" type="hidden" value="<?php
            echo $cliente
            ?>" />
            <input name="fecha_de_actualizacion" type="hidden" value="<?php
            echo $fecha_de_actualizacion
            ?>" />
            <input type="hidden" name="filename" value='<?php
            echo $filename
            ?>' />
            <input type="hidden" name="capt" value="<?php echo $capt ?>" />
        </p>
        <p>
        <table summary="Nuevo campos">
            <?php
            $querypdex = "select position from cargadex where cliente='" . $cliente . "';";
            $resultpdex = $con->query($querypdex) or die($con->error);
            $numdex = 0;

            while ($answerpdex = $resultpdex->fetch_row()) {
                $numdex++;
            }

            if ($numdex == 0) {

                for ($c = 0; $c < $num; $c++) {

                    if (!empty($data[$c])) {
                        ?>
                        <tr><td><?php
                                echo trim($data[$c])
                                ?></td>
                            <td>
                                <select name="pos<?php
                                echo $c
                                ?>">
                                    <option value='nousar<?php echo $c ?>'>no usar</option>
                                    <?php
                                    $queryres = "show columns from resumen";
                                    $resultres = $con->query($queryres) or die($con->error);
                                    $k = 0;

                                    while ($answerres = $resultres->fetch_row()) {
                                        ?>
                                        <option value='<?php echo $k ?>'<?php
                                        if (trim($data[$c]) == $answerres[0]) {
                                            echo " selected='selected'";
                                        }
                                        ?>><?php echo $answerres[0]; ?></option>
                                                <?php
                                                $k++;
                                            }
                                            ?>
                                </select></td></tr>
                        <?php
                    } else {
                        ?>
                        <input type="hidden" value="nousar" name="pos<?php
                        echo $c
                        ?>"/>
                               <?php
                           }
                       }
                   } else {
                       $querydex = "select * from cargadex where cliente='" . $cliente . "';";
                       $resultdex = $con->query($querydex) or die($con->error);
                       $c = 0;

                       while ($answerdex = $resultdex->fetch_row()) {
                           echo $data[$c] . " " . $answerdex[1] . " " . $answerdex[2] . " " . $answerdex[3] . "<br>";
                           $c++;
                       }
                   }
                   fclose($handle);
                   ?>
            </p>
            <p>
                <input type="hidden" name="maxc" value="<?php echo $c ?>" />
                <input type="hidden" name="capt" value="<?php echo $capt ?>" />
                <input type="submit" name="go" value="asociar" />
            </p>
        </form>
        <?php
    }

    if ($post['go'] == 'asociar') {
        $maxc = $con->real_escape_string($post['maxc']);
        $cliente = $con->real_escape_string($post['cliente']);
        $fecha_de_actualizacion = $con->real_escape_string($post['fecha_de_actualizacion']);
        $filename = $con->real_escape_string($post['filename']);

        if (!empty($post['pos0'])) {
            $queryres = "show columns from resumen";
            $resultres = $con->query($queryres) or die($con->error);
            $k = 0;

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
        $querystart = "CREATE TABLE  `temp` (";
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
        $queryins = "insert ignore into resumen (" . $fieldlist . ") select " . $fieldlist . " from temp
            where numero_de_cuenta+0>0 and not exists (
            select * from resumen 
            where temp.numero_de_cuenta=resumen.numero_de_cuenta);";
        //die(htmlentities($queryins));
//die("ready to INSERT to resumen");                    
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
and fecha_de_ultimo_pago<fecha_de_actualizacion 
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
}
$header = $cc->getCsvData($filename, true);
$num = count($header);
$dataNames = $cc->getDataColumnNames($header);
$dbNames = $cc->getDBColumnNames();
$oops = $cc->nameCheck($dataNames, $dbNames);
if (empty($oops)) {
    $cc->prepareTemp($dataNames);
    echo "<p>Preparada para cargar datos.</p>";
    $cc->loadData($filename, $dataNames);
    echo "<p>Datos cargados.</p>";
    $fieldlist = $cc->prepareUpdate($dataNames);
    $cc->updateResumen($fieldlist);
    echo "<p>Cuentas actualizadas.</p>";
    $cc->insertIntoResumen($dataNames);
    echo "<p>Cuentas nuevas instaladas.</p>";
    $cc->updateClientes();
    echo "<p>Tabla de clientes actualizada.</p>";
    $cc->updatePagos();
    echo "<p>Pagos actualizados.</p>";
    $cc->createLookupTable();
    echo "<p>Table 'lookup' actualizada.</p>";
    echo "<p><a href='segmentadmin.php?capt=$capt'>Actialuzar segmentos.</a></p>";
} else {
    require_once 'views/badNamesView.php';
    die();
}
