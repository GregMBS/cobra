<?php
require_once 'classes/PdoClass.php';
$pdoc    = new PdoClass();
$pdo     = $pdoc->dbConnectUser();
$capt    = filter_input(INPUT_GET, 'capt');
$sistema = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP);
$go      = filter_input(INPUT_GET, 'go');
$ccont   = filter_input(INPUT_GET, 'C_CONT');
if ($go == 'ENVIAR') {
    $fechahora   = date('Y-m-d H:i:s');
    $fuente      = filter_input(INPUT_GET, 'fuente');
    $descripcion = filter_input(INPUT_GET, 'descripcion');
    $error_msg   = filter_input(INPUT_GET, 'error_msg');
    $queryins    = "INSERT INTO cobra.trouble (sistema,usuario,fechahora,fuente,descripcion,error_msg)
VALUES (:sistema, :capt, now(), :fuente, :descripcion, :error_msg)";
    $sti         = $pdo->prepare($queryins);
    $sti->bindParam(':sistema', $sistema);
    $sti->bindParam(':capt', $capt);
    $sti->bindParam(':fuente', $fuente);
    $sti->bindParam(':descripcion', $descripcion);
    $sti->bindParam(':error_msg', $error_msg);
    $sti->exeute();
    $message     = 'Error en '.$fuente.' de sistema '.$sistema.' y usuario '.$usuario.' enviado '.$fechahora;
}
require_once 'views/troubleView.php';