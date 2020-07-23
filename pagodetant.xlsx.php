<?php
require_once 'vendor/autoload.php';

use cobra_salsa\OutputClass;
use cobra_salsa\PagosClass;
use cobra_salsa\PdoClass;

require_once __DIR__ . '/classes/PdoClass.php';
require_once __DIR__ . '/classes/PagosClass.php';
require_once __DIR__ . '/classes/OutputClass.php';

$pd      = new PdoClass();
$pdo       = $pd->dbConnectAdmin();
$pc = new PagosClass($pdo);
$oc = new OutputClass();
$capt      = filter_input(INPUT_GET, 'capt');
$go        = filter_input(INPUT_GET, 'go');
$thismonth = strftime("%B %Y");
$lastmonth = strftime("%B_%Y", strtotime("last month"));
$result = $pc->queryOldSheet();
$filename = "Pagos_".$lastmonth.".xlsx";
$output   = array();
$output[] = array_keys($result[0]);
foreach ($result as $row) {
    $row['monto'] = (float) $row['monto'];
    $output[]     = $row;
}
try {
    $oc->writeXLSXFile($filename, $output);
} catch (Exception $e) {
    die($e->getMessage());
}
