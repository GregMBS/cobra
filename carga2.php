<?php

use cobra_salsa\CargaClass;
use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
$capt = $pc->capt;
$cc = new CargaClass($pdo);
$post = filter_input_array(INPUT_POST);
require_once 'views/cargaView.php';

if ($post['go'] == 'asociar') {
    $maxc = $post['maxc'];
    $cliente = $post['cliente'];
    $fecha_de_actualizacion = $post['fecha_de_actualizacion'];

    if (!empty($post['pos0'])) {
        $resumenColumns = $cc->getDBColumnNames();
        $k = 0;
        $field = array();
        $type = array();
        $nullOk = array();
        foreach ($resumenColumns as $answer) {
            $field[$k] = $answer[0];
            $type[$k] = $answer[1];
            $nullOk[$k] = $answer[2];
//                                           $position[$k] = $k;
            $k++;
        }

        for ($f = 0; $f < $maxc; $f++) {
            $pos = $post['pos' . $f];

            if (stripos($pos, 'nousar') === 0) {
                $cargarField = 'nousar';
                $cargarType = '';
                $cargarNullOk = '';
                $cargarPosition = '';
            } else {
                $cargarField = $field[$pos];
                $cargarType = $type[$pos];
                $cargarNullOk = $nullOk[$pos];
                $cargarPosition = $pos;
            }
            $cc->loadCargadex($cargarField, $cargarType, $cargarNullOk, $cargarPosition, $cliente);
        }
    }
    $cargarIndex = $cc->getCargadex($cliente);
    $c = 0;

    foreach ($cargarIndex as $answer) {
        $field[$c] = $answer[1];
        $type[$c] = $answer[2];
        $c++;
        set_time_limit(300);
    }
    try {
        $cc->prepareTemp($field);
    } catch (Exception $e) {
        die($e->getMessage());
    }
    $filename = $post['filename'];
    $n = 0;

    $cc->startTransaction();
    if (($handle = fopen($filename, "r")) !== FALSE) {
        try {
            $cc->loadData($filename);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    $cc->endTransaction();

    try {
        $cc->updateResumen($fieldList);
    } catch (Exception $e) {
        die($e->getMessage());
    }

    echo "Old fields updated.";
    $fieldList = $cc->getNewFieldList();
    try {
        $cc->insertIntoResumen($fieldList);
    } catch (Exception $e) {
        die($e->getMessage());
    }
    $cc->updateClientes();
    echo "New fields inserted.";
    $cc->updatePagos();
    $cc->createLookupTable();
}

