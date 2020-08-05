<?php

use cobra_salsa\PdoClass;
use cobra_salsa\BreaksClass;

require_once 'classes/PdoClass.php';
require_once 'classes/BreaksClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
$bc = new BreaksClass($pdo);
$capt = $pd->capt;
$get = filter_input_array(INPUT_POST);
$go = filter_input(INPUT_POST, 'go');
$tipo = filter_input(INPUT_POST, 'tipo');
$auto = filter_input(INPUT_POST, 'auto');
$gestor = filter_input(INPUT_POST, 'gestor');
$empieza = filter_input(INPUT_POST, 'empieza');
$termina = filter_input(INPUT_POST, 'termina');

if (!empty($go)) {
    var_dump($get);
    die();
}

if ($go == "CAMBIAR") {
    $bc->updateBreak($auto, $tipo, $empieza, $termina);
}

if ($go == "BORRAR") {
    $bc->deleteBreak($auto);
}

if ($go == "AGREGAR") {
    $bc->insertBreak($gestor, $empieza, $empieza, $termina);
}

$result = $bc->listBreaks();
$gestores = $bc->listUsuarias();
require_once 'views/breakAdminView.php';