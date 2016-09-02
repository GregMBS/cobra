<?php

use cobra_salsa\PdoClass;
use cobra_salsa\MigoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/MigoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$mc = new MigoClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_GET, 'go');
$result = $mc->adminReport();
require_once 'views/migoView.php';
