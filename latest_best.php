<?php

set_time_limit(300);
require_once 'vendor/autoload.php';

use cobra_salsa\PdoClass;
use cobra_salsa\BestClass;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

require_once 'classes/PdoClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
require_once 'classes/BestClass.php';
$bc = new BestClass($pdo);
$resultpre = $bc->getResumenData();
$filename = "Ultimo_y_mejor_" . date('ymd') . ".xlsx";
$output = array();
$i = 1;
foreach ($resultpre as $rowpre) {
    $aData = array();
    foreach ($rowpre as $key => $value) {
        $aData[$key] = $value;
    }
    $aData['ultimo_status'] = '';
    $aData['ultimo_tel'] = '';
    $aData['ultimo_comentario'] = '';
    $aData['mejor_status'] = '';
    $aData['mejor_tel'] = '';
    $aData['mejor_fecha'] = '';
    $resultult = $bc->getLastHistoriaData($aData['id_cuenta']);
    foreach ($resultult as $rowult) {
        $aData['ultimo_status'] = $rowult['C_CVST'];
        $aData['ultimo_tel'] = $rowult['C_TELE'];
        $aData['ultimo_comentario'] = $rowult['C_OBSE1'];
        $aData['ultimo_accion'] = $rowult['C_ACCION'];
    }
    $resultbest = $bc->getBestHistoriaData($aData['id_cuenta']);
    foreach ($resultbest as $rowbest) {
        $aData['mejor_status'] = $rowbest['c_cvst'];
        $aData['mejor_tel'] = $rowbest['c_tele'];
        $aData['mejor_fecha'] = $rowbest['d_fech'];
        $aData['mejor_accion'] = $rowbest['c_accion'];
    }
    $aData['gestiones'] = $bc->countGestiones($aData['id_cuenta']);
    if ($i == 1) {
        $output[0] = array_keys($aData);
    }
    $output[$i] = $aData;
    $i++;
}

try {
    $writer = WriterFactory::create(Type::XLSX);
    $writer->openToBrowser($filename); // stream data directly to the browser
    $writer->addRows($output); // add multiple rows at a time
    $writer->close();
} catch (Exception $e) {
    // fail silently
}
