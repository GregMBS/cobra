<?php

use cobra_salsa\PdoClass;
use cobra_salsa\DIMEXClass;
use cobra_salsa\OutputClass;

require_once 'classes/PdoClass.php';
require_once 'classes/DIMEXClass.php';
require_once 'classes/OutputClass.php';

$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$dc       = new DIMEXClass($pdo);
$result   = $dc->outputReport();
$oc       = new OutputClass();
$filename = "Reporte_de_DIMEX_".date('ymd').".xlsx";
$headers  = $result['headers'];
$data     = $result['data'];
$oc->writeXLSXFile($filename, $data, $headers);