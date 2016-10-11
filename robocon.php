<?php

require_once 'pdoConnect.php';
$pdoc = new pdoConnect();
$pdo = $pdoc->dbConnectAdmin();
require_once 'RobotClass.php';
$rc = new RobotClass($pdoc);
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_GET, 'go');
$killall = filter_input(INPUT_GET, 'killall');
$cleanslate = filter_input(INPUT_GET, 'cleanslate');
$countreset = filter_input(INPUT_GET, 'countreset');
$auto = filter_input(INPUT_GET, 'auto');
$lineas = filter_input(INPUT_GET, 'lineas');
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
    if ($go == 'CAMBIAR') {
        $rc->changeLineCount($auto, $lineas);
    }
    if ($go == 'BORRAR') {
        $rc->eraseOneQueue($auto);
    }
}
$resulta = $rc->getReport();
$result = $rc->getQueues();
require_once 'roboconView.php';