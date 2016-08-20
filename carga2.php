<?php
require_once 'classes/pdoConnect.php';
require_once 'classes/CargaClass.php';
$pdoc = new pdoConnect();
$pdo = $pdoc->dbConnectAdmin();
$cc = new CargaClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$post = filter_input_array(INPUT_POST);
$go = filter_input(INPUT_POST, 'go');
$cliente = filter_input(INPUT_POST, 'cliente');
$fecha_de_actualizacion = filter_input(INPUT_POST, 'fecha_de_actualizacion');
$flag = ($_FILES["file"]["error"] == 0);
if ($go == 'cargar') {
    if ($flag) {
        $filename = $cc->moveLoadedFile();
        require_once 'views/fileLoadResultsView.php';
    } else {
        ?>
        <p>Error: <?php echo $_FILES["file"]["error"]; ?></p>
        <?php
    }
    $data = $cc->getCsvData($filename);
    $num = count($data);
    $dataNames = $cc->getCsvData($data);
    $dbNames = $cc->getDBColumnNames();
    $oops = array_diff($dataNames, $dbNames);
    if (empty($oops)) {
        $cc->prepareTemp($dataNames);
        echo "<p>Preparada para cargar datos.</p>";
        $cc->loadData($pdo, $data, $dataNames);
        echo "<p>Datos cardados.</p>";
        $fieldlist = $cc->prepareUpdate($columnNames);
        $cc->updateResumen($pdo, $fieldlist);
        echo "<p>Cuentas actualizadas.</p>";
        $cc->insertIntoResumen($pdo, $fieldlist);
        echo "<p>Cuentas nuevas instaladas.</p>";
        $cc->updateClientes($pdo);
        echo "<p>Tabla de clientes actualizada.</p>";
        $cc->updatePagos($pdo);
        echo "<p>Pagos actualizados.</p>";
        $cc->createLookupTable($pdo);
        echo "<p>Table 'lookup' actualizada.</p>";
        echo "<p><a href='segmentoadmin.php?capt=$capt'>Actialuzar segmentos.</a></p>";
    } else {
        require_once 'views/badNamesView.php';
        die();
    }
}
