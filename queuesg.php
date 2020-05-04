<?php

use cobra_salsa\PdoClass;
use cobra_salsa\QueuesgClass;

require_once 'classes/PdoClass.php';
require_once 'classes/QueuesgClass.php';
$pd = new PdoClass();
$pdo  = $pd->dbConnectUser();
$qc = new QueuesgClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$go   = filter_input(INPUT_GET, 'go');
$msg  = "";
if ($go == 'INTRO') {
    $cliente     = filter_input(INPUT_GET, 'cliente');
    $sdc         = filter_input(INPUT_GET, 'sdc');
    $queue       = filter_input(INPUT_GET, 'queue');
    $camp = $qc->getCamp($cliente, $queue, $sdc, $capt);
    if (empty($camp)) {
        $camp = -1;
    }
    if ($camp >= 0) {
        $qc->setCamp($camp, $capt);
        $msg      = "<h2>Se elige queue ".$cliente." ".$sdc." ".$queue."</h2>";
    }
} else {
    $msg = "<h2>Se elige queue bloqueado o equivocado.</h2>";
}

$arrayc  = '[';
$arrays  = '[';
$arrayq  = '[';
$resultc = $qc->getClients();
foreach ($resultc as $rowc) {
    $arrayc .= '"'.$rowc['cliente'].'",';
}
$arrayc  = $arrayc.']';
$results = $qc->getSdcClients($capt);
foreach ($results as $rows) {
    $arrays .= '["'.$rows['sdc'].'","'.$rows['cliente'].'"],';
}
$arrays  = rtrim($arrays, ',').']';
$resultsa= $qc->getQueueSdcClients($capt);
foreach ($resultsa as $rowsa) {
    $arrayq .= '["'. $rowsa['status_aarsa'].'","'
        . $rowsa['sdc'].'","'
        . $rowsa['cliente'].'"],';
}
$arrayq = rtrim($arrayq, ',').']';
require_once 'views/queuesgView.php';