<?php
set_time_limit(300);
require_once 'vendor/autoload.php';


use cobra_salsa\PdoClass;
use cobra_salsa\TelsClass;

require_once 'classes/PdoClass.php';
require_once 'classes/TelsClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
$tc = new TelsClass($pdo);
$fecha1 = filter_input(INPUT_GET, 'fecha1');
$fecha2 = filter_input(INPUT_GET, 'fecha2');
$tipo = filter_input(INPUT_GET, 'tipo');
$capt = $pc->capt;
if (!empty($fecha1)) {
    switch ($tipo) {
        case 'marcados':
            $result = $tc->getMercadosReport($fecha1, $fecha2);
            break;

        case 'contactados':
            $result = $tc->getContactosReport($fecha1, $fecha2);
            break;
    }
}

if (isset($result)) {
    try {
        $tc->outputDocument($result);
    } catch (Exception $e) {
        die($e->getMessage());
    }
} else {
    $dateRange = $tc->getDates();
    require_once 'views/tels_View.php';
}