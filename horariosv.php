<?php

require_once __DIR__ . '/timesheetHead.php';
$visitadores = $hc->listVisitadores();
$sheet = [];
$sum = [];
var_dump($visitadores);
foreach ($visitadores as $gestor) {
    if ($gestor) {
        print_r($gestor);
        $mySheet = $hc->prepareVisitSheet($hc, $gestor, $dhoy);
        var_dump($mySheet);
        echo '<br>';
        $mySum = $hc->prepareMonthSum($sheet[$gestor]);
        $sheet[$gestor] = $mySheet;
        $sum[$gestor] = $mySum;
//    $sheet[$gestor] = [];
//    $sum[$gestor] = [];
    }
}
require_once __DIR__ . '/views/visitadorTimesheetView.php';