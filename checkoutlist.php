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
$visitstr = '';
$visitador = 'TODOS';
if (!empty($vst)) {
    $completo = $cc->getCompleto($vst);
    if (!empty($completo)) {
        $visitador = $completo;
        $visitstr = " and gestor=:vst ";
    }
}

$result = $cc->listVasign($vst);
require_once 'views/checkoutlistView.php';
