<?php
use app\PagobulkClass;

use app\PdoClass;
require_once 'classes/PagobulkClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$pbc = new PagobulkClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
if (empty($capt)) {
    $capt = filter_input(INPUT_POST, 'capt');
}
$go = filter_input(INPUT_POST, 'go');
$input = filter_input(INPUT_POST, 'data');
$message = '';
if ($go == 'cargar') {
    $message = $pbc->main($input);
}
?>
<!DOCTYPE HTML>

<html>
    <head>
        <title>Capturar Pagos Confirmados</title>
        <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    </head>
    <body>
        <form action="pagobulk.php" method="post" name="cargar">
            <p>Usa formato CUENTA,FECHA(2011-01-31),MONTO(1234.56)</p>
            <textarea name='data' rows='20' cols='50'></textarea>
            <input type="hidden" name="capt" value="<?php
            echo $capt
            ?>" />
            <button type="submit" name="go" value="cargar">Cargar</button>
        </p>
    </form>
    <?php echo $message; ?>
    <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">
        Regresar a la plantilla administrativa
    </button>
    <br>
</body>
</html>
