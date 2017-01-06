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
$hours_all       = array_fill(1, $dhoy, 0);
$gestiones_all   = array_fill(1, $dhoy, 0);
$contactos_all   = array_fill(1, $dhoy, 0);
$nocontactos_all = array_fill(1, $dhoy, 0);
$promesas_all    = array_fill(1, $dhoy, 0);
$pagos_all       = array_fill(1, $dhoy, 0);
if ($gestor == 'total') {
    $redirect = 'Location: horarios_clean.php?capt='.$capt;
    header($redirect);
}
                    $resultnom = $hc->listGestores();
require_once 'views/horarios2View.php';
