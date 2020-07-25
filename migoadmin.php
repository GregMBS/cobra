<?php

use cobra_salsa\PdoClass;
use cobra_salsa\MigoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/MigoClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
$mc = new MigoClass($pdo);
$capt = $pd->capt;
$go = filter_input(INPUT_GET, 'go');
$main = $mc->adminReport();
require_once 'views/migoView.php';
