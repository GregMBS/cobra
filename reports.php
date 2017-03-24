<?php

use gregmbs\cobra\PdoClass;

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
var_dump($pdo);
die();
$capt = filter_input(INPUT_GET, 'capt');
require_once 'views/reportsView.php';
