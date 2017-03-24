<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\PagosClass;

require_once 'classes/PdoClass.php';
require_once 'classes/PagosClass.php';
$pdoc		 = new PdoClass();
$pdo		 = $pdoc->dbConnectAdmin();
$pc              = new PagosClass($pdo);
$capt		 = filter_input(INPUT_GET, 'capt');
$resultAct	 = $pc->summaryThisMonth();
$resultActGest	 = $pc->byGestorThisMonth();
$resultActDet	 = $pc->detailsThisMonth();
$resultAnt	 = $pc->summaryLastMonth();
$resultAntGest	 = $pc->byGestorLastMonth();
$resultAntDet	 = $pc->detailsLastMonth();
require_once 'views/pagosumView.php';
