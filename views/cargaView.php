<!DOCTYPE HTML>

<html lang="es">
<head>
    <title>COBRA Carga</title>
    <style>
        #fields div {
            clear: both
        }
    </style>
</head>
<body>
<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la pagina administrativa</button>
<br>
<form action="/carga2.php" method="post" enctype="multipart/form-data" name="cargar">
    <p>Filename:
        <input type="hidden" name="capt" id="capt" value="<?php echo $capt ?>"/>
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
        $destination = "/tmp/" . $_FILES['file']['name'];
        move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
        echo "Stored in: " . $destination . "</p>";
        ?>
        <p>
        <form action="/carga2.php" method="post" name="clientePick">
            <table id="clientePick">
                <tr>
                    <td><label for="cliente">Client</label></td>
                    <td><input type="text" name="cliente" id="cliente"/>
                        <input type="hidden" name="filename" value="<?php
                        echo $destination
                        ?>"/>
                        <input type="hidden" name="capt" value="<?php echo $capt ?>"/>
                    </td>
                </tr>
            </table>
            <button type="submit" name="go" value="clientePick">Elegir cliente</button>
        </form>
        <?php
    }
}

if ($post['go'] == 'clientePick') {
?>
<p>
    <form action="/carga2.php" method="post" name="assoc">
        <?php
        $cc->clearCargadex($post['cliente']);
        $fecha_de_actualizacion = date('Y-m-d');
        if (isset($post['fecha_de_actualizacion'])) {
            if ($cc->validateDate($post['fecha_de_actualizacion'])) {
                $fecha_de_actualizacion = $post['fecha_de_actualizacion'];
            }
        }
        if ($cc->validateFilename($post['filename'])) {
            $filename = $post['filename'];
        }
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
        ?>"/>
        <input name="fecha_de_actualizacion" type="hidden" value="<?php
        echo $fecha_de_actualizacion
        ?>"/>
        <input type="hidden" name="filename" value='<?php
        echo $filename
        ?>'/>
        <input type="hidden" name="capt" value="<?php echo $capt ?>"/>
        <input type="hidden" name="maxc" value="<?php echo $c ?>"/>
        <div id="fields">
            <?php
            $position = $cc->getPosition($cliente);

            if ($position == 0) {

                for ($c = 0; $c < $num; $c++) {

                    if (!empty($data[$c])) {
                        ?>
                        <div><span><label for="pos<?php
                            echo $c
                            ?>"><?php
                                echo trim($data[$c])
                                ?></label></span>
                            <span>
                            <select name="pos<?php
                            echo $c
                            ?>" id="pos<?php
                            echo $c
                            ?>">
                                <option value='nousar<?php echo $c ?>'>no usar</option>
                                <?php
                                $k = 0;
                                $resumenColumns = $cc->getDBColumnNames();
                                foreach ($resumenColumns as $rc) {
                                    ?>
                                    <option value='<?php echo $k ?>'<?php
                                    if (trim($data[$c]) == $rc[0]) {
                                        echo " selected='selected'";
                                    }
                                    ?>><?php echo $rc[0]; ?></option>
                                    <?php
                                    $k++;
                                }
                                ?>
                            </select></span></div>
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
                $c = 0;
                $resultIndex = $cc->getCargadex($cliente);

                foreach ($resultIndex as $index) {
                    echo $data[$c] . " " . $index[1] . " " . $index[2] . " " . $index[3] . "<br>";
                    $c++;
                }
            }
            fclose($handle);
            }
            ?>
            <input type="submit" name="go" value="asociar"/>
        </div>
</form>
</body>
</html>
<?php
}
