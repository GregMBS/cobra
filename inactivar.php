<?php

use cobra_salsa\PdoClass;
use cobra_salsa\ActivarClass;

require_once 'classes/PdoClass.php';
require_once 'classes/ActivarClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$ac = new ActivarClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_POST, 'go');
$dataRaw = filter_input(INPUT_POST, 'data');
$msg = '';
if (!empty($go)) {

    if ($go == 'cargar') {
        $data = preg_split("/[\s,]+/", $dataRaw, 0, PREG_SPLIT_NO_EMPTY);
        $count = $ac->inactivateCuentas($data);
        $msg = "<p>$count Cuentas est&aacute;n inactivadas</p>";
    }
}
require_once 'views/inactivarView.php';