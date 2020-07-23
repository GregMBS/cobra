<?php

use cobra_salsa\PagosClass;
use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/PagosClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectUser();
$pc = new PagosClass($pdo);
$capt = $pd->capt;
$ID_CUENTA = filter_input(INPUT_GET, 'id_cuenta');
$result = $pc->getCuentaClienteFromID($ID_CUENTA);
if ($result) {
    $CUENTA = $result->numero_de_cuenta;
    $CLIENTE = $result->cliente;
}
$rowsub = $pc->listPagos($ID_CUENTA);
require_once 'views/pagosView.php';
