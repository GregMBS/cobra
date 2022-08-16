<?php
set_time_limit(300);
use cobra_salsa\CargaClass;
use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/CargaClass.php';

$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
$capt = $pc->capt;
$post = filter_input_array(INPUT_POST);
$get = filter_input_array(INPUT_GET);
$cc = new CargaClass($pdo);
?>
<!DOCTYPE HTML>

<html lang="es">
<head>
    <title>COBRA Carga</title>
    <style>
        option.nousar {
            background-color: yellow;
            font-weight: bold;
        }
    </style>
</head>
<body>
<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la pagina administrativa
</button>
<br>
<form action="carga2.php" method="post" enctype="multipart/form-data" name="cargar">
    <p>Filename:
        <input type="hidden" name="capt" id="capt" value="<?php echo $capt ?>"/>
        <input type="file" name="file" id="file"><br>
        <button type="submit" name="go" value="cargar">Elegir archivo</button>
    </p>
</form>
<?php
$go = '';
if (array_key_exists('go', $post)) {
   $go = $post['go'];
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
            <form action="carga2.php" method="post" name="clientePick">
                <table>
                    <tr>
                        <td><label for="pickCliente">Client</label></td>
                        <td><input type="text" name="cliente" id="pickCliente"/>
                            <input type="hidden" name="filename" value="<?php
                            echo $destination;
                            ?>"/>
                            <input type="hidden" name="capt" value="<?php
                            echo $capt;
                            ?>"/>
                        </td>
                    </tr>
                </table>
                <button type="submit" name="go" value="clientePick">Elegir cliente</button>
            </form>
            <?php
        }
        break;

    case 'asociar':
        try {
            $cc->asociar($post);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        break;

    case 'clientePick':
        ?>
        <form action="carga2.php" method="post" name="assoc" id="aForm">
            <?php
            try {
                list($cliente, $post, $fecha_de_actualizacion, $filename, $header, $data, $num) = $cc->clientePick($post);
            } catch (Exception $e) {
                die($e->getMessage());
            }
            ?>
            <input name="cliente" type="hidden" value="<?php
            echo $cliente;
            ?>"/>
            <input name="fecha_de_actualizacion" type="hidden" value="<?php
            echo $fecha_de_actualizacion;
            ?>"/>
            <input type="hidden" name="filename" value='<?php
            echo $filename;
            ?>'/>
            <input type="hidden" name="capt" value="<?php
            echo $capt;
            ?>"/>
            <input type="hidden" name="capt" value="<?php echo $capt ?>"/>
            <input type="submit" name="go" id="aSubmit" value="asociar"/>

            <dl>
                <?php
                $cargadexCount = $cc->countCargadex($cliente);

                for ($c = 0; $c < $num; $c++) {

                    if (!empty($header[$c])) {
                        ?>
                            <dt>
                                <label for="pos<?php echo $c; ?>"><?php
                                    echo trim($header[$c])
                                    ?></label>
                            </dt>
                        <dd>
                            <select name="pos[]" id="pos<?php echo $c; ?>">
                                <option value='nousar<?php echo $c ?>' class="nousar">NO USAR</option>
                                <?php
                                $columns = $cc->getDBColumnNames();
                                $k = count($columns);

                                foreach ($columns as $k => $column) {
                                    ?>
                                    <option value='<?php echo $k ?>'<?php
                                    if (trim($header[$c]) == $column) {
                                        echo " selected='selected'";
                                    }
                                    ?>><?php echo $column; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </dd>
                        <?php
                    } else {
                        ?>
                        <input type="hidden" value="nousar" name="pos<?php
                        echo $c
                        ?>"/>
                        <?php
                    }
                }
                ?>
            </dl>
        </form>

        <?php
        break;
}

?>
</body>
</html>
