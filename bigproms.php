<?php

set_time_limit(300);
require_once 'vendor/autoload.php';

use cobra_salsa\PdoClass;
use cobra_salsa\BigClass;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

require_once 'classes/PdoClass.php';
require_once 'classes/BigClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$bc = new BigClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$get = filter_input_array(INPUT_GET);

if (isset($get['fecha1'])) {
    $go = $get['go'];
    $fecha3 = $get['fecha3'];
    $fecha4 = $get['fecha4'];
    $result = $bc->getProms($get);
    $filename = "Query_de_promesas_" . $fecha3 . '_' . $fecha4 . ".xlsx";
    $output = array();
    $output[] = array_keys($result[0]);
    foreach ($result as $row) {
        $output[] = $row;
    }
    $writer = WriterFactory::create(Type::XLSX);
    $writer->openToBrowser($filename); // stream data directly to the browser
    $writer->addRows($output); // add multiple rows at a time
    $writer->close();
} else {
    $resultg = $bc->getGestionGestores();
    $resultc = $bc->getGestionClientes();
    $resultdf = $bc->getGestionDates('ASC');
    $resultfd = $bc->getGestionDates('DESC');
    $resultdp = $bc->getPromDates('ASC');
    $resultpd = $bc->getPromDates('DESC');
    require 'views/bigpromsView.php';
}