<?php

use cobra_salsa\HorariosClass;
use cobra_salsa\PdoClass;
use cobra_salsa\TimesheetViewClass;

require_once 'classes/PdoClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
require_once 'classes/HorariosClass.php';
$hc = new HorariosClass($pdo);
require_once __DIR__ . '/classes/TimesheetViewClass.php';
$tv = new TimesheetViewClass();
$yr = date('Y');
$mes = date('m');
$dhoy = date('d');
$hoy = date('Y-m-d');
$capt = $pd->capt;
