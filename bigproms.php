<?php

set_time_limit(300);
require_once 'vendor/autoload.php';

use cobra_salsa\BigClass;
use cobra_salsa\BigInputObject;
use cobra_salsa\OutputClass;
use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/BigClass.php';
require_once 'classes/BigInputObject.php';
require_once 'classes/OutputClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
$bc = new BigClass($pdo);
$oc = new OutputClass();
$capt = filter_input(INPUT_GET, 'capt');
$fecha1 = filter_input(INPUT_GET, 'fecha1');
$fecha2 = filter_input(INPUT_GET, 'fecha2');
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
		$output = array();
		$output[] = array_keys($result[0]);
		foreach ($result as $row) {
			$output[] = $row;
        $i++;
		}
        try {
            $oc->writeXLSXFile($filename, $output);
        } catch (Exception $e) {
		    die($e->getMessage());
        }
    }
} else {
	$resultg = $bc->getGestionGestores();
	$resultc = $bc->getGestionClientes();
	$resultdf = $bc->getGestionDates('ASC');
	$resultfd = $bc->getGestionDates('DESC');
	$resultdp = $bc->getPromDates('ASC');
	$resultpd = $bc->getPromDates('DESC');
	$title = 'Query de las Promesas/Propuestas';
	require 'views/bigView.php';
}