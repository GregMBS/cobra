<?php

use cobra_salsa\PdoClass;
use cobra_salsa\QueuesClass;

require_once 'classes/PdoClass.php';
require_once 'classes/QueuesClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectUser();
$qc = new QueuesClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_GET, 'go');
$CAMP = filter_input(INPUT_GET, 'camp', FILTER_VALIDATE_INT);
$GESTOR = filter_input(INPUT_GET, 'gestor');
$QUEUE = filter_input(INPUT_GET, 'queue');
$QUEUES = explode(',', $QUEUE);
if (!empty($go)) {
    if (is_array($QUEUES)) {
        list($cliente, $sdc, $status) = $QUEUES;
    }
    
}
if ($go == 'INTRO') {
    $qc->updateQueue($CAMP, $GESTOR);
}
if ($go == 'BLOQUEAR') {
    $qc->blockQueue($CAMP, $GESTOR);
}
if ($go == 'DESBLOQUEAR') {
    $qc->unblockQueue($CAMP, $GESTOR);
}
if ($go == 'INTRO TODOS') {
    $qc->updateQueueAll($cliente, $sdc, $status);
}
if ($go == 'BLOQUEAR TODOS') {
    $qc->blockQueueAll($cliente, $sdc, $status);
}
if ($go == 'DESBLOQUEAR TODOS') {
    $qc->unblockQueueAll($cliente, $sdc, $status);
}

$resultList = $qc->getGestores();
$queues = $qc->getAllQueues();
require_once 'views/queuesView.php';
