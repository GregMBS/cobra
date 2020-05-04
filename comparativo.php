<?php

use cobra_salsa\PdoClass;
use cobra_salsa\ComparativoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/ComparativoClass.php';
$pd      = new PdoClass();
$pdo       = $pd->dbConnectAdmin();
$cc = new ComparativoClass($pdo);
$capt      = filter_input(INPUT_GET, 'capt');
$result = $cc->getReport();
require_once 'views/comparativoView.php';