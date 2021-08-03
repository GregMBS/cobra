<?php

ini_set('memory_limit', '-1');
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
$stq = $bc->getResumenData();
while ($row = $stq->fetchObject(ResumenObject::class)) {
    $array = (array) $row;
    $aData = array();
    foreach ($fields as $field) {
        $aData[$field] = '';
        if (isset($array[$field])) {
            $aData[$field] = $array[$field];
        }
    }
    $idc = intval($aData['id_cuenta']);
    $aData['ultimo_status'] = '';
    $aData['ultimo_tel'] = '';
    $aData['ultimo_comentario'] = '';
    $aData['mejor_status'] = '';
    $aData['mejor_tel'] = '';
    $aData['mejor_fecha'] = '';
    $latest = $bc->getLastHistoriaData($idc);
    $aData['ultimo_status'] = $latest->C_CVST;
    $aData['ultimo_tel'] = $latest->C_TELE;
    $aData['ultimo_comentario'] = $latest->C_OBSE1;
    $aData['ultimo_accion'] = $latest->C_ACCION;

    $best = $bc->getBestHistoriaData($idc);
    $aData['mejor_status'] = $best->C_CVST;
    $aData['mejor_tel'] = $best->C_TELE;
    $aData['mejor_fecha'] = $best->D_FECH;
    $aData['mejor_accion'] = $best->C_ACCION;

    $aData['gestiones'] = $bc->countGestiones($idc);
    $output[] = $aData;
}
$header = array_keys($output[0]);
require_once 'classes/OutputClass.php';
$oc = new OutputClass();
try {
    $oc->writeXLSXFile($filename, $output, $header);
} catch (Exception $e) {
    die($e->getMessage());
}
