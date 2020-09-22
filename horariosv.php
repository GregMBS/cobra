<?php

use cobra_salsa\TimesheetDayObject;

require_once __DIR__ . '/timesheetHead.php';
require_once __DIR__ . '/classes/TimesheetDayObject.php';
$visitadores = $hc->listVisitadores();
$sheet = [];
$sum = [];
var_dump($visitadores);
foreach ($visitadores as $gestor) {
    $mySheet = [];
    $mySum = [];
    if (!empty($gestor)) {
        print_r($gestor);
        $mySheet = $hc->prepareVisitSheet($hc, $gestor, $dhoy);
        var_dump($mySheet);
        echo '<br>';
//        $mySum = $hc->prepareMonthSum($mySheet);
        $sheet[$gestor] = $mySheet;
        $sum[$gestor] = new TimesheetDayObject();
    }
}
require_once __DIR__ . '/views/visitadorTimesheetView.php';