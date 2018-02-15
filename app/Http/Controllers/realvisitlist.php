<?php

use app\PdoClass;
use app\ResumenClass;

require_once 'classes/PdoClass.php';
require_once 'classes/ResumenClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectUser();
$rc = new ResumenClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$ID_CUENTA = filter_input(INPUT_GET, 'id_cuenta');
$rowsub = $rc->listVisits($ID_CUENTA);
$fields = array("c_cvst", "fh", "gestor", "short", "Gestion");
$fieldnames = array("Status", "Fecha/Hora", "Visitador", "Gestion", "Gestion");
$fieldsize = array("status", "timestamp", "chico", "gestion", "hidebox");
require_once 'views/realvisitlistView.php';