<?php

use cobra_salsa\PdoClass;
use cobra_salsa\QueueManualClass;

require_once 'classes/PdoClass.php';
require_once 'classes/QueueManualClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$qc = new QueueManualClass($pdo);
$capt		 = filter_input(INPUT_GET, 'capt');
$result		 = $qc->getReport();
require_once 'views/reporteManualView.php';