<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\StatusClass;

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
require_once 'classes/StatusClass.php';
$sc = new StatusClass($pdo);
$go = filter_input(INPUT_GET, 'go');
$id = filter_input(INPUT_GET, 'ID');
if (!empty($go)) {
    if ($go == "KILL") {
        $sc->killProc($id);
    }
}

$result = $sc->getProcesslist();

$resulttab = $sc->getTables();
