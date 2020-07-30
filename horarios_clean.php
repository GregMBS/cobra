<?php

use cobra_salsa\PdoClass;
use cobra_salsa\HorariosClass;
use cobra_salsa\HorariosAllClass;
use cobra_salsa\TimesheetViewClass;

require_once 'classes/PdoClass.php';
$pc              = new PdoClass();
$pdo             = $pc->dbConnectAdmin();
require_once 'classes/HorariosClass.php';
$hc              = new HorariosClass($pdo);
require_once 'classes/HorariosAllClass.php';
$hac             = new HorariosAllClass($pdo);
require_once __DIR__ . '/classes/TimesheetViewClass.php';
$tv = new TimesheetViewClass();
$yr              = date('Y');
$mes             = date('m');
$dhoy            = date('d');
$hoy             = date('Y-m-d');
$capt            = filter_input(INPUT_GET, 'capt');
$dst             = '';
$hours_all = array_fill(1, $dhoy, 0);
$breaks_all = array_fill(1, $dhoy, 0);
$bano_all = array_fill(1, $dhoy, 0);
$gestiones_all = array_fill(1, $dhoy, 0);
$contactos_all = array_fill(1, $dhoy, 0);
$nocontactos_all = array_fill(1, $dhoy, 0);
$promesas_all = array_fill(1, $dhoy, 0);
$pagos_all = array_fill(1, $dhoy, 0);
            $resultnom       = $hc->listGestores();
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");
$gestores = $hc->listGestores();
require_once 'views/timesheetView.php';
