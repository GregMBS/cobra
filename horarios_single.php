<?php

use cobra_salsa\HorariosAllClass;
use cobra_salsa\HorariosClass;
use cobra_salsa\PdoClass;
use cobra_salsa\TimesheetDayObject;
use cobra_salsa\TimesheetViewClass;

require_once 'classes/PdoClass.php';
require_once 'classes/TimesheetDayObject.php';
require_once 'timesheetHead.php';
$dhoy++;
$gestores = [];
$gestor = filter_input(INPUT_GET, 'gestor');
if ($gestor === 'total') {
    $gestor = '';
}
$gestores = $hc->listGestores();
/** @var TimesheetDayObject[] $sheet */
$sheet = [];
$sum = [];
if (!empty($gestor)) {
    $sheet[$gestor] = $hc->prepareSheet($gestor, $dhoy);
    $sum[$gestor] = $hc->prepareMonthSum($sheet[$gestor]);
    require_once __DIR__ . '/views/horarioView.php';
}
else {
    require_once __DIR__ . '/views/timesheetTotalView.php';
}