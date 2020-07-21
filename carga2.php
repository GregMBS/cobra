<?php

use cobra_salsa\CargaClass;
use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/CargaClass.php';

$pc    = new PdoClass();
$con     = $pc->dbConnectAdminMysqli();
$capt    = $pc->capt;
$post = filter_input_array(INPUT_POST);
$cc = new CargaClass($pc->dbConnectAdmin());
?>
<!DOCTYPE HTML>

<html lang="es">
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
                    <form action="/carga2.php" method="post" name="clientepick">
                        <table>
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
                <form action="/carga2.php" method="post" name="assoc">
                    <?php
                    list($cliente, $post, $fecha_de_actualizacion, $filename, $handle, $data, $num) = $cc->clientePick($con, $post);
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
                </form>

                <table>
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
                                        <select form="assoc" name="pos<?php
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
                                <input form="assoc" type="hidden" value="nousar" name="pos<?php
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
                    <p>
                        <input form="assoc" type="hidden" name="maxc" value="<?php echo $c ?>" />
                        <input form="assoc" type="hidden" name="capt" value="<?php echo $capt ?>" />
                        <input form="assoc" type="submit" name="go" value="asociar" />
                    </p>
            <?php
        }

        if ($post['go'] == 'asociar') {
            $cc->asociar($con, $post);
        }
    }
?>
    </body>
</html>
