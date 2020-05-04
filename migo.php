<?php

use cobra_salsa\PdoClass;
use cobra_salsa\MigoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/MigoClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectUser();
$mc = new MigoClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$result = $mc->userReport($capt);
require_once 'views/migoView.php';
