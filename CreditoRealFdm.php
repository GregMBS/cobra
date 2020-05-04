<?php

use cobra_salsa\PdoClass;
use cobra_salsa\OutputClass;
use cobra_salsa\CreditoRealClass;

require_once 'classes/PdoClass.php';
require_once 'classes/CreditoRealClass.php';
require_once 'classes/OutputClass.php';

$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
$cr = new CreditoRealClass($pdo);
$cc = new OutputClass();
$output = array();
$fromModel = $cr->outputMonthlyReport();
$headers = $fromModel['headers'];
$data = $fromModel['data'];
$filename = 'CreditoRealReport.csv';

if ($data) {
    $cc->writeCSVFile($filename, $data, $headers);
}
