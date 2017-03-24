<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\DhClass;

require_once 'classes/PdoClass.php';
require_once 'classes/DhClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$dc = new DhClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$gestor = filter_input(INPUT_GET, 'gestor');
$fecha = filter_input(INPUT_GET, 'fecha');
$result = $dc->getDhMain($gestor, $fecha);
require_once 'views/ddhView.php';
