<?php

use cobra_salsa\PdoClass;
use cobra_salsa\ResumenClass;

require_once 'classes/PdoClass.php';
require_once 'classes/ResumenClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectUser();
$rc = new ResumenClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$ID_CUENTA = filter_input(INPUT_GET, 'id_cuenta');
$rowSub = $rc->listVisits($ID_CUENTA);
$fields = array("c_cvst", "fh", "gestor", "short", "Gestion");
$fieldnames = array("Status", "Fecha/Hora", "Visitador", "Gestion", "Gestion");
$fieldsize = array("status", "timestamp", "chico", "gestion", "hideBox");
require_once 'views/realVisitListView.php';