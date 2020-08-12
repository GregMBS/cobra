<?php

use cobra_salsa\HorariosAllClass;

require_once __DIR__ . '/classes/HorariosAllClass.php';

$hac = new HorariosAllClass($pdo);
$gestores = $hc->listGestores();
$sheet = [];
$sum = [];
foreach ($gestores as $gestor) {
    $nombre = $gestor['c_cvge'];
    $sheet[$nombre] = $hc->prepareSheet($nombre, $dhoy);
    $sum[$nombre] = $hc->prepareMonthSum($sheet[$nombre]);
    $sheet['TOTAL'] = $hac->prepareSheet('', $dhoy);
    $sum['TOTAL'] = $hc->prepareMonthSum($sheet['TOTAL']);
}
require_once __DIR__ . '/views/timesheetView.php';