<?php

use cobra_salsa\PdoClass;
use cobra_salsa\RotasClass;

require_once 'classes/PdoClass.php';
$pc     = new PdoClass();
$pdo    = $pc->dbConnectUser();
require_once 'classes/RotasClass.php';
$rc     = new RotasClass($pdo);
$capt   = filter_input(INPUT_GET, 'capt');
$result = $rc->getRotas($capt);
require_once 'views/rotasView.php';