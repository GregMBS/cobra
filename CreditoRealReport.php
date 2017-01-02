<?php

use cobra_salsa\OutputClass;

require_once 'CreditoRealModels.php';
$cr = new CreditoRealModels();
require_once 'classes/OutputClass.php';
$cc = new OutputClass();
$output = array();
$fromModel = $cr->outputReport();
$headers = $fromModel['headers'];
$data = $fromModel['data'];
$filename = 'CreditoRealReport';

foreach ($data as $row) {
    $output[]=$row;
}
if ($output) {
    $cc->writeCSVFile($filename, $output, $headers);
} else {
    var_dump($output);die();
}
