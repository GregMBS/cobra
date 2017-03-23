<?php
set_time_limit(300);

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\SpeclistqcClass;

require_once 'classes/PdoClass.php';
require_once 'classes/SpeclistqcClass.php';
$pc	 = new PdoClass();
$pdo	 = $pc->dbConnectAdmin();
$sc = new SpeclistqcClass($pdo);
$capt	 = filter_input(INPUT_GET, 'capt');
$cliente = filter_input(INPUT_GET, 'cliente');
$queue	 = filter_input(INPUT_GET, 'queue');
$sdc	 = filter_input(INPUT_GET, 'status_de_credito');
$rato	 = filter_input(INPUT_GET, 'rato');
$result  = $sc->getReport($rato, $cliente, $sdc, $queue);
require_once 'views/speclistqcView.php';
