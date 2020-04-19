<?php
require_once 'vendor/autoload.php';

use cobra_salsa\PdoClass;
use cobra_salsa\PagosClass;
use cobra_salsa\OutputClass;

$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
$pgc = new PagosClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$fecha1 = filter_input(INPUT_GET, 'fecha1');
$fecha2 = filter_input(INPUT_GET, 'fecha2');
$cliente = filter_input(INPUT_GET, 'cliente');
$resultc = $pgc->listClientes();
if (filter_has_var(INPUT_GET, 'go')) {
    $result = $pgc->queryAll($fecha1, $fecha2, $cliente);
    if (empty($result)) {
        require_once 'views/pagosqueryView.php';
    } else {
        $oc = new OutputClass();
        $filename = "pagos.xlsx";
        $headers = array_keys($result[0]);
        $oc->writeXLSXFile($filename, $result, $headers);
    }
} else {
    require_once 'views/pagosqueryView.php';
}