<?php

use cobra_salsa\PdoClass;
use cobra_salsa\TroubleClass;

require_once 'classes/PdoClass.php';
require_once 'classes/TroubleClass.php';
$pd    = new PdoClass();
$pdo     = $pd->dbConnectAdmin();
$tc = new TroubleClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_GET, 'go');
if (!empty($go)) {
    if ($go == 'RESOLVER') {
        $auto = filter_input(INPUT_GET, 'which', FILTER_VALIDATE_INT);
        $reparacion = filter_input(INPUT_GET, 'reparacion');
        $tc->updateTrouble($capt, $reparacion, $auto);
    }
}
$rowsub = $tc->listTrouble();
require_once 'views/troubleadminView.php';