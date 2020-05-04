<?php
set_time_limit(300);
require_once 'vendor/autoload.php';


use Box\Spout\Common\Exception\InvalidArgumentException as InvalidArgumentExceptionAlias;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\Writer\Exception\WriterNotOpenedException;
use cobra_salsa\PdoClass;
use cobra_salsa\TelsClass;

require_once 'classes/PdoClass.php';
require_once 'classes/TelsClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
$tc = new TelsClass($pdo);
$fecha1 = filter_input(INPUT_GET, 'fecha1');
$fecha2 = filter_input(INPUT_GET, 'fecha2');
$capt = $pd->capt;
if (!empty($fecha1)) {
    $tc->createContactos($fecha1, $fecha2);
    $result = $tc->getContactosReport();
}
if (isset($result)) {
    try {
        $tc->outputDocument($result);
    } catch (IOException $e) {
    } catch (InvalidArgumentExceptionAlias $e) {
    } catch (UnsupportedTypeException $e) {
    } catch (WriterNotOpenedException $e) {
    }
} else {
    $begin = new DateTime('first day of last month');
    $endDay = new DateTime('now');
    $end = $endDay->modify('+1 day');

    $interval = new DateInterval('P1D');
    $dateRange = new DatePeriod($begin, $interval, $end);
    $here = $_SERVER['PHP_SELF'];
    require_once 'views/tels_View.php';
}