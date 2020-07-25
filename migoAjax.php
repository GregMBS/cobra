<?php

use cobra_salsa\MigoClass;
use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/MigoClass.php';

$pd = new PdoClass();
$pdo = $pd->dbConnectUser();
$mc = new MigoClass($pdo);

if ($pd->tipo == 'admin') {
    echo $mc->getAjax($mc->keys);
} else {
    echo $mc->getAjax($mc->keys, $pd->capt);
}
