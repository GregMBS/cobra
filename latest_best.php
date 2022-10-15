<?php

ini_set('memory_limit', '2048M');
set_time_limit(300);
require_once 'vendor/autoload.php';

use cobra_salsa\BestClass;
use cobra_salsa\OutputClass;
use cobra_salsa\PdoClass;
use cobra_salsa\ResumenObject;

require_once 'classes/PdoClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
require_once 'classes/BestClass.php';
$bc = new BestClass($pdo);
$filename = "Ultimo_y_mejor_" . date('ymd') . ".xlsx";
$bc->createBestTemp();
$bc->createLastBest();
$stq = $bc->getLastBest();
$output = $stq->fetchAll(PDO::FETCH_ASSOC);
$count = count($output);
if ($count>0) {
    $header = array_keys(current($output));
    require_once 'classes/OutputClass.php';
    $oc = new OutputClass();
    try {
        $oc->writeXLSXFile($filename, $output, $header);
    } catch (Exception $e) {
        die($e->getMessage());
    }
} else {
    die('empty output');
}