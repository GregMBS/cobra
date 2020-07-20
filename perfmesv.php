<?php

use cobra_salsa\PdoClass;
use cobra_salsa\PerfmesClass;
use cobra_salsa\PerfmesAllClass;

$day_esp	 = array("DOM", "LUN", "MAR", "MIE", "JUE", "VIE", "SAB");
require_once 'classes/PdoClass.php';
$pdac		 = new PdoClass();
$pdo		 = $pdac->dbConnectAdmin();
require_once 'classes/PerfmesClass.php';
$hc		 = new PerfmesClass($pdo);
require_once 'classes/PerfmesAllClass.php';
$hac		 = new PerfmesAllClass($pdo);
$yr		 = date('Y', strtotime('last day of previous month'));
$mes		 = date('m', strtotime('last day of previous month'));
$dhoy		 = date('d', strtotime('last day of previous month'));
$hoy		 = date('Y-m-d', strtotime('last day of previous month'));
$capt		 = filter_input(INPUT_GET, 'capt');
$resultwd	 = $hc->countVisitadorDays();
$dst = '';
require_once __DIR__ . '/views/visitadorTimesheetView.php';