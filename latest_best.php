<?php

ini_set('memory_limit', '2048M');
set_time_limit(300);
require_once 'vendor/autoload.php';

use cobra_salsa\BestClass;
use cobra_salsa\OutputClass;
use cobra_salsa\PdoClass;
use cobra_salsa\ResumenObject;

require_once 'classes/PdoClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
require_once 'classes/BestClass.php';
$bc = new BestClass($pdo);
$fields = [
    'ejecutivo_asignado_call_center',
    'numero_de_cuenta',
    'nombre_deudor',
    'cliente',
    'status_de_credito',
    'id_cuenta',
    'saldo_total',
    'saldo_descuento_1',
    'saldo_descuento_2',
    'fecha_ultima',
    'hora_ultima',
    'producto',
    'subproducto',
    'status_aarsa',
    'tel_1',
    'tel_2',
    'fecha_de_ultimo_pago',
    'monto_ultimo_pago'
];
$filename = "Ultimo_y_mejor_" . date('ymd') . ".xlsx";
$output = array();
$i = 1;
$stq = $bc->getLastBest();
$output = $stq->fetchAll(PDO::FETCH_ASSOC);
$count = count($output);
if ($count>0) {
    $header = array_keys(current($output));
    require_once 'classes/OutputClass.php';
    $oc = new OutputClass();
    try {
        $oc->writeXLSXFile($filename, $output, $header);
    } catch (Exception $e) {
        die($e->getMessage());
    }
} else {
    die('empty output');
}