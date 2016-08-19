<?php
$day_esp	 = array("DOM", "LUN", "MAR", "MIE", "JUE", "VIE", "SAB");
include('pdoConnect.php');
$pdac		 = new pdoConnect();
$pdo		 = $pdac->dbConnectAdmin();
require_once 'PerfmesClass.php';
$pc		 = new PerfmesClass($pdo);
require_once 'PerfmesAllClass.php';
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