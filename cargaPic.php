<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
/* @var $pdo PDO */
$pdo = $pdoc->dbConnectUser();
$capt = $pdoc->capt;
$query = "SELECT distinct cliente FROM resumen LIMIT 1000";
$clientq = $pdo->query($query);
$clientes = $clientq->fetchAll();
require_once 'views/cargaPicView.php';