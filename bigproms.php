<?php

set_time_limit(300);
require_once 'vendor/autoload.php';

use Box\Spout\Common\Exception\InvalidArgumentException as InvalidArgumentExceptionAlias;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Exception\WriterNotOpenedException;
use Box\Spout\Writer\WriterFactory;
use cobra_salsa\BigClass;
use cobra_salsa\BigInputObject;
use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/BigClass.php';
require_once 'classes/BigInputObject.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
$bc = new BigClass($pdo);
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
		}
        try {
            $writer = WriterFactory::create(Type::XLSX);
        } catch (UnsupportedTypeException $e) {
        }
        try {
            $writer->openToBrowser($filename);
        } catch (IOException $e) {
        } // stream data directly to the browser
        try {
            $writer->addRows($output);
        } catch (IOException $e) {
        } catch (InvalidArgumentExceptionAlias $e) {
        } catch (WriterNotOpenedException $e) {
        } // add multiple rows at a time
		$writer->close();
	}
} else {
	$resultg = $bc->getGestionGestores();
	$resultc = $bc->getGestionClientes();
	$resultdf = $bc->getGestionDates('ASC');
	$resultfd = $bc->getGestionDates('DESC');
	$resultdp = $bc->getPromDates('ASC');
	$resultpd = $bc->getPromDates('DESC');
	require 'views/bigpromsView.php';
}