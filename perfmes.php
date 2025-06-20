<?php

use cobra_salsa\PdoClass;
use cobra_salsa\PerfmesAllClass;
use cobra_salsa\PerfmesClass;
use cobra_salsa\TimesheetViewClass;

require_once 'classes/PdoClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
require_once 'classes/PerfmesClass.php';
$hc = new PerfmesClass($pdo);
require_once 'classes/PerfmesAllClass.php';
$hac = new PerfmesAllClass($pdo);
require_once __DIR__ . '/classes/TimesheetViewClass.php';
$tv = new TimesheetViewClass(FALSE);
$yr = date('Y', strtotime('last day of previous month'));
$mes = date('m', strtotime('last day of previous month'));
$dhoy = date('d', strtotime('last day of previous month'));
$hoy = date('Y-m-d', strtotime('last day of previous month'));
$capt = $pd->capt;
require_once __DIR__ . '/timesheetTail.php';