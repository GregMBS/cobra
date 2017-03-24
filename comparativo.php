<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\ComparativoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/ComparativoClass.php';
$pdoc      = new PdoClass();
$pdo       = $pdoc->dbConnectAdmin();
$cc = new ComparativoClass($pdo);
$capt      = filter_input(INPUT_GET, 'capt');
$result = $cc->getReport();
require_once 'views/comparativoView.php';
