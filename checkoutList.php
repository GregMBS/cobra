<?php

use cobra_salsa\PdoClass;
use cobra_salsa\CheckClass;

require_once 'classes/PdoClass.php';
require_once 'classes/CheckClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$cc = new CheckClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$vst = filter_input(INPUT_GET, 'visitador');
$visitStr = '';
$visitador = 'TODOS';
if (!empty($vst)) {
    $completo = $cc->getCompleto($vst);
    if (!empty($completo)) {
        $visitador = $completo;
        $visitStr = " and gestor=:vst ";
    }
}

$result = $cc->listVasign($vst);
require_once 'views/checkoutListView.php';
