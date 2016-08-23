<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo  = $pdoc->dbConnectUser();
$capt = filter_input(INPUT_GET, 'capt');
$go   = filter_input(INPUT_GET, 'go');
$msg  = "";
if ($go == 'INTRO') {
    $cliente     = filter_input(INPUT_GET, 'cliente');
    $sdc         = filter_input(INPUT_GET, 'sdc');
    $queue       = filter_input(INPUT_GET, 'queue');
    $queryqueue  = "select camp from queuelist
where cliente=:cliente
and status_aarsa=:queue
and sdc=:sdc
and gestor=:capt
and bloqueado=0 limit 1
";
    $stq         = $pdo->prepare($queryqueue);
    $stq->bindParam(':cliente', $cliente);
    $stq->bindParam(':queue', $queue);
    $stq->bindParam(':sdc', $sdc);
    $stq->bindParam(':capt', $capt);
    $stq->execute();
    $resultqueue = $stq->fetch(\PDO::FETCH_ASSOC);
    if ($resultqueue) {
        $camp = $resultqueue['camp'];
    } else {
        $camp = -1;
    }
    if ($camp >= 0) {
        $queryupd = "UPDATE nombres SET camp=:camp "
            . "where iniciales=:capt;";
        $stu = $pdo->prepare($queryupd);
        $stu->bindParam(':camp', $camp);
        $stu->bindParam(':capt', $capt);
        $stu->execute();
        $msg      = "<h2>Se elige queue ".$cliente." ".$sdc." ".$queue."</h2>";
    }
} else {
    $msg = "<h2>Se elige queue bloqueado o equivocado.</h2>";
}

$arrayc  = '[';
$arrays  = '[';
$arrayq  = '[';
$queryc  = "SELECT distinct cliente
FROM queuelist where cliente<>''
ORDER BY cliente;";
$resultc = $pdo->query($queryc);
foreach ($resultc as $rowc) {
    $arrayc = $arrayc.'"';
    $arrayc = $arrayc.$rowc['cliente'].'",';
}
$arrayc  = $arrayc.']';
$querys  = "SELECT distinct sdc,cliente
FROM queuelist WHERE gestor = :capt and bloqueado=0 and cliente<>''
ORDER BY cliente,sdc,status_aarsa;";
        $sts = $pdo->prepare($querys);
        $sts->bindParam(':capt', $capt);
        $sts->execute();
        $results=$sts->fetchAll(\PDO::FETCH_ASSOC);
foreach ($results as $rows) {
    $arrays = $arrays.'["';
    $arrays = $arrays.$rows['sdc'].'","'.$rows['cliente'].'"],';
}
$arrays  = rtrim($arrays, ',').']';
$querysa  = "SELECT distinct status_aarsa,sdc,cliente
FROM queuelist WHERE gestor = :capt and bloqueado=0
ORDER BY cliente,sdc,status_aarsa;";
        $stsa = $pdo->prepare($querysa);
        $stsa->bindParam(':capt', $capt);
        $stsa->execute();
        $resultsa=$stsa->fetchAll(\PDO::FETCH_ASSOC);
foreach ($resultsa as $rowsa) {
    $arrayq = $arrayq.'["';
    $arrayq = $arrayq
        . $rowsa['status_aarsa'].'","'
        . $rowsa['sdc'].'","'
        . $rowsa['cliente'].'"],';
}
$arrayq = rtrim($arrayq, ',').']';
require_once 'views/queuesgView.php';