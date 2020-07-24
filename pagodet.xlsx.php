<?php

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
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_GET, 'go');
$thismonth = strftime("%B %Y");
$lastmonth = strftime("%B %Y", strtotime("last month"));
$result = $pc->querySheet();
$filename = "Pagos_" . trim(date('Y_m')) . ".xlsx";
$header = array_keys($result[0]);
$output = [];
foreach ($result as $row) {
    $output[] = array_values($row);
}
try {
    var_dump($output);
    die();
    $oc->writeXLSXFile($filename, $output, $header);
} catch (Exception $e) {
    die($e->getMessage());
}
