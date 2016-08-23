<?php

use cobra_salsa\PdoClass;
use cobra_salsa\HorariosClass;

require_once 'classes/PdoClass.php';
$pc      = new PdoClass();
$pdo     = $pc->dbConnectAdmin();
require_once 'classes/HorariosClass.php';
$hc      = new HorariosClass($pdo);
$yr      = date('Y');
$mes     = date('m');
$dhoy    = date('d');
$hoy     = date('Y-m-d');
$capt    = filter_input(INPUT_GET, 'capt');
$go      = filter_input(INPUT_GET, 'go');
$c_cvge  = filter_input(INPUT_GET, 'gestor');
$gestor  = $c_cvge;
$dst     = '';
if ($gestor == 'total') {
    $redirect = 'Location: horarios_clean.php?capt='.$capt;
    header($redirect);
}
$resultnom = $hc->listGestores();
require_once 'views/horarios2View.php';