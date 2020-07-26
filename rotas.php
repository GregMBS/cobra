<?php

use cobra_salsa\PdoClass;
use cobra_salsa\RotasClass;

require_once 'classes/PdoClass.php';
$pc     = new PdoClass();
$pdo    = $pc->dbConnectUser();
require_once 'classes/RotasClass.php';
$rc     = new RotasClass($pdo);
$capt   = $pd->capt;
$result = $rc->getRotas($capt);
var_dump($result);
die();
require_once 'views/rotasView.php';