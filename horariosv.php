<?php

require_once __DIR__ . '/timesheetHead.php';
$visitadores = $hc->listVisitadores();
$sheet = [];
$sum = [];
foreach ($visitadores as $gestor) {
    if ($gestor) {
        $sheet[$gestor] = $hc->prepareVisitSheet($hc, $gestor, $dhoy);
        $sum[$gestor] = $hc->prepareMonthSum($sheet[$gestor]);
//    $sheet[$gestor] = [];
//    $sum[$gestor] = [];
    }
}
require_once __DIR__ . '/views/visitadorTimesheetView.php';