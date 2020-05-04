<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectUser();
$capt = $pc->capt;
$query = "SELECT distinct cliente FROM resumen LIMIT 1000";
$clientQuery = $pdo->query($query);
$clientes = $clientQuery->fetchAll();
require_once 'views/cargaPicView.php';