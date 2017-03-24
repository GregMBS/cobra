<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\CheckClass;

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
    $resultn = $cc->getCompleto($vst);
    if (!empty($resultn['completo'])) {
        $visitador = $resultn['completo'];
        $visitstr = " and gestor=:vst ";
    }
}

$result = $cc->listVasign($vst);
require_once 'views/checkoutlistView.php';
