<?php
require_once 'classes/pdoConnect.php';
$pc     = new pdoConnect();
$pdo    = $pc->dbConnectAdmin();
require_once 'classes/rotasClass.php';
$rc     = new rotasClass($pdo);
$capt   = filter_input(INPUT_GET, 'capt');
$result = $rc->getRotas($capt, '');
require_once 'views/rotasView.php';