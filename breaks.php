<?php

use cobra_salsa\PdoClass;
use cobra_salsa\BreaksClass;

require_once 'classes/PdoClass.php';
require_once 'classes/BreaksClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectNobody();
$bc = new BreaksClass($pdo);
$capt = $pd->capt;

/**
 * 
 * @param PDO $pdo
 * @param string $TIEMPO
 * @param string $GESTOR
 * @return array
 */

$bc->clearUserlog($capt);
$ot = '';
$og = '';
$result = $bc->getBreaksTable($capt);
require_once 'views/breaksView.php';