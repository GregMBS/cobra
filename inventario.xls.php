<?php
set_time_limit(300);
require_once 'vendor/autoload.php';

use cobra_salsa\PdoClass;
use cobra_salsa\InventarioClass;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

require_once 'classes/PdoClass.php';
require_once 'classes/InventarioClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$ic = new InventarioClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');

if (!empty(filter_input(INPUT_GET, 'go'))) {
    $cliente = filter_input(INPUT_GET, 'cliente');
    $result = $ic->getInventarioReport($cliente);
// Creating a workbook
//$workbook = new Spreadsheet_Excel_Writer();

    $filename = "Query_de_inventario_" . date('ymd') . ".xlsx";

    $output = array();
    $output[] = array_keys($result[0]);
    foreach ($result as $row) {
        $row['saldo_total'] = (float) $row['saldo_total'];
        $output[] = $row;
    }
    $writer = WriterFactory::create(Type::XLSX);
    $writer->openToBrowser($filename); // stream data directly to the browser
    $writer->addRows($output); // add multiple rows at a time
    $writer->close();
} else {
    $resultc = $ic->listClients();
    $here = $_SERVER['PHP_SELF'];
    require_once 'views/inventarioView.php';
}
