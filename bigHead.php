<?php

set_time_limit(300);
require_once 'vendor/autoload.php';

use cobra_salsa\BigClass;
use cobra_salsa\OutputClass;
use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/BigClass.php';
require_once 'classes/BigInputObject.php';
require_once 'classes/OutputClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
$bc = new BigClass($pdo);
$oc = new OutputClass();
$capt = filter_input(INPUT_GET, 'capt');
$fecha1 = filter_input(INPUT_GET, 'fecha1');
$fecha2 = filter_input(INPUT_GET, 'fecha2');
