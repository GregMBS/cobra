<?php
require_once 'checkCommon.php';
if ($go === 'ASIGNAR') {
    if ($tipo === 'id_cuenta') {
        $C_CONT = $CUENTA;
        $CTA = $cc->getCuentaFromIdCuenta($CUENTA);
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
$file = basename(__FILE__);
$label = 'ASIGNAR';
require_once 'views/checkView.php';
