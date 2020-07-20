<?php

use cobra_salsa\PdoClass;
use cobra_salsa\HorariosClass;
use cobra_salsa\HorariosAllClass;

require_once 'classes/PdoClass.php';
$pc		 = new PdoClass();
$pdo		 = $pc->dbConnectAdmin();
require_once 'classes/HorariosClass.php';
$hc		 = new HorariosClass($pdo);
require_once 'classes/HorariosAllClass.php';
$hac		 = new HorariosAllClass($pdo);
$yr		 = date('Y');
$mes		 = date('m');
$dhoy		 = date('d');
$hoy		 = date('Y-m-d');
$capt		 = filter_input(INPUT_GET, 'capt');
$resultwd	 = $hc->countVisitadorDays();
$dst = '';
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");
require_once __DIR__ . '/views/visitadorTimesheetView.php';