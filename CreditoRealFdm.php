<?php
require_once 'CreditoRealModels.php';
$cr = new CreditoRealModels();
require_once 'DownloadClass.php';
$dl = new DownloadClass;
$output = array();
$fromModel = $cr->outputMonthlyReport();
$headers = $fromModel['headers'];
$data = $fromModel['data'];

foreach ($data as $row) {
    $output[]=$row;
}
if ($output) {
    $dl->sendToCSV($headers,$output, 'CreditoRealReport');
} else {
    var_dump($output);die();
}
