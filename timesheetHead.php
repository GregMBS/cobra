<?php

use cobra_salsa\HorariosAllClass;
use cobra_salsa\HorariosClass;
use cobra_salsa\PdoClass;
use cobra_salsa\TimesheetViewClass;

require_once 'classes/PdoClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
require_once 'classes/HorariosClass.php';
$hc = new HorariosClass($pdo);
require_once 'classes/HorariosAllClass.php';
$hac = new HorariosAllClass($pdo);
require_once __DIR__ . '/classes/TimesheetViewClass.php';
$tv = new TimesheetViewClass(TRUE);
$yr = date('Y');
$mes = date('m');
$hoy = date('Y-m-d');
$capt = $pd->capt;
$dhoy = (int)date('d');
