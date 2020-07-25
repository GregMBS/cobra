<?php

use cobra_salsa\MigoClass;
use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/MigoClass.php';

$pd = new PdoClass();
$pdo = $pd->dbConnectUser();
$mc = new MigoClass($pdo);
$capt = $pd->capt;
$tipo = $pd->tipo;
$keys = [
    'numero_de_cuenta',
    'nombre_deudor',
    'cliente',
    'status_de_credito',
    'saldo_total',
    'saldo_descuento_2',
    'saldo_aarsa',
    'fecha_ultima_gestion'
];
if ($tipo == 'admin') {
    echo $mc->getAjax($keys);
} else {
    echo $mc->getAjax($keys, $capt);
}
