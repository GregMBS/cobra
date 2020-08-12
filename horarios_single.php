<?php

use cobra_salsa\HorariosAllClass;
use cobra_salsa\HorariosClass;
use cobra_salsa\PdoClass;
use cobra_salsa\TimesheetDayObject;
use cobra_salsa\TimesheetViewClass;

require_once 'classes/PdoClass.php';
require_once 'classes/TimesheetDayObject.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
require_once 'classes/HorariosClass.php';
$hc = new HorariosClass($pdo);
require_once 'classes/HorariosAllClass.php';
$hac = new HorariosAllClass($pdo);
require_once __DIR__ . '/classes/TimesheetViewClass.php';
$tv = new TimesheetViewClass(TRUE);
$yr = date('Y');
$mes = date('m');
$dhoy = date('d') + 1;
$hoy = date('Y-m-d');
$capt = $pd->capt;
$gestores = [];
$gestor = filter_input(INPUT_GET, 'gestor');
$gestores = $hc->listGestores();
/** @var TimesheetDayObject[] $sheet */
$sheet = [];
$sum = [];
if (!empty($gestor)) {
    $sheet[$gestor] = $hc->prepareSheet($gestor, $dhoy);
    $sum[$gestor] = $hc->prepareMonthSum($sheet[$gestor]);
}
require_once __DIR__ . '/views/horarios2View.php';