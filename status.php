<?php

use cobra_salsa\PdoClass;
use cobra_salsa\StatusClass;

require_once 'classes/PdoClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
require_once 'classes/StatusClass.php';
$sc = new StatusClass($pdo);
$go = filter_input(INPUT_GET, 'go');
$id = filter_input(INPUT_GET, 'ID');
if (!empty($go)) {
    if ($go === "KILL") {
        $sc->killProc($id);
    }
}

$result = $sc->getProcesslist();

$resultTable = $sc->getTables();
