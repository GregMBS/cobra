<?php

set_time_limit(300);
require_once 'vendor/autoload.php';

use cobra_salsa\PdoClass;
use cobra_salsa\BestClass;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

require_once 'classes/PdoClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
require_once 'classes/BestClass.php';
$bc = new BestClass($pdo);
$summary = $bc->getResumenData();
$filename = "Ultimo_y_mejor_" . date('ymd') . ".xlsx";
$output = array();
$i = 1;
foreach ($summary as $row) {
    $aData = array();
    foreach ($row as $key => $value) {
        $aData[$key] = $value;
    }
    $aData['ultimo_status'] = '';
    $aData['ultimo_tel'] = '';
    $aData['ultimo_comentario'] = '';
    $aData['mejor_status'] = '';
    $aData['mejor_tel'] = '';
    $aData['mejor_fecha'] = '';
    $latest = $bc->getLastHistoriaData($aData['id_cuenta']);
    foreach ($latest as $latestRow) {
        $aData['ultimo_status'] = $latestRow['C_CVST'];
        $aData['ultimo_tel'] = $latestRow['C_TELE'];
        $aData['ultimo_comentario'] = $latestRow['C_OBSE1'];
        $aData['ultimo_accion'] = $latestRow['C_ACCION'];
    }
    $best = $bc->getBestHistoriaData($aData['id_cuenta']);
    foreach ($best as $bestRow) {
        $aData['mejor_status'] = $bestRow['c_cvst'];
        $aData['mejor_tel'] = $bestRow['c_tele'];
        $aData['mejor_fecha'] = $bestRow['d_fech'];
        $aData['mejor_accion'] = $bestRow['c_accion'];
    }
    $aData['gestiones'] = $bc->countGestiones($aData['id_cuenta']);
    if ($i == 1) {
        $output[0] = array_keys($aData);
    }
    $output[$i] = $aData;
    $i++;
}

try {
    $writer = WriterEntityFactory::createXLSXWriter();
    $writer->openToBrowser($filename); // stream data directly to the browser
    $writer->addRows($output); // add multiple rows at a time
    $writer->close();
} catch (Exception $e) {
    // fail silently
}
