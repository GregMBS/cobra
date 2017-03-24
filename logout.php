<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\LogoutClass;

require_once 'classes/PdoClass.php';
require_once 'classes/LogoutClass.php';
$pdoc		 = new PdoClass();
$pdo		 = $pdoc->dbConnectUser();
$lc              = new LogoutClass($pdo);
$capt		 = filter_input(INPUT_GET, 'capt');
$go		 = filter_input(INPUT_GET, 'gone');
$lc->unlockCuentas($capt);
if ($go != "") {
    $resultdt = $lc->getLogoutDatetime($capt, $go);
    extract($resultdt);
	$lc->insertHistoria($capt, $go, $date, $time);
	$lc->clearResumenLocks($capt);
	$lc->clearRslice($capt);
	$lc->expireTicket($capt);
	$page		 = "Location: index.php";
	if (($go != "salir") && ($go != "error")) {
		$page = "Location: breaks.php?capt=".$capt;
	}
	header($page);
}
require_once 'views/logoutView.php';
