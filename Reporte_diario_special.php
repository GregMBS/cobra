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
$resultPagos = $rd->resultPagos;
$numberfieldsPagos = $rd->numberfieldsPagos;

$resultVencidos = $rd->resultVencidos;
$numberfieldsVencidos = $rd->numberfieldsVencidos;

$resultVigentes = $rd->resultVigentes;
$numberfieldsVigentes = $rd->numberfieldsVigentes;

include 'views/Reporte_diario_specialView.php';
