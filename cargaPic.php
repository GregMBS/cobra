<?php
require_once 'pdoConnect.php';
if (empty($pdoc)) {
    $pdoc = new pdoConnect();
    $pdo  = $pdoc->dbConnectAdmin();
    $capt = filter_input(INPUT_GET, 'capt');
}
?>
<!DOCTYPE HTML>

<html>
    <head>
        <title>COBRA Carga Foto</title>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <?php
        if (isset($result)) {
            ?>
            <h1>Foto para <?php echo $cuenta; ?> cargado.</h1>
            <?php
        }
        ?>
        <form action="cargaPicLoad.php" method="post" enctype="multipart/form-data" name="cargar">
            <p>
                <input type="hidden" name="capt" id="capt" value="<?php echo $capt ?>" />
                <label for="file">Filename:</label>
                <input type="file" name="file" id="file" accept="image/jpeg"><br>
                <label for="cuenta">Cuenta:</label>
                <input type="text" name="cuenta" id="cuenta"><br>
                <button type="submit" name="go" value="cargar">Elegir archivo</button>
            </p>
        </form>
    </body>
</html>