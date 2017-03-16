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
$fecha1 = filter_input(INPUT_GET, 'fecha1');
$fecha2 = filter_input(INPUT_GET, 'fecha2');
$gestor = filter_input(INPUT_GET, 'gestor');
$cliente = filter_input(INPUT_GET, 'cliente');
$tipo = filter_input(INPUT_GET, 'tipo');
$get = filter_input_array(INPUT_GET);

if (!empty($fecha1)) {
    $result = $bc->getBigGestiones($fecha1, $fecha2, $gestor, $cliente);
    
    
    $filename = "Query_de_gestiones_".$fecha1.'_'.$fecha2.".xlsx";
    $output   = array();
    $i = 0;

    foreach ($result as $row) {
        if ($i==0) {
            $output[] = array_keys($row);
        }
        $row['saldo_total']       = (float) $row['saldo_total'];
        $output[] = $row;
        $i++;
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
    require 'views/bigqueryView.php';
}
