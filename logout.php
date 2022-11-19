<?php

use cobra_salsa\LogoutClass;
use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/LogoutClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectUser();
$lc = new LogoutClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_GET, 'gone');
$lc->unlockCuentas($capt);
if ($go !== "") {
    $lc->runLogout($capt, $go);
    $page = "Location: index.php";
    if (($go !== "salir") && ($go !== "error")) {
        $page = "Location: breaks.php?capt=" . $capt;
    }
    header($page);
}
require_once __DIR__ . '/views/logoutView.php';