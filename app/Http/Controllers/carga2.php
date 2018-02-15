<?php
include('admin_hdr_i.php');
set_time_limit(300);
$post = filter_input_array(INPUT_POST);
?>
<!DOCTYPE HTML>

<html>
    <head>
        <title>COBRA Carga</title>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <form action="carga2.php" method="post" enctype="multipart/form-data" name="cargar">
            <p>Filename:
                <input type="hidden" name="capt" id="capt" value="<?php echo $capt ?>" />
                <input type="file" name="file" id="file"><br>
                <button type="submit" name="go" value="cargar">Elegir archivo</button>
            </p>
        </form>
        <?php
        if (!empty($post['go'])) {

            if ($post['go'] == 'cargar') {

                if ($_FILES["file"]["error"] > 0) {
                    echo "<p>Error: ".$_FILES["file"]["error"]."</p>";
                } else {
                    echo "<p>Upload: ".$_FILES["file"]["name"]."<br>";
                    echo "Type: ".$_FILES["file"]["type"]."<br>";
                    echo "Size: ".($_FILES["file"]["size"] / 1024)." Kb<br>";
                    echo "Stored in: ".$_FILES["file"]["tmp_name"];
                    $deststr = "/tmp/".$_FILES['file']['name'];
                    move_uploaded_file($_FILES["file"]["tmp_name"], $deststr);
                    echo "Stored in: ".$deststr."</p>";
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

                    $queryre  = "delete from cargadex where cliente='".$cliente."';";
                    $resultre = $con->query($queryre) or die($con->error);
                    
                    $fecha_de_actualizacion = date('Y-m-d H:i:s');
                    $filename               = $con->real_escape_string($post['filename']);
                    $handle                 = fopen($filename, "r");
                    $row                    = 1;
                    $data                   = fgetcsv($handle, 0, ",");
                    $num                    = 0;

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
                    $querypdex  = "select position from cargadex where cliente='".$cliente."';";
                    $resultpdex = $con->query($querypdex) or die($con->error);
                    $numdex     = 0;

                    while ($answerpdex = $resultpdex->fetch_row()) {
                        $numdex++;
                    }

                    if ($numdex == 0) {

                        for ($c = 0; $c < $num; $c++) {

                            if (!empty($data[$c])) {
                                ?>
                                <tr><td><?php
                                        echo $data[$c]
                                        ?></td>
                                    <td>
                                        <select name="pos<?php
                                        echo $c
                                        ?>">
                                            <option style="background-color: yellow; color: red" value='nousar<?php echo $c ?>'>no usar</option>
                                            <?php
                                            $queryres  = "show columns from resumen";
                                            $resultres = $con->query($queryres) or die($con->error);
                                            $k         = 0;

                                            while ($answerres = $resultres->fetch_row()) {
                                                ?>
                                                <option value='<?php echo $k ?>'<?php
                                                if ($data[$c] == $answerres[0]) {
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
                               $querydex  = "select * from cargadex where cliente='".$cliente."';";
                               $resultdex = $con->query($querydex) or die($con->error);
                               $c         = 0;

                               while ($answerdex = $resultdex->fetch_row()) {
                                   echo $data[$c]." ".$answerdex[1]." ".$answerdex[2]." ".$answerdex[3]."<br>";
                                   $c++;
                               }
                           }
                           fclose($handle);
                           ?>
                    </p>
                    <p>
                        <input type="hidden" name="maxc" value="<?php echo $c ?>" />
                        <input type="hidden" name="capt" value="<?php echo $capt ?>" />
<!--                        Inactivar todas cuentas viejas <input type="checkbox" name="inactivar" id="inactivar"><br>-->
                        <input type="submit" name="go" value="asociar" />
                    </p>
            </form>
            <?php
        }

        if ($post['go'] == 'asociar') {
            $maxc                   = $con->real_escape_string($post['maxc']);
            $cliente                = $con->real_escape_string($post['cliente']);
            $fecha_de_actualizacion = $con->real_escape_string($post['fecha_de_actualizacion']);
            $filenameA               = $con->real_escape_string($post['filename']);

            if (!empty($post['capt'])) {
                $queryres  = "show columns from resumen";
                $resultres = $con->query($queryres) or die($con->error);
                $k         = 0;

                while ($answerres = $resultres->fetch_row()) {
                    $field[$k]    = $answerres[0];
                    $type[$k]     = $answerres[1];
                    $nullok[$k]   = $answerres[2];
                    $position[$k] = $k;
                    $k++;
                }

                for ($f = 0; $f < $maxc; $f++) {
                    $pos = $con->real_escape_string($post['pos'.$f]);

                    if (stripos($pos, 'nousar') === 0) {
                        $nfield    = 'nousar';
                        $ntype     = '';
                        $nnullok   = '';
                        $nposition = '';
                    } else {
                        $nfield    = $field[$pos];
                        $ntype     = $type[$pos];
                        $nnullok   = $nullok[$pos];
                        $nposition = $pos;
                    }
                    $queryins  = "insert into cargadex (field,type,nullok,position,cliente) values ('$nfield','$ntype','$nnullok','$nposition','$cliente');";
                    $resultins = $con->query($queryins) or die($con->error);
//                    echo $queryins;
                }
            }
            $querydrop  = "DROP TABLE IF EXISTS `temp`;";
            $resultdrop = $con->query($querydrop) or die($con->error);
            $querydex   = "select * from cargadex where cliente='".$cliente."';";
            $resultdex  = $con->query($querydex) or die($con->error);
            $c          = 0;

            while ($answerdex = $resultdex->fetch_row()) {
                $field[$c] = $answerdex[1];
                $type[$c]  = $answerdex[2];
                $c++;
                set_time_limit(300);
            }
            $querystart = "CREATE TABLE  `temp` (";
            $queryend   = "`fecha_de_actualizacion` date
) ENGINE=INNODB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;";

            for ($f = 0; $f < $c; $f++) {

                if ($field[$f] != 'nousar') {
                    $qline = $field[$f]." ".$type[$f].",";
                } else {
                    $qline = "nousar".$f." varchar(1),";
                }
                $querystart = $querystart.$qline;
            }
//            die($querystart.$queryend);
            $resultcr = $con->query($querystart.$queryend) or die($con->error);
            $filename = $con->real_escape_string($post['filename']);
            $n        = 0;
            if (($handle   = fopen($filename, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if ($n == 0) {
                        $header    = $data;
                        $queryload = "INSERT INTO temp (".implode(",",
                                $header).") VALUES ";
                    }
                    if ($n > 0) {
                        $limpio = str_replace("'", "", $data);
                        $queryload .= "('".implode("','", $limpio)."'),";
//			echo $queryload."<br>";
                    }
                    $n++;
                }
                $queryloadtrim = rtrim($queryload, ",");
                $resultload    = $con->query($queryloadtrim) or die($con->error);
            }
            $querycff    = "UPDATE temp set fecha_de_actualizacion=curdate();";
            $resultcff   = $con->query($querycff) or die($con->error);
            $queryindex  = "ALTER TABLE temp ADD INDEX nc(numero_de_cuenta(50), cliente(50));";
            $con->query($queryindex) or die($con->error);
            $queryfcont  = "show fields from temp
where field not regexp '^nousar'
and field not regexp '_cuenta$';";
            $resultfcont = $con->query($queryfcont) or die($con->error);
            $fieldlistA   = '';
            $sepA         = '';

            while ($answerfcont = $resultfcont->fetch_row()) {
                $fieldlistA = $fieldlistA.$sepA.'resumen.'.$answerfcont[0].'=temp.'.$answerfcont[0];
                $sepA       = ',';
            }
            $ncr        = '';
            $ncr1       = '';
            $ncr2       = '';
            $queryioff  = "ALTER TABLE resumen DISABLE KEYS";
            $queryion   = "ALTER TABLE resumen ENABLE KEYS";
            //$con->query($queryioff) or die($con->error);
            $queryupd2  = "UPDATE temp, resumen
            SET ".$fieldlistA."
            where temp.numero_de_cuenta=resumen.numero_de_cuenta;";
            $resultupd2 = $con->query($queryupd2) or die($con->error);
//            die(htmlentities($queryupd2));

            echo "Old fields updated.";
            $queryfused  = "show fields from temp where field not regexp 'nousar';";
            $resultfused = $con->query($queryfused) or die($con->error);
            $fieldlistB   = '';
            $sepB         = '';

            while ($answerfused = $resultfused->fetch_row()) {
                $fieldlistB = $fieldlistB.$sepB.$answerfused[0];
                $sepB       = ',';
            }
            $queryins       = "insert into resumen (".$fieldlistB.") select ".$fieldlistB." from temp
            where numero_de_cuenta+0>0 and not exists (
            select * from resumen
            where temp.numero_de_cuenta=resumen.numero_de_cuenta);";
            //die(htmlentities($queryins));
            $queryins       = "insert ignore into resumen (".$fieldlistB.") select ".$fieldlistB." from temp;";
            $resultins      = $con->query($queryins) or die($con->error);
            $querycli       = "insert ignore into clientes values ('".$cliente."');";
            $resultcli      = $con->query($querycli) or die($con->error);
            echo "New fields inserted.";
            $querykill      = "update resumen
            set status_de_credito=concat(status_de_credito,'-Liquidado')
            where saldo_total=0 and status_de_credito not like '%do' and fecha_de_actualizacion=curdate()";
//            $resultkill = $con->query($querykill) or die($con->error);
            $queryoverkill  = "UPDATE resumen
            SET status_de_credito=REPLACE(status_de_credito,'o-Liquidado','o')
            WHERE status_de_credito like '%o-Liquidado' and fecha_de_actualizacion=curdate();";
//            $resultoverkill = $con->query($queryoverkill) or die($con->error);
            //$con->query($queryioff) or die($con->error);
//            echo "Paid accounts inactivated.";
            $queryrlist0    = "update resumen, dictamenes
set status_aarsa='GESTION SIN CONTACTOS'
where dictamen=status_aarsa
and status_de_credito regexp '-'
and queue in ('MENSAJES DIRECTOS','MENSAJES INDIRECTOS','CLIENTE NEGOCIANDO')
and id_cuenta in (select c_cont from historia where d_fech>curdate()-interval 60 day)
and id_cuenta in (select c_cont from historia where d_fech>curdate()-interval 60 day AND C_CONT <>'')
;";
//            $con->query($queryrlist0) or die($con->error);
            $querypagoclean = "delete from pagos
where confirmado=0 and exists
(select * from resumen
 where pagos.id_cuenta=resumen.id_cuenta
 and fecha<fecha_de_ultimo_pago);";
            $con->query($querypagoclean) or die($con->error);
            $querypagoins   = "insert ignore into pagos (cuenta,fecha,monto,cliente,gestor,confirmado,id_cuenta)
select numero_de_cuenta, fecha_de_ultimo_pago,
monto_ultimo_pago, cliente, c_cvge, 1, id_cuenta
from resumen
left join historia h1 on c_cont=id_cuenta and n_prom>0
where fecha_de_ultimo_pago>last_day(curdate() - INTERVAL 31 day)
AND monto_ultimo_pago>0
and (numero_de_cuenta,fecha_de_ultimo_pago,monto_ultimo_pago,cliente)
not in (select cuenta,fecha,monto,cliente from pagos
where confirmado=1)
and not exists (select * from historia h2
where h2.d_fech>h1.d_fech and h2.c_cont=h1.c_cont and h2.n_prom>0)
and fecha_de_ultimo_pago<fecha_de_actualizacion
group by id_cuenta,c_cvge having fecha_de_ultimo_pago>min(d_fech)";
//$con->query($querypagoins) or die($con->error);
            $queryrlist1    = "truncate rlook;";
            $con->query($queryrlist1) or die($con->error);
            $queryrlist2    = "insert into rlook
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
        $querydesact = "UPDATE resumen
SET status_de_credito=concat(status_de_credito,'-inactivo')
WHERE fecha_de_actualizacion<curdate();";
//        if (!empty($post['inactivar'])) {
//            $con->query($querydesact) or die($con->error);
//        }
    }

