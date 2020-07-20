<?php

use cobra_salsa\PdoClass;
use cobra_salsa\QueuesqcClass;

require_once 'classes/PdoClass.php';
require_once 'classes/QueuesQCClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
$qc = new QueuesqcClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');

$resultq = $qc->getQueues();
$result = $qc->getMain();
require_once 'views/queuesqcView.php';
