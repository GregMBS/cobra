<?php
require_once 'pdoConnect.php';
$pdoc = new pdoConnect();
$pdo = $pdoc->dbConnectAdmin();
require_once 'RobotClass.php';
$rc = new RobotClass($pdoc);
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_POST, 'go');
$datastring = filter_input(INPUT_POST, 'data');
$msgtag = filter_input(INPUT_POST, 'msgtag');
$msg = "";
$resultcl = $rc->getMessageList();

if (!empty($go)) {

    if ($go == 'cargar') {
        $rc->loadRobot($msg, $msgtag);
        $msg = "<p>Llamadas est&aacute;n cargadas</p>";
    }
}
require_once 'cargatelView.php';