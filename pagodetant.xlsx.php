<?php
require_once 'vendor/autoload.php';

use Box\Spout\Common\Exception\InvalidArgumentException as InvalidArgumentExceptionAlias;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\Writer\Exception\WriterNotOpenedException;
use cobra_salsa\PdoClass;
use cobra_salsa\PagosClass;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

require_once 'classes/PdoClass.php';
require_once 'classes/PagosClass.php';
$pd      = new PdoClass();
$pdo       = $pd->dbConnectAdmin();
$pc = new PagosClass($pdo);
$capt      = filter_input(INPUT_GET, 'capt');
$go        = filter_input(INPUT_GET, 'go');
$thismonth = strftime("%B %Y");
$lastmonth = strftime("%B_%Y", strtotime("last month"));
$result = $pc->queryOldSheet();
$filename = "Pagos_".$lastmonth.".xlsx";
$output   = array();
$output[] = array_keys($result[0]);
foreach ($result as $row) {
    $row['monto'] = (float) $row['monto'];
    $output[]     = $row;
}
try {
    $writer = WriterFactory::create(Type::XLSX);
    $writer->openToBrowser($filename); // stream data directly to the browser
    $writer->addRows($output); // add multiple rows at a time
} catch (IOException $e) {
} catch (UnsupportedTypeException $e) {
} catch (WriterNotOpenedException $e) {
} catch (InvalidArgumentExceptionAlias $e) {
}
$writer->close();
