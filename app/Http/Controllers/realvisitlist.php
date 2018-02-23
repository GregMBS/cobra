<?php


use App\ResumenClass;

$rc = new ResumenClass();

$ID_CUENTA = filter_input(INPUT_GET, 'id_cuenta');
$rowsub = $rc->listVisits($ID_CUENTA);
$fields = array("c_cvst", "fh", "gestor", "short", "Gestion");
$fieldnames = array("Status", "Fecha/Hora", "Visitador", "Gestion", "Gestion");
$fieldsize = array("status", "timestamp", "chico", "gestion", "hidebox");
require_once 'views/realvisitlistView.php';