<?php
require_once 'vendor/autoload.php';

use cobra_salsa\OutputClass;
use cobra_salsa\PagosClass;
use cobra_salsa\PdoClass;

require_once __DIR__ . '/classes/PdoClass.php';
require_once __DIR__ . '/classes/PagosClass.php';
require_once __DIR__ . '/classes/OutputClass.php';

$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
$pc = new PagosClass($pdo);
$oc = new OutputClass();
$capt = $pd->capt;
$go = filter_input(INPUT_GET, 'go');
if (isset($when)) {
    $dateString = strftime("%B_%Y", strtotime("last month"));
    $result = $pc->queryOldSheet();
} else {
        $dateString = strftime("%B_%Y");
        $result = $pc->querySheet();
}

$filename = "Pagos_" . $dateString . ".xlsx";
$header = get_object_vars($result[0]);
$output = [];
$output[] = array_keys($header);
foreach ($result as $row) {
    $row->monto = (float) $row->monto;
    $row->confirmado = (bool) $row->confirmado;
    $row->id_cuenta = (double) $row->id_cuenta;
    $output[] = (array) $row;
}
try {
    $oc->writeXLSXFile($filename, $output);
} catch (Exception $e) {
    die($e->getMessage());
}
