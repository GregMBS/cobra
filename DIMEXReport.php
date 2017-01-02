<?php

use cobra_salsa\OutputClass;

require_once 'vendor/autoload.php';
require_once 'DIMEXModels.php';
$dc       = new DIMEXModels();
$result   = $dc->outputReport();
$oc       = new OutputClass();
$filename = "Reporte_de_DIMEX_".date('ymd').".xlsx";
$headers  = $result['headers'];
$data     = $result['data'];
$oc->writeXLSXFile($filename, $data, $headers);