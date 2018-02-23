<?php


use App\GccInventarioClass;
use App\OutputClass;

set_time_limit(300);

$ic = new GccInventarioClass();
$oc   = new OutputClass();

$go = filter_input(INPUT_GET, 'go');
if (!empty($go)) {
    $cliente    = filter_input(INPUT_GET, 'cliente');
    $result = $ic->getInventarioReport($cliente);
    $filename = "Query_de_inventario_".date('ymd').".xlsx";
    $headers  = array_keys($result[0]);
    $oc->writeXLSXFile($filename, $result, $headers);
} else {
    $resultc = $ic->listClients();
    $here = 'inventario.xls.php';
    require_once 'views/inventarioView.php';
}
