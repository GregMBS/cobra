<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\PerfmesClass;
use gregmbs\cobra\PerfmesAllClass;

$day_esp	 = array("DOM", "LUN", "MAR", "MIE", "JUE", "VIE", "SAB");
require_once 'classes/PdoClass.php';
$pdac		 = new PdoClass();
$pdo		 = $pdac->dbConnectAdmin();
require_once 'classes/PerfmesClass.php';
$pc		 = new PerfmesClass($pdo);
require_once 'classes/PerfmesAllClass.php';
$pac		 = new PerfmesAllClass($pdo);
$yr		 = date('Y', strtotime('last day of previous month'));
$mes		 = date('m', strtotime('last day of previous month'));
$dhoy		 = date('d', strtotime('last day of previous month'));
$hoy		 = date('Y-m-d', strtotime('last day of previous month'));
$capt		 = filter_input(INPUT_GET, 'capt');
$resultwd	 = $pc->countVisitadorDays();
foreach ($resultwd as $answerwd) {
	$expw1	 = $answerwd['sfs'] * 15;
	$expw2	 = $answerwd['sss'] * 15;
}
$dst = '';
require_once 'views/perfmesvView.php';
