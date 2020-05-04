<?php

use cobra_salsa\PdoClass;
use cobra_salsa\PagosClass;

require_once 'classes/PdoClass.php';
require_once 'classes/PagosClass.php';
$pd		 = new PdoClass();
$pdo		 = $pd->dbConnectAdmin();
$pc              = new PagosClass($pdo);
$capt		 = filter_input(INPUT_GET, 'capt');
$resultAct	 = $pc->summaryThisMonth();
$resultActGest	 = $pc->byGestorThisMonth();
$resultActDet	 = $pc->detailsThisMonth();
$resultAnt	 = $pc->summaryLastMonth();
$resultAntGest	 = $pc->byGestorLastMonth();
$resultAntDet	 = $pc->detailsLastMonth();
require_once 'views/pagosumView.php';