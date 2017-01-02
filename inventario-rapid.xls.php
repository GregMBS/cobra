<?php

use cobra_salsa\PdoClass;
use cobra_salsa\CsvClass;
use cobra_salsa\InventarioClass;

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
    $filename = "Query_de_inventario_" . trim(date('ymd')) . ".csv";
    $headers = array_keys($result[0]);
    $data = $result;
    $cc->writeCSVFile($filename, $data, $headers);
} else {
    $resultc = $ic->listClients();
    $here = 'inventario-rapid.php';
    require_once 'views/inventarioView.php';
} 
