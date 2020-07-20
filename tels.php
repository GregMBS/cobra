<?php
set_time_limit(300);
require_once 'vendor/autoload.php';


use Box\Spout\Common\Exception\IOException;
use Box\Spout\Writer\Exception\WriterNotOpenedException;
use cobra_salsa\PdoClass;
use cobra_salsa\TelsClass;

require_once 'classes/PdoClass.php';
require_once 'classes/TelsClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
$tc = new TelsClass($pdo);
$fecha1 = filter_input(INPUT_GET, 'fecha1');
$fecha2 = filter_input(INPUT_GET, 'fecha2');
$tipo = filter_input(INPUT_GET, 'tipo');
$capt = $pc->capt;
if (!empty($fecha1)) {
    switch ($tipo) {
        case 'marcados':
            $tc->createMarcados($fecha1, $fecha2);
            $result = $tc->getMercadosReport();
            break;

        case 'contactados':
            $tc->createContactos($fecha1, $fecha2);
            $result = $tc->getContactosReport();
            break;
    }
}

if (isset($result)) {
    try {
        $tc->outputDocument($result);
    } catch (IOException $e) {
    } catch (\Box\Spout\Common\Exception\InvalidArgumentException $e) {
    } catch (WriterNotOpenedException $e) {
    }
} else {
    $dateRange = $tc->getDates();
    require_once 'views/tels_View.php';
}