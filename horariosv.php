<?php

use cobra_salsa\HorariosClass;

require_once __DIR__ . '/timesheetHead.php';
require_once __DIR__ . '/classes/TimesheetDayObject.php';
/** @var HorariosClass $hc */
$visitadores = $hc->listVisitadores();
$sheet = [];
$sum = [];
foreach ($visitadores as $gestor) {
    $mySheet = [];
    $mySum = [];
    if (!empty($gestor)) {
        /** @var int $dhoy */
        $mySheet = $hc->prepareVisitSheet($gestor, $dhoy);
        echo '<br>';
        $mySum = $hc->prepareMonthSum($mySheet);
        $sheet[$gestor] = $mySheet;
        $sum[$gestor] = $mySum;
    }
}
require_once __DIR__ . '/views/visitadorTimesheetView.php';