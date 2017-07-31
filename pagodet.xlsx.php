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
$capt      = filter_input(INPUT_GET, 'capt');
$go        = filter_input(INPUT_GET, 'go');
$thismonth = strftime("%B %Y");
$lastmonth = strftime("%B %Y", strtotime("last month"));
$result = $pc->querySheet();
$filename = "Pagos_".trim(date('ym')).".xlsx";
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
