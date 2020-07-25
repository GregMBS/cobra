<?php

use cobra_salsa\PdoClass;
use cobra_salsa\MigoClass;
use cobra_salsa\ResumenObject;

require_once 'classes/PdoClass.php';
require_once 'classes/MigoClass.php';
require_once 'classes/ResumenObject.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectUser();
$mc = new MigoClass($pdo);
$capt = $pd->capt;
$tipo = $pd->tipo;
if ($tipo == 'admin') {
    $main = $mc->adminReport();
    while ($row = $main->fetchObject(ResumenObject::class)) {
        var_dump($row);
        die();
        return json_encode($row);
    }
} else {
    $main = $mc->userReport($capt);
    while ($row = $main->fetchObject(ResumenObject::class)) {
        return json_encode($row);
    }
}
