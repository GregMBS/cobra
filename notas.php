<?php

use cobra_salsa\PdoClass;
use cobra_salsa\NotaClass;

require_once 'classes/PdoClass.php';
require_once 'classes/NotaClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectUser();
$nc = new NotaClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$CUENTA = filter_input(INPUT_GET, 'CUENTA');
$C_CONT = (int) filter_input(INPUT_GET, 'C_CONT', FILTER_VALIDATE_INT);
$go = filter_input(INPUT_GET, 'go');
$HORA = (int) filter_input(INPUT_GET, 'HORA', FILTER_VALIDATE_INT);
$MIN = (int) filter_input(INPUT_GET, 'MIN', FILTER_VALIDATE_INT);
$NOTA = filter_input(INPUT_GET, 'NOTA');
$FECHA = filter_input(INPUT_GET, 'FECHA');
if ($go === 'GUARDAR') {
    $D_FECH = date('Y-m-d');
    $C_HORA = date('H:i:s');
    $HoraStr = str_pad($HORA, 2, "0", STR_PAD_LEFT) . ':'
                . str_pad($MIN, 2, "0", STR_PAD_LEFT) . ':00';
    $nc->softDeleteNotas($capt, $C_CONT);
    $nc->insertNota($capt, $D_FECH, $C_HORA, $FECHA, $HoraStr, $NOTA, $CUENTA, $C_CONT);
    $redirector = "Location: notas.php?capt='" . $capt . "'&go=FromGuardar";
    header($redirector);
}
if ($go === 'BORRAR') {
    $AUTO = (int) filter_input(INPUT_GET, 'which', FILTER_VALIDATE_INT);
    $nc->softDeleteOneNota($capt, $AUTO);
    $redirector = "Location: notas.php?capt=" . $capt . "&go=FromBorrar";
    header($redirector);
}
$result = $nc->listMyNotas($capt);
require_once 'views/notasView.php';