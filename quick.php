<?php

use cobra_salsa\PdoClass;
use cobra_salsa\QuickAhoraClass;
use cobra_salsa\QuickBreaksClass;
use cobra_salsa\QuickHoyClass;
use cobra_salsa\QuickPorHoraClass;

require_once 'classes/PdoClass.php';
$pc     = new PdoClass();
$pdo    = $pc->dbConnectAdmin();
$capt   = filter_input(INPUT_GET, 'capt');
$folios = 0;
$errors = 0;
require_once 'classes/quickAhoraClass.php';
$qa           = new QuickAhoraClass($pdo);
$resultAhora  = $qa->getAhora();
require_once 'classes/quickHoyClass.php';
$qh           = new QuickHoyClass($pdo);
$resultHoy    = $qh->getHoy();
require_once 'classes/quickBreaksClass.php';
$qb           = new QuickBreaksClass($pdo);
$resultBreaks = $qb->getBreaks();
require_once 'classes/quickPorHoraClass.php';
$qp           = new QuickPorHoraClass($pdo);
$resultPorHora = $qp->getPorHora();
require_once 'views/quickView.php';