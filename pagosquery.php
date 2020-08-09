<?php
require_once 'vendor/autoload.php';

use cobra_salsa\PdoClass;
use cobra_salsa\PagosClass;
use cobra_salsa\OutputClass;

$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
$pc = new PagosClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$fecha1 = filter_input(INPUT_GET, 'fecha1');
$fecha2 = filter_input(INPUT_GET, 'fecha2');
$cliente = filter_input(INPUT_GET, 'cliente');
$clientes = $pc->listClientes();
if (filter_has_var(INPUT_GET, 'go')) {
    $result = $pc->queryAll($fecha1, $fecha2, $cliente);
    if (empty($result)) {
        require_once 'views/pagosqueryView.php';
    } else {
        $oc = new OutputClass();
        $filename = "pagos.xlsx";
        $headers = [
            'cuenta', 'fecha', 'fechacapt', 'monto', 'cliente', 'sdc', 'gestor', 'confirmado', 'id_cuenta'
        ];
        try {
            $oc->writeXLSXFile($filename, $result, $headers);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
} else {
    require_once 'views/pagosqueryView.php';
}