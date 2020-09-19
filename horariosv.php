<?php

require_once __DIR__ . '/timesheetHead.php';
$visitadores = $hc->listVisitadores();
var_dump($visitadores);
$sheet = [];
$sum = [];
foreach ($visitadores as $gestor) {
    $nombre = $gestor['c_visit'];
//    $sheet[$nombre] = $hc->prepareVisitSheet($hc, $nombre, $dhoy);
//    $sum[$nombre] = $hc->prepareMonthSum($sheet[$nombre]);
    $sheet[$nombre] = [];
    $sum[$nombre] = [];
}
require_once __DIR__ . '/views/visitadorTimesheetView.php';