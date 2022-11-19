<?php

require_once __DIR__. '/checkCommon.php';
$fechaout = filter_input(INPUT_GET, 'fechaout');
if ($go === 'RECIBIR') {
    if (!empty($CUENTA)) {
        $ID_CUENTA = $cc->getIdCuentaFromCuenta($CUENTA);
        if ($ID_CUENTA > 0) {
            $cc->insertVasignBoth($CUENTA, $gestor, $fechaout, $ID_CUENTA);
        } else {
            $message = 'No se guard&oacute;';
        }
    }
}
$resultD = $cc->getOneMonth();
require_once 'views/checkBothView.php';