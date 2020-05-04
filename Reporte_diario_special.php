<?php

use cobra_salsa\PdoClass;
use cobra_salsa\ReporteDiarioClass;

require_once 'classes/PdoClass.php';
require_once 'classes/ReporteDiarioClass.php';

$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
$capt = $pd->capt;
$rd = new ReporteDiarioClass($pdo);

$rd->buildReport();
$resultPagos = $rd->resultPagos;
$resultVencidos = $rd->resultVencidos;
$resultVigentes = $rd->resultVigentes;

include 'views/Reporte_diario_specialView.php';
