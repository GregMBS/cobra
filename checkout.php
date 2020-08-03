<?php


use cobra_salsa\PdoClass;
use cobra_salsa\CheckClass;

require_once 'classes/PdoClass.php';
require_once 'classes/CheckClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$cc = new CheckClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$tipo = filter_input(INPUT_GET, 'tipo');
$get = filter_input_array(INPUT_GET);
$gestor = filter_input(INPUT_GET, 'gestor');
$CUENTA = trim(filter_input(INPUT_GET, 'CUENTA'));
if (empty($tipo)) {
    $tipo = 'id_cuenta';
}
$message = '';
$go = filter_input(INPUT_GET, 'go');
if ($go == 'ASIGNAR') {
    if ($tipo == 'id_cuenta') {
        $C_CONT = $CUENTA;
        $CTA = $cc->getCuentafromIdCuenta($CUENTA);
    } else {
        $CTA = $CUENTA;
        $C_CONT = $cc->getIdCuentaFromCuenta($CUENTA);
    }
    if (!empty($CUENTA)) {
        if ($C_CONT > 0) {
            $cc->insertVasign($CTA, $gestor, $C_CONT);
        } else {
            $message = 'No se guard&oacute;';
        }
    }
}
$result = $cc->getVisitadores();
$resultcount = $cc->countInOut($gestor);
$resultcc = $cc->listVasign($gestor);
require_once 'views/checkoutView.php';
