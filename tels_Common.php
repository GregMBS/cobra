<?php
if (!empty($get['fecha1'])) {
    $statement = $pdo->query($querymain);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $filename = "Query_de_telefonos_" . date('ymd') . ".xlsx";
    $output = array();
    $output[] = array_keys($result[0]);
    foreach ($result as $row) {
        $output[] = $row;
    }
    $writer = WriterFactory::create(Type::XLSX);
    $writer->openToBrowser($filename); // stream data directly to the browser
    $writer->addRows($output); // add multiple rows at a time
    $writer->close();
} else {
    $begin = new DateTime('first day of last month');
    $endday = new DateTime('now');
    $end = $endday->modify('+1 day');

    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($begin, $interval, $end);
    $here = $_SERVER['PHP_SELF'];
    require_once 'views/tels_View.php';
}