<?php

use cobra_salsa\PdoClass;
use cobra_salsa\NotaClass;

require_once 'classes/PdoClass.php';
require_once 'classes/NotaClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectUser();
$nc = new NotaClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_GET, 'go');
$HORA = filter_input(INPUT_GET, 'HORA');
$NOTA = filter_input(INPUT_GET, 'NOTA');
$target = filter_input(INPUT_GET, 'target');
$year = filter_input(INPUT_GET, 'formYear', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/0-9/")));
$month = filter_input(INPUT_GET, 'formMonth', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/0-9/")));
$day = filter_input(INPUT_GET, 'formDay', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/0-9/")));
if (!empty($go)) {
    if ($go == 'GUARDAR') {
        $FECHA = date($year . '-' . $month . '-' . $day);
        $nc->insertNotaAdmin($target, $capt, $FECHA, $HORA, $NOTA);
        $redirector = "Location: notadmin.php?capt=" . $capt;
        header($redirector);
    }
    if ($go == 'BORRAR') {
        $AUTO = filter_input(INPUT_GET, 'which', FILTER_VALIDATE_INT);
        $nc->softDeleteOneNotaAdmin($AUTO);
        $redirector = "Location: notadmin.php?capt=" . $capt;
        header($redirector);
    }
}
$rowsub = $nc->listAllNotas();
$rowt = $nc->listUsers();
require_once 'views/notadminView.php';
