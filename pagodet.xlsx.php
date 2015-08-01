<?php
require_once 'vendor/autoload.php';

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

require_once 'pdoConnect.php';
$pdoc      = new pdoConnect();
$pdo       = $pdoc->dbConnectAdmin();
$capt      = filter_input(INPUT_GET, 'capt');
$go        = filter_input(INPUT_GET, 'go');
$thismonth = strftime("%B %Y");
$lastmonth = strftime("%B %Y", strtotime("last month"));
$queryDA   = "select cuenta, fecha, monto,
                    pagos.cliente as 'cliente',
                    status_de_credito as 'sdc',
                    gestor, confirmado
from pagos, resumen
where fecha>last_day(curdate()-interval 5 week)
and pagos.id_cuenta=resumen.id_cuenta
order by cliente,gestor,fecha";
$std   = $pdo->query($queryDA);
if (!$std) {
    var_dump($pdo->errorInfo());
    die();
}
$result = $std->fetchAll(PDO::FETCH_ASSOC);
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
