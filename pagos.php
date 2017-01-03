<?php

use cobra_salsa\PdoClass;
use cobra_salsa\PagosClass;

require_once 'classes/PdoClass.php';
require_once 'classes/PagosClass.php';
$pdoc      = new PdoClass();
$pdo       = $pdoc->dbConnectUser();
$pc = new PagosClass($pdo);
$capt      = filter_input(INPUT_GET, 'capt');
$ID_CUENTA = filter_input(INPUT_GET, 'id_cuenta');
$resultcc  = $pc->getCuentaClienteFromID($ID_CUENTA);
if ($resultcc) {
    $CUENTA  = $resultcc['numero_de_cuenta'];
    $CLIENTE = $resultcc['cliente'];
}
$rowsub   = $pc->listPagos($ID_CUENTA);
require_once 'views/pagosView.php';
