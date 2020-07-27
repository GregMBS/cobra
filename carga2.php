<?php

use cobra_salsa\CargaClass;
use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/CargaClass.php';

$pc    = new PdoClass();
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
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la plantilla administrativa</button><br>
        <form action="carga2.php" method="post" enctype="multipart/form-data" name="cargar">
            <p>Filename:
                <input type="hidden" name="capt" id="capt" value="<?php echo $pd->capt ?>" />
                <input type="file" name="file" id="file"><br>
                <button type="submit" name="go" value="cargar">Elegir archivo</button>
            </p>
        </form>
        <?php
        $post = filter_input_array(INPUT_POST);
        $get = filter_input_array(INPUT_GET);
$go = $post['go'];
$capt = $post['capt'];
if (empty($capt)) {
    $capt = $get['capt'];
}
switch ($go) {

    case 'cargar':
        if ($_FILES["file"]["error"] > 0) {
            echo "<p>Error: " . $_FILES["file"]["error"] . "</p>";
        } else {
            echo "<p>Upload: " . $_FILES["file"]["name"] . "<br>";
            echo "Type: " . $_FILES["file"]["type"] . "<br>";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br>";
            echo "Stored in: " . $_FILES["file"]["tmp_name"];
            $destination = $cc->moveLoadedFile();
            echo "Stored in: " . $destination . "</p>";
            ?>
            <p>
            <form action="/carga2.php" method="post" name="clientePick">
                <table>
                    <tr><td><label for="pickCliente">Client</label></td>
                        <td><input type="text" name="cliente" id="pickCliente" />
                            <input type="hidden" name="filename" value="<?php
                            echo $destination
                            ?>" />
                            <input type="hidden" name="capt" value="<?php echo $capt ?>" />
                        </td></tr>
                </table>
                <button type="submit" name="go" value="clientePick">Elegir cliente</button>
            </form>
            <?php
        }
        break;

    case 'clientePick':
        ?>
        <p>
        <form action="/carga2.php" method="post" name="assoc">
            <?php
            list($cliente, $post, $fecha_de_actualizacion, $filename, $handle, $data, $num) = $cc->clientePick($post);
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
            $cargadexCount = $cc->countCargadex($cliente);

            if ($cargadexCount == 0) {

                for ($c = 0; $c < $num; $c++) {

                    if (!empty($data[$c])) {
                        ?>
                        <tr><td><label for="pos<?php
                                echo $c
                                ?>"><?php
                                    echo trim($data[$c])
                                    ?></label></td>
                            <td>
                                <select form="assoc" name="pos<?php
                                echo $c
                                ?>" id="pos<?php
                                echo $c
                                ?>">
                                    <option value='nousar<?php echo $c ?>'>no usar</option>
                                    <?php
                                    $columns = $cc->getDBColumnNames();
                                    $k = count($columns);

                                    foreach ($columns as $k => $column) {
                                        ?>
                                        <option value='<?php echo $k ?>'<?php
                                        if (trim($data[$c]) == $column) {
                                            echo " selected='selected'";
                                        }
                                        ?>><?php echo $column; ?></option>
                                        <?php
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
                $cargadex = $cc->getCargadex($cliente);

                foreach ($cargadex as $dex) {
                    echo $data[$c] . " " . $dex->field . " " . $dex->type . " " . $dex->nullok . "<br>";
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
        break;

            case 'asociar':
                try {
                    $cc->asociar($post);
                } catch (Exception $e) {
                    die($e->getMessage());
                }
                break;
}

?>
    </body>
</html>
