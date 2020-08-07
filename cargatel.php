<?php

use cobra_salsa\PdoClass;
use cobra_salsa\RobotClass;

require_once 'classes/PdoClass.php';
require_once 'classes/RobotClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
$rc = new RobotClass($pdo);
$capt = $pd->capt;
$go = filter_input(INPUT_POST, 'go');
$dataString = filter_input(INPUT_POST, 'data');
$msgtag = filter_input(INPUT_POST, 'msgtag');
$msg = "";
$msgList = $rc->getMessageList();

if (!empty($go)) {

    if ($go == 'cargar') {
        $rc->loadRobot($dataString, $msgtag);
        $msg = "<p>Llamadas est&aacute;n cargadas</p>";
    }
}
require_once 'views/cargatelView.php';