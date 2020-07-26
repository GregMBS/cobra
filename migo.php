<?php

use cobra_salsa\MigoClass;
use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/MigoClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectUser();
$mc = new MigoClass($pdo);
$capt = $pd->capt;
$tipo = $pd->tipo;
require_once 'views/migoView.php';
