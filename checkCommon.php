<?php

use cobra_salsa\PdoClass;
use cobra_salsa\CheckClass;

require_once 'classes/PdoClass.php';
require_once 'classes/CheckClass.php';

$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
$cc = new CheckClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$tipo = filter_input(INPUT_GET, 'tipo');
$go = filter_input(INPUT_GET, 'go');
$gestor = filter_input(INPUT_GET, 'gestor');
$CUENTA = trim(filter_input(INPUT_GET, 'CUENTA'));
$result = $cc->getVisitadores();
$resultcount = $cc->countInOut($gestor);
$resultMain = $cc->listVasign($gestor);
if (empty($tipo)) {
    $tipo = 'id_cuenta';
}
$message = '';
