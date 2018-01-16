<?php
require_once 'vendor/autoload.php';

use cobra_salsa\PdoClass;
use cobra_salsa\PagosClass;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

require_once 'classes/PdoClass.php';
require_once 'classes/PagosClass.php';
$pdoc      = new PdoClass();
$pdo       = $pdoc->dbConnectAdmin();
$pc = new PagosClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$fecha1 = filter_input(INPUT_GET, 'fecha1');
$fecha2 = filter_input(INPUT_GET, 'fecha2');
$cliente = filter_input(INPUT_GET, 'cliente');
if (filter_has_var(INPUT_GET, 'go')) {
    $result = $pc->queryAll($fecha1, $fecha2, $cliente);
    $filename = "pagos.xlsx";
    $output   = array();
    $output[] = array_keys($result[0]);
    foreach ($result as $row) {
        $row['monto'] = (float) $row['monto'];
        $output[]     = $row;
    }
    $writer = WriterFactory::create(Type::XLSX);
    $writer->openToBrowser($filename); // stream data directly to the browser
    $writer->addRows($output); // add multiple rows at a time
    $writer->close();
} else {
    require_once 'views/pagosqueryView.php';
}