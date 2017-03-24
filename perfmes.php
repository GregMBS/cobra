<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\PerfmesClass;
use gregmbs\cobra\PerfmesAllClass;

require_once 'classes/PdoClass.php';
$pdc             = new PdoClass();
$pdo             = $pdc->dbConnectAdmin();
require_once 'classes/PerfmesClass.php';
$pc              = new PerfmesClass($pdo);
require_once 'classes/PerfmesAllClass.php';
$pac             = new PerfmesAllClass($pdo);
$yr              = date('Y', strtotime('last day of previous month'));
$mes             = date('m', strtotime('last day of previous month'));
$dhoy            = date('d', strtotime('last day of previous month'));
$hoy             = date('Y-m-d', strtotime('last day of previous month'));
$capt            = filter_input(INPUT_GET, 'capt');
$dst             = '';
$hours_all       = array_fill(1, $dhoy, 0);
$gestiones_all   = array_fill(1, $dhoy, 0);
$contactos_all   = array_fill(1, $dhoy, 0);
$nocontactos_all = array_fill(1, $dhoy, 0);
$promesas_all    = array_fill(1, $dhoy, 0);
$pagos_all       = array_fill(1, $dhoy, 0);
$resultnom       = $pc->listGestores();
require_once 'views/perfmesView.php';
