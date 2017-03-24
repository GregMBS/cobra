<?php

use gregmbs\cobra\PdoClass;

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
var_dump($pdoc);
die();
$pdo = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
require_once 'views/reportsView.php';
