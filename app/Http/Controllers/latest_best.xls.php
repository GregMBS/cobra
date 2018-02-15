<?php
set_time_limit(300);
require_once 'vendor/autoload.php';

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
use app\PdoClass;
use app\BestClass;

$pc        = new PdoClass();
$pdo       = $pc->dbConnectAdmin();
$bc        = new BestClass($pdo);
$resultpre = $bc->getResumenData();
$filename  = "Ultimo_y_mejor_".date('ymd').".xlsx";
$output    = array();
$i         = 1;
foreach ($resultpre as $rowpre) {
    $aData                        = array();
    $aData['id_cuenta']           = $rowpre[0];
    $aData['numero_de_cuenta']    = $rowpre[1];
    $aData['segmento']            = $rowpre[2];
    $aData['saldo_total']         = $rowpre[3];
    $aData['ultima_gestion']      = $rowpre[4];
    $aData['nombre_deudor']       = $rowpre[5];
    $aData['producto']            = $rowpre[6];
    $aData['status_de_la_cuenta'] = $rowpre[7];
    $aData['ultimo_status']       = '';
    $aData['ultimo_tel']          = '';
    $aData['ultimo_comentario']   = '';
    $aData['mejor_status']        = '';
    $aData['mejor_tel']           = '';
    $resultult                    = $bc->getLastHistoriaData($aData['id_cuenta']);
    foreach ($resultult as $rowult) {
        $aData['ultimo_status']     = $rowult['C_CVST'];
        $aData['ultimo_tel']        = $rowult['C_TELE'];
        $aData['ultimo_comentario'] = $rowult['C_OBSE1'];
    }
    $resultbest = $bc->getBestHistoriaData($aData['id_cuenta']);
    foreach ($resultbest as $rowbest) {
        $aData['mejor_status'] = $rowbest['c_cvst'];
        $aData['mejor_tel']    = $rowbest['c_tele'];
    }
    if ($i == 1) {
        $output[0] = array_keys($aData);
    }
    $output[$i] = $aData;
    $i++;
}

$writer = WriterFactory::create(Type::XLSX);
$writer->openToBrowser($filename); // stream data directly to the browser
$writer->addRows($output); // add multiple rows at a time
$writer->close();
