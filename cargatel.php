<?php

use cobra_salsa\PdoClass;
use cobra_salsa\RobotClass;

require_once 'classes/PdoClass.php';
require_once 'classes/RobotClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$rc = new RobotClass($pdo);
$capt = $pdoc->capt;
$go = filter_input(INPUT_POST, 'go');
$datastring = filter_input(INPUT_POST, 'data');
$msgtag = filter_input(INPUT_POST, 'msgtag');
$msg = "";
$resultcl = $rc->getMessageList();

if (!empty($go)) {

    if ($go == 'cargar') {
        $rc->loadRobot($datastring, $msgtag);
        $msg = "<p>Llamadas est&aacute;n cargadas</p>";
    }
}
require_once 'cargatelView.php';