<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\QueuesqcClass;

require_once 'classes/PdoClass.php';
require_once 'classes/QueuesqcClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
$qc = new QueuesqcClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');

$resultq = $qc->getQueues();
$result = $qc->getMain();
require_once 'views/queuesqcView.php';
