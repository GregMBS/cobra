<?php

use cobra_salsa\PdoClass;
use cobra_salsa\BuscarClass;
use cobra_salsa\ResumenObject;

require_once __DIR__ . '/classes/PdoClass.php';
require_once __DIR__ . '/classes/BuscarClass.php';
require_once __DIR__ . '/classes/ResumenObject.php';

$pc = new PdoClass();
$pdo = $pc->dbConnectUser();
$bc = new BuscarClass($pdo);
$capt = $pc->capt;
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
/** @var ResumenObject $result */
$result = $bc->searchAccounts($field, $find, $CLIENTE);
$clientes = $bc->listClients();
require_once 'views/buscarView.php';