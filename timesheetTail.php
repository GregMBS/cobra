<?php

$gestores = $hc->listGestores();
var_dump($gestores);die();
$sheet = [];
$sum = [];
foreach ($gestores as $gestor) {
    $nombre = $gestor['c_cvge'];
    $sheet[$nombre] = $hc->prepareSheet($nombre, $dhoy);
    $sum[$nombre] = $hc->prepareMonthSum($sheet[$nombre]);
}
require_once __DIR__ . '/views/timesheetView.php';