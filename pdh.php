<?php
require_once 'classes/pdoConnect.php';
$pc     = new pdoConnect();
$pdo    = $pc->dbConnectAdmin();
require_once 'classes/DhClass.php';
$dc     = new DhClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$gestor = filter_input(INPUT_GET, 'gestor');
$fecha  = filter_input(INPUT_GET, 'fecha');
set_time_limit(300);
$result = $dc->getPromesas($gestor, $fecha);
require_once 'views/pdhView.php';