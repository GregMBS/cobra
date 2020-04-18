<?php
set_time_limit(300);
require_once 'vendor/autoload.php';


use cobra_salsa\PdoClass;
use cobra_salsa\TelsClass;

require_once 'classes/PdoClass.php';
require_once 'classes/TelsClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$tc = new TelsClass($pdo);
$fecha1 = filter_input(INPUT_GET, 'fecha1');
$fecha2 = filter_input(INPUT_GET, 'fecha2');
$capt = $pdoc->capt;
if (!empty($fecha1)) {
    $tc->createMarcados($fecha1, $fecha2);
    $result = $tc->getMercadosReport();
}
if (isset($result)) {
    $tc->outputDocument($result);
} else {
    $begin = new DateTime('first day of last month');
    $endDay = new DateTime('now');
    $end = $endDay->modify('+1 day');

    $interval = new DateInterval('P1D');
    $dateRange = new DatePeriod($begin, $interval, $end);
    $here = $_SERVER['PHP_SELF'];
    require_once 'views/tels_View.php';
}