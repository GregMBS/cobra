<?php

use cobra_salsa\PdoClass;
use cobra_salsa\PerfmesAllClass;
use cobra_salsa\PerfmesClass;

$day_esp = array("DOM", "LUN", "MAR", "MIE", "JUE", "VIE", "SAB");
require_once 'classes/PdoClass.php';
$pdac = new PdoClass();
$pdo = $pdac->dbConnectAdmin();
require_once 'classes/PerfmesClass.php';
$hc = new PerfmesClass($pdo);
require_once 'classes/PerfmesAllClass.php';
$hac = new PerfmesAllClass($pdo);
$yr = date('Y', strtotime('last day of previous month'));
$mes = date('m', strtotime('last day of previous month'));
$dhoy = date('d', strtotime('last day of previous month'));
$hoy = date('Y-m-d', strtotime('last day of previous month'));
$capt = filter_input(INPUT_GET, 'capt');
$resultwd = $hc->countVisitadorDays();
$dst = '';
$visitadores = $hc->listVisitadores();
$sheet = [];
$sum = [];
foreach ($visitadores as $visitador) {
    $mySheet = [];
    $mySum = [];
    if (!empty($visitador)) {
        $mySheet = $hc->prepareVisitSheet($visitador, $dhoy);
        echo '<br>';
        $mySum = $hc->prepareMonthSum($mySheet);
        $sheet[$visitador] = $mySheet;
        $sum[$visitador] = $mySum;
    }
}
require_once __DIR__ . '/views/visitadorTimesheetView.php';