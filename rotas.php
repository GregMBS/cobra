<?php

use cobra_salsa\PdoClass;
use cobra_salsa\RotasClass;

require_once 'classes/PdoClass.php';
$pd     = new PdoClass();
$pdo    = $pd->dbConnectUser();
require_once 'classes/RotasClass.php';
$rc     = new RotasClass($pdo);
$capt   = $pd->capt;
$result = $rc->getRotas($capt);
require_once 'views/rotasView.php';