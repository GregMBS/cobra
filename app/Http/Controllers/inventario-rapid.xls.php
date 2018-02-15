<?php

use cobra_salsa\PdoClass;
use cobra_salsa\InventarioClass;
use cobra_salsa\OutputClass;

require_once 'classes/PdoClass.php';
require_once 'classes/InventarioClass.php';
require_once 'classes/OutputClass.php';

set_time_limit(300);

$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$ic = new InventarioClass($pdo);
$capt = $pdoc->capt;
$oc   = new OutputClass();
set_time_limit(180);

$go = filter_input(INPUT_GET, 'go');
if (!empty($go)) {
    $cliente    = filter_input(INPUT_GET, 'cliente');
    $result = $ic->getInventarioReport($cliente);
    $filename = "Query_de_inventario_".date('ymd').".xlsx";
    $headers  = array_keys($result[0]);
    $oc->writeXLSXFile($filename, $result, $headers);
} else {
    $resultc = $ic->listClients();
    $here = 'inventario-rapid.xls.php';
    require_once 'views/inventarioView.php';
}
