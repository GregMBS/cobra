<?php

set_time_limit(300);
require_once 'vendor/autoload.php';

use cobra_salsa\PdoClass;
use cobra_salsa\IntensidadClass;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

require_once 'classes/PdoClass.php';
require_once 'classes/IntensidadClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$bc = new IntensidadClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$fecha1 = filter_input(INPUT_GET, 'fecha1');
$fecha2 = filter_input(INPUT_GET, 'fecha2');
$get = filter_input_array(INPUT_GET);

if (!empty($fecha1)) {
    $result = $bc->getByCuenta($fecha1, $fecha2);
    
    $filename = "Query_de_intensidad_".$fecha1.'_'.$fecha2.".xlsx";
    $output   = array();
    $i = 0;

    foreach ($result as $row) {
        if ($i==0) {
            $output[] = array_keys($row);
        }
        $output[] = $row;
        $i++;
    }
    $writer = WriterFactory::create(Type::XLSX);
    $writer->openToBrowser($filename); // stream data directly to the browser
    $sheet = $writer->getCurrentSheet();
    $sheet->setName('PorCuenta');
    $writer->addRows($output); // add multiple rows at a time
    $writer->addNewSheetAndMakeItCurrent();
    $newsheet = $writer->getCurrentSheet();
    $newsheet->setName('PorSegmento');

    $results = $bc->getBySegmento($fecha1, $fecha2);
    
    $outputs   = array();
    $j = 0;

    foreach ($results as $rows) {
        if ($j==0) {
            $outputs[] = array_keys($rows);
        }
        $outputs[] = $rows;
        $j++;
    }
    $writer->addRows($outputs);
    $writer->close();
} else {
    $resultc = $bc->getGestionClientes();
    $resultdf = $bc->getGestionDates('ASC');
    $resultfd = $bc->getGestionDates('DESC');
    require 'views/intensidadView.php';
}
