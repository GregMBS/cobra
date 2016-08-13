<?php
require_once 'classes/pdoConnect.php';
$pdoc    = new pdoConnect();
$pdo     = $pdoc->dbConnectAdmin();
$capt    = filter_input(INPUT_GET, 'capt');
$go      = filter_input(INPUT_POST, 'go');
$dataRaw = filter_input(INPUT_POST, 'data');
?>
<!DOCTYPE HTML>

<html>
    <head>
        <title>Activar Cuentas</title>
    </head>
    <body>
        <form action="activar.php?capt=<?php echo $capt; ?>" method="post" name="cargar">
            <p>Usa numero de cuenta</p>
            <textarea name='data' rows='20' cols='50'></textarea>
            <input type="hidden" name="capt" value="<?php
            echo $capt
            ?>" />
            <button type="submit" name="go" value="cargar">Cargar</button>
        </p>
    </form>
    <?php
    if (!empty($go)) {

        if ($go == 'cargar') {

            $data      = preg_split("/[\s,]+/", $dataRaw, 0, PREG_SPLIT_NO_EMPTY);
            $max       = count($data);
            $queryload = '';
            $querydie  = "update resumen
set status_de_credito=substring_index(status_de_credito,'-',1)
where numero_de_cuenta=:cta";
            $std       = $pdo->prepare($querydie);
            for ($i = 0; $i < $max; $i++) {
                $std->bindParam(':cta', $data[$i]);
                $std->execute();
            }
            ?>
            <p>Cuentas est&aacute;n inactivadas</p>
        <?php }
    }
    ?>
    <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">
        Regresar a la plantilla administrativa
    </button><br>
</body>
</html>
