<?php

require_once __DIR__ . '/timesheetHead.php';
$visitadores = $hc->listVisitadores();
$sheet = [];
$sum = [];
foreach ($visitadores as $gestor) {
    $nombre = $gestor['c_visit'];
    $sheet[$nombre] = $hc->prepareVisitSheet($hc, $nombre, $dhoy);
    $sum[$nombre] = $hc->prepareMonthSum($sheet[$nombre]);
}
require_once __DIR__ . '/views/visitadorTimesheetView.php';