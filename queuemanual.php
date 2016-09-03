<?php

use cobra_salsa\PdoClass;
use cobra_salsa\QueueManualClass;

require_once 'classes/PdoClass.php';
require_once 'classes/QueueManualClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$qc = new QueueManualClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
if (filter_has_var(INPUT_POST, 'capt')) {
    $capt = filter_input(INPUT_POST, 'capt');
}
$go = filter_input(INPUT_POST, 'go');
$clientea = filter_input(INPUT_POST, 'clientea');
$dataPost = filter_input(INPUT_POST, 'data');
if ($go == 'borrar') {
    $qc->truncateManual();
}
if ($go == 'cargar') {
    $qc->loadManual($dataPost, $clientea);
}
$clientes = $qc->listClients();
require_once 'views/queuemanualView.php';
