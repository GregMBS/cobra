<?php

$gestores = $hc->listGestores();
$sheet = [];
$sum = [];
foreach ($gestores as $gestor) {
    $nombre = $gestor['c_cvge'];
    $sheet[$nombre] = $hc->prepareSheet($hc, $nombre, $dhoy);
    $sum[$nombre] = $hc->prepareMonthSum($sheet[$nombre]);
}
require_once __DIR__ . '/views/timesheetView.php';