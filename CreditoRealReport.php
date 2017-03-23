<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\OutputClass;
use gregmbs\cobra\CreditoRealClass;

require_once 'classes/PdoClass.php';
require_once 'classes/CreditoRealClass.php';
require_once 'classes/OutputClass.php';

$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$cr = new CreditoRealClass($pdo);
$cc = new OutputClass();
$output = array();
$fromModel = $cr->outputReport();
$headers = $fromModel['headers'];
$data = $fromModel['data'];
$filename = 'CreditoRealReport.csv';

if ($data) {
    $cc->writeCSVFile($filename, $data, $headers);
}
