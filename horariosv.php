<?php

require_once __DIR__ . '/timesheetHead.php';
$visitadores = $hc->listVisitadores();
var_dump($visitadores);
die();
$sheet = [];
$sum = [];
foreach ($visitadores as $gestor) {
//    $sheet[$nombre] = $hc->prepareVisitSheet($hc, $nombre, $dhoy);
//    $sum[$nombre] = $hc->prepareMonthSum($sheet[$nombre]);
    $sheet[$gestor] = [];
    $sum[$gestor] = [];
}
require_once __DIR__ . '/views/visitadorTimesheetView.php';