<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\SpeclistmanClass;

require_once 'classes/PdoClass.php';
require_once 'classes/SpeclistmanClass.php';
$pc	 = new PdoClass();
$pdo	 = $pc->dbConnectAdmin();
$sc = new SpeclistmanClass($pdo);
$capt	 = filter_input(INPUT_GET, 'capt');
$go	 = filter_input(INPUT_GET, 'go');
$cliente = filter_input(INPUT_GET, 'cliente');
$sdc	 = filter_input(INPUT_GET, 'sdc');
$result	 = $sc->getReport($cliente, $sdc);
require_once 'views/speclistmanView.php';