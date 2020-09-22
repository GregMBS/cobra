<?php

require_once __DIR__ . '/timesheetHead.php';
require_once __DIR__ . '/classes/TimesheetDayObject.php';
$visitadores = $hc->listVisitadores();
$sheet = [];
$sum = [];
foreach ($visitadores as $gestor) {
    $mySheet = [];
    $mySum = [];
    if (!empty($gestor)) {
        $mySheet = $hc->prepareVisitSheet($gestor, $dhoy);
        echo '<br>';
        $mySum = $hc->prepareMonthSum($mySheet);
        $sheet[$gestor] = $mySheet;
        $sum[$gestor] = $mySum;
    }
}
require_once __DIR__ . '/views/visitadorTimesheetView.php';