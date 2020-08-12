<?php

$gestores = $hc->listGestores();
$sheet = [];
$sum = [];
foreach ($gestores as $gestor) {
    $nombre = $gestor['c_cvge'];
    $sheet[$nombre] = $hc->prepareSheet($nombre, $dhoy);
    $sum[$nombre] = $hc->prepareMonthSum($sheet[$nombre]);
}
var_dump($sheet);
var_dump($sum);
die();
require_once __DIR__ . '/views/timesheetView.php';