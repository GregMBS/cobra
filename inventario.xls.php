<?php

use cobra_salsa\PdoClass;
use cobra_salsa\InventarioClass;
use cobra_salsa\OutputClass;

require_once 'classes/PdoClass.php';
require_once 'classes/InventarioClass.php';
require_once 'classes/OutputClass.php';

set_time_limit(300);

$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
$ic = new InventarioClass($pdo);
$capt = $pc->capt;
$oc = new OutputClass();
set_time_limit(180);

$go = filter_input(INPUT_GET, 'go');
if (!empty($go)) {
    $cliente = filter_input(INPUT_GET, 'cliente');
    if (!empty($cliente)) {
        $result = $ic->getInventarioReport($cliente);
        if (is_array($result[0])) {
            $filename = "Query_de_inventario_" . date('ymd') . ".xlsx";
            $headers = array_keys($result[0]);
            try {
                $oc->writeXLSXFile($filename, $result, $headers);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
    }
} else {
    $clientes = $ic->listClients();
    $here = 'inventario.xls.php';
    require_once 'views/inventarioView.php';
}
