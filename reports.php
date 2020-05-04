<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
require_once 'views/reportsView.php';