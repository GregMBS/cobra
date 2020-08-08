<?php

use cobra_salsa\PdoClass;
use cobra_salsa\WhiteClass;

require_once 'classes/PdoClass.php';
require_once 'classes/WhiteClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectUser();
$wc = new WhiteClass($pdo);
$capt = $pd->capt;

$search = filter_input_array(INPUT_GET);
$querymain = $wc->buildQuery($search);
try {
    $result = $wc->runQuery($querymain, $search);
} catch (Exception $e) {
    die($e->getMessage());
}
require_once 'views/whiteSearchView.php';
