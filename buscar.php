<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\BuscarClass;

require_once 'classes/PdoClass.php';
require_once 'classes/BuscarClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectUser();
$bc = new BuscarClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
set_time_limit(300);
$field = filter_input(INPUT_GET, 'field');
$find = filter_input(INPUT_GET, 'find');
$from = filter_input(INPUT_GET, 'from');
if (filter_has_var(INPUT_GET, 'C_CONT')) {
    $C_CONT = filter_input(INPUT_GET, 'C_CONT');
} else {
    $C_CONT = 0;
}
$CLIENTE = filter_input(INPUT_GET, 'cliente');
/*
  $querymain	 = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,
  id_cuenta,status_de_credito from resumen where ".$field." like '%".$find."%'";
 */
$result = $bc->searchAccounts($field, $find, $CLIENTE);
$resultcl = $bc->listClients();
require_once 'views/buscarView.php';