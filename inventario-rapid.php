<?php

use cobra_salsa\PdoClass;
use cobra_salsa\OutputClass;
use cobra_salsa\InventarioClass;

set_time_limit(300);
require_once 'classes/PdoClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
require_once 'classes/InventarioClass.php';
$ic = new InventarioClass($pdo);
require_once 'classes/OutputClass.php';
$oc = new OutputClass();
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_GET, 'go');
$cliente = filter_input(INPUT_GET, 'cliente');

if (!empty($go)) {
    $result = $ic->getInventarioReport($cliente);
    $filename = "Query_de_inventario_" . trim(date('ymd')) . ".csv";
    $headers = array_keys($result[0]);
    $data = $result;
    $oc->writeCSVFile($filename, $data, $headers);
} else {
    $resultc = $ic->listClients();
    $here = 'inventario-rapid.php';
    require_once 'views/inventarioView.php';
} 
