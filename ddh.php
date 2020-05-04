<?php

use cobra_salsa\PdoClass;
use cobra_salsa\DhClass;

require_once 'classes/PdoClass.php';
require_once 'classes/DhClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
$dc = new DhClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$gestor = filter_input(INPUT_GET, 'gestor');
$fecha = filter_input(INPUT_GET, 'fecha');
$result = $dc->getDhMain($gestor, $fecha);
require_once 'views/ddhView.php';
