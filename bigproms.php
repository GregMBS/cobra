<?php

use cobra_salsa\BigClass;
use cobra_salsa\BigInputObject;
use cobra_salsa\OutputClass;

require_once __DIR__ . '/bigHead.php';
require_once 'classes/BigInputObject.php';
require_once 'classes/OutputClass.php';
/**
 * @var string $fecha2
 * @var BigClass $bc
 */
$fecha3 = filter_input(INPUT_GET, 'fecha3');
$fecha4 = filter_input(INPUT_GET, 'fecha4');
$gestor = filter_input(INPUT_GET, 'gestor');
$cliente = filter_input(INPUT_GET, 'cliente');
$tipo = filter_input(INPUT_GET, 'tipo');
$go = filter_input(INPUT_GET, 'go');
if (!empty($fecha1)) {
    $bio = new BigInputObject($fecha1, $fecha2, $gestor, $cliente, $fecha3, $fecha4, $tipo);
    $result = $bc->getProms($bio);
    if ($result) {
        $filename = "Query_de_promesas.xlsx";
        $headers = array_keys($result[0]);
        $oc = new OutputClass();
        try {
            $oc->writeXLSXFile($filename, $result, $headers);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
} else {
    $gestores = $bc->getGestionGestores();
    $clientes = $bc->getGestionClientes();
    $flag = 'proms';
    $title = 'Query de las Promesas/Propuestas';
    require_once __DIR__ . '/views/bigView.php';
}