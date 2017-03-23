<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\DIMEXClass;
use gregmbs\cobra\OutputClass;

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