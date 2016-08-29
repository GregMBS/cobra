<?php

use cobra_salsa\PdoClass;
use cobra_salsa\GestoradminClass;

require_once 'classes/PdoClass.php';
require_once 'classes/GestoradminClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
$gc = new GestoradminClass($pdo);

$go = filter_input(INPUT_GET, 'go');
$completo = filter_input(INPUT_GET, 'completo');
$tipo = filter_input(INPUT_GET, 'tipo');
$usuaria = filter_input(INPUT_GET, 'usuaria');
$passw = filter_input(INPUT_GET, 'passw');
$capt = filter_input(INPUT_GET, 'capt');

if (!empty($go)) {
    if ($go == "GUARDAR") {
        $gc->updateOpenParams($completo, $tipo, $usuaria);
        $gc->updatePassword($passw, $usuaria);
        header("Location: gestoradmin.php?capt=" . $capt);
    }

    if ($go == "BORRAR") {
        $gc->deleteFromNombres($usuaria);
        $gc->deleteFromQueuelist($usuaria);
        $gc->deleteFromResumen($usuaria);
        header("Location: gestoradmin.php?capt=" . $capt);
    }

    if ($go == "AGREGAR") {
        $iniciales = strtolower($usuaria);
        $gc->addToNombres($completo, $tipo, $usuaria, $iniciales, $passw);
        $gc->addToQueuelists($iniciales);
        header("Location: gestoradmin.php?capt=" . $capt);
    }
}
$result = $gc->getNombres();

$groups = $gc->getGroups();
require_once 'views/gestoradminView.php';
