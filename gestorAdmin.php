<?php

use cobra_salsa\PdoClass;
use cobra_salsa\GestorAdminClass;

require_once 'classes/PdoClass.php';
require_once 'classes/GestorAdminClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
$gc = new GestorAdminClass($pdo);

$go = filter_input(INPUT_GET, 'go');
$completo = filter_input(INPUT_GET, 'completo');
$tipo = filter_input(INPUT_GET, 'tipo');
$usuaria = filter_input(INPUT_GET, 'usuaria');
$passw = filter_input(INPUT_GET, 'passw');
$capt = filter_input(INPUT_GET, 'capt');

if (!empty($go)) {
    switch ($go) {
        case 'GUARDAR':
            $gc->updateOpenParams($completo, $tipo, $usuaria);
            $gc->updatePassword($passw, $usuaria);
            header("Location: gestorAdmin.php?capt=" . $capt);
            break;
        case 'BORRAR':
            $gc->deleteFromNombres($usuaria);
            $gc->deleteFromQueuelist($usuaria);
            $gc->deleteFromResumen($usuaria);
            header("Location: gestorAdmin.php?capt=" . $capt);
            break;
        case 'AGREGAR':
            $iniciales = strtolower($usuaria);
            $gc->addToNombres($completo, $tipo, $usuaria, $iniciales, $passw);
            $gc->addToQueuelists($iniciales);
            header("Location: gestorAdmin.php?capt=" . $capt);
            break;
    }
}
$result = $gc->getNombres();

$groups = $gc->getGroups();
require_once 'views/gestorAdminView.php';
