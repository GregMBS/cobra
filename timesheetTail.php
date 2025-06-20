<?php

/** @var HorariosClass $hc */
/** @var HorariosAllClass $hac */

use cobra_salsa\HorariosAllClass;
use cobra_salsa\HorariosClass;

$gestores = $hc->listGestores();
$sheet = [];
$sum = [];
foreach ($gestores as $gestor) {
    $nombre = $gestor['c_cvge'];
    /** @var int $dhoy */
    $sheet[$nombre] = $hc->prepareSheet($nombre, $dhoy);
    $sum[$nombre] = $hc->prepareMonthSum($sheet[$nombre]);
    $sheet['TOTAL'] = $hac->prepareSheet('', $dhoy);
    $sum['TOTAL'] = $hc->prepareMonthSum($sheet['TOTAL']);
}
require_once __DIR__ . '/views/timesheetView.php';