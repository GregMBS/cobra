<?php

require_once 'bigqueryCommon.php';
if (isset($get['fecha1'])) {
    $filename = "Query_de_gestiones_" . $fecha1 . '_' . $fecha2 . ".csv";
    $output = array();
    $output[] = array_keys($result[0]);
    foreach ($result as $row) {
        $row['saldo_total'] = (float) $row['saldo_total'];
        $row['saldo_descuento_1'] = (float) $row['saldo_descuento_1'];
        $row['saldo_descuento_2'] = (float) $row['saldo_descuento_2'];
        $row['n_prom'] = (float) $row['n_prom'];
        $row['n_prom1'] = (float) $row['n_prom1'];
        $row['n_prom2'] = (float) $row['n_prom2'];
        $output[] = $row;
    }
    $writer = WriterFactory::create(Type::CSV);
    $writer->openToBrowser($filename); // stream data directly to the browser
    $writer->addRows($output); // add multiple rows at a time
    $writer->close();
} else {
    require_once 'views/bigqueryView.php';
}
