<?php

require_once 'pdoConnect.php';
$pdoc = new pdoConnect();
$pdo = $pdoc->dbConnectAdmin();
require_once 'RobotClass.php';
$rc = new RobotClass($pdoc);
$capt = filter_input(INPUT_GET, 'capt');
if (empty($capt)) {
    $capt = filter_input(INPUT_POST, 'capt');
}
$go = filter_input(INPUT_POST, 'go');
$killall = filter_input(INPUT_POST, 'killall');
$cleanslate = filter_input(INPUT_POST, 'cleanslate');
$countreset = filter_input(INPUT_POST, 'countreset');
$auto = filter_input(INPUT_POST, 'auto');
$lines = filter_input(INPUT_POST, 'lines');
if (!empty($killall)) {
    $rc->stopAllQueues();
}
if (!empty($cleanslate)) {
    $rc->eraseAllQueues();
}
if (!empty($countreset)) {
    $rc->resetCounter();
}
if (!empty($auto)) {
    $process = $lines;
    if ($process == 'CAMBIAR') {
        $rc->changeLineCount($auto, $lineas);
    }
    if ($process == 'BORRAR') {
        $rc->eraseOneQueue($auto);
    }
}
$resulta = $rc->getReport();
$result = $rc->getMessageList();
