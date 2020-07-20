<?php

use cobra_salsa\PdoClass;
use cobra_salsa\WhiteClass;

require_once 'classes/PdoClass.php';
require_once 'classes/WhiteClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectUser();
$wc = new WhiteClass($pdo);
$capt = $pdoc->capt;

$search = filter_input_array(INPUT_GET);
$querymain = $wc->buildQuery($search);
$result = $wc->runQuery($querymain, $search);
require_once 'views/whitesearchView.php';
