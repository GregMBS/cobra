<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\GestorClass;

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
require_once 'classes/GestorClass.php';
$gc = new GestorClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$gestor = filter_input(INPUT_GET, 'gestor');

$result = $gc->getPagosReport($gestor);
require_once 'views/gestorView.php';
