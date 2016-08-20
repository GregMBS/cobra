<?php
require_once 'classes/pdoConnect.php';
require_once 'classes/CargaClass.php';
$pdoc = new pdoConnect();
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
    }
    $header = $cc->getCsvData($filename, true);
    $num = count($header);
    $dataNames = $cc->getDataColumnNames($header);
    $dbNames = $cc->getDBColumnNames();
    $oops = array_diff($dataNames, $dbNames);
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
}
