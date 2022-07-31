<?php

/** @var BigClass $bc */

use cobra_salsa\BigClass;
use cobra_salsa\BigInputObject;
use cobra_salsa\OutputClass;

require_once __DIR__ . '/bigHead.php';
require_once 'classes/BigInputObject.php';
require_once 'classes/OutputClass.php';
$fecha3 = '2007-10-17';
$fecha4 = '2030-12-31';
$gestor = filter_input(INPUT_GET, 'gestor');
$cliente = filter_input(INPUT_GET, 'cliente');
$tipo = filter_input(INPUT_GET, 'tipo');
$go = filter_input(INPUT_GET, 'go');
if (!empty($fecha1)) {
    /** @var string $fecha2 */
    $bio = new BigInputObject($fecha1, $fecha2, $gestor, $cliente, $fecha3, $fecha4, $tipo);
    $result = $bc->getGestiones($bio);
    if ($result) {
        $filename = "Query_de_gestiones.xlsx";
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
    $flag = 'query';
    $title = 'Query de las Gestiones';
    require_once __DIR__ . '/views/bigView.php';
}