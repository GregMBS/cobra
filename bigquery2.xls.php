<?php
set_time_limit(300);

use cobra_salsa\PdoClass;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

require_once 'vendor/autoload.php';
require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
$get = filter_input_array(INPUT_GET);

require_once 'bigqueryCommon.php';
if (isset($get['fecha1'])) {
    $filename = "Query_de_gestiones_".$fecha1.'_'.$fecha2.".xlsx";
    $output   = array();
    $i = 0;

    while ($row = $stm->fetch(\PDO::FETCH_ASSOC)) {
        if ($i==0) {
            $output[] = array_keys($row);
        }
        $row['saldo_total']       = (float) $row['saldo_total'];
        $row['saldo_descuento_1'] = (float) $row['saldo_descuento_1'];
        $row['saldo_descuento_2'] = (float) $row['saldo_descuento_2'];
        $output[] = $row;
        $i++;
    }
    $writer = WriterFactory::create(Type::XLSX);
    $writer->openToBrowser($filename); // stream data directly to the browser
    $writer->addRows($output); // add multiple rows at a time
    $writer->close();
} else {
    require_once 'views/bigqueryView.php';
}
