<?php

use cobra_salsa\CheckClass;

require_once __DIR__. '/checkCommon.php';
/**
 * @var string $go
 * @var string $gestor
 * @var CheckClass $cc
 */
$fechaout = filter_input(INPUT_GET, 'fechaout');
if ($go == 'RECIBIR') {
    if (!empty($CUENTA)) {
        $ID_CUENTA = $cc->getIdCuentaFromCuenta($CUENTA);
        if ($ID_CUENTA > 0) {
            $cc->insertVasignBoth($CUENTA, $gestor, $fechaout, $ID_CUENTA);
        } else {
            $message = 'No se guard&oacute;';
        }
    }
}
$resultd = $cc->getOneMonth();
require_once 'views/checkbothView.php';