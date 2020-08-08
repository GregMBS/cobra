<?php

use cobra_salsa\PdoClass;
use cobra_salsa\DhClass;

require_once 'classes/PdoClass.php';
$pc     = new PdoClass();
$pdo    = $pc->dbConnectAdmin();
require_once 'classes/DhClass.php';
$dc     = new DhClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$gestor = filter_input(INPUT_GET, 'gestor');
$fecha  = filter_input(INPUT_GET, 'fecha');
set_time_limit(300);
$result = $dc->getPromesas($gestor, $fecha);
require_once 'views/dhView.php';
