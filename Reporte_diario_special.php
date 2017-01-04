<?php

use cobra_salsa\PdoClass;
use cobra_salsa\ReporteDiarioClass;

require_once 'classes/PdoClass.php';
require_once 'classes/ReporteDiarioClass.php';

$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$capt = $pdoc->capt;
$rd = new ReporteDiarioClass($pdo);

$rd->buildReport();
var_dump($rd);
die();
$resultPagos = $rd->resultPagos;
$resultVencidos = $rd->resultVencidos;
$resultVigentes = $rd->resultVigentes;

include 'views/Reporte_diario_specialView.php';
