<?php

use cobra_salsa\PdoClass;
use cobra_salsa\TroubleClass;

require_once 'classes/PdoClass.php';
require_once 'classes/TroubleClass.php';
$pdoc    = new PdoClass();
$pdo     = $pdoc->dbConnectUser();
$tc = new TroubleClass($pdo);
$capt    = filter_input(INPUT_GET, 'capt');
$sistema = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP);
$go      = filter_input(INPUT_GET, 'go');
$ccont   = filter_input(INPUT_GET, 'C_CONT');
if ($go == 'ENVIAR') {
    $fechahora   = date('Y-m-d H:i:s');
    $fuente      = filter_input(INPUT_GET, 'fuente');
    $descripcion = filter_input(INPUT_GET, 'descripcion');
    $error_msg   = filter_input(INPUT_GET, 'error_msg');
    $tc->insertTrouble($sistema, $capt, $fuente, $descripcion, $error_msg);
    $message     = 'Error en '.$fuente.' de sistema '.$sistema.' y usuario '.$usuario.' enviado '.$fechahora;
}
require_once 'views/troubleView.php';