<?php

use gregmbs\cobra\PdoClass;
use cobra_salsa\CsvClass;
use gregmbs\cobra\InventarioClass;

set_time_limit(300);
require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
require_once 'classes/InventarioClass.php';
$ic = new InventarioClass($pdo);
require_once 'classes/CsvClass.php';
$cc = new CsvClass();
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_GET, 'go');
$cliente = filter_input(INPUT_GET, 'cliente');

if (!empty($go)) {
    $result = $ic->getInventarioReport($cliente);

// Creating a workbook
//$workbook = new Spreadsheet_Excel_Writer();

    $filename = "Query_de_inventario_" . trim(date('ymd')) . ".csv";
// sending HTTP headers
//$workbook->send($filename);
    header('Content-type: application/xls');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

// Creating a worksheet
//$worksheet =& $workbook->addWorksheet('Reporte CS');
//$worksheet->setInputEncoding('ISO-8859-1');


    $afield = array();
    $i = 0;
    foreach ($result[0] as $var => $value) {
        if ($var == 'numero_de_cuenta') {
            $nccol = $i;
        }
//	$worksheet->write(0, $i, $var);
        $afield[] = $var;
        $i++;
    }
    echo $cc->getCSV($afield);
    if (substr($cc->getCSV($afield), -1) != "\n") {
        echo "\n";
    }


    foreach ($result as $row) {
        echo $cc->getCSV($row);
        if (substr($cc->getCSV($row), -1) != "\n") {
            echo "\n";
        }
    }
//$workbook->close();
} else {
    $resultc = $ic->listClients();
    $here = $_SERVER['PHP_SELF'];
    require_once 'views/inventarioView.php';
} 
