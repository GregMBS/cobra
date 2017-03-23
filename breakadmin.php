<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\BreaksClass;

require_once 'classes/PdoClass.php';
require_once 'classes/BreaksClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$bc = new BreaksClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_GET, 'go');
$tipo = filter_input(INPUT_GET, 'tipo');
$auto = filter_input(INPUT_GET, 'auto');
$gestor = filter_input(INPUT_GET, 'gestor');
$ehora = filter_input(INPUT_GET, 'ehora');
$emin = filter_input(INPUT_GET, 'emin');
$empieza = $ehora . ':' . $emin . ':00';
$thora = filter_input(INPUT_GET, 'thora');
$tmin = filter_input(INPUT_GET, 'tmin');
$termina = $thora . ':' . $tmin . ':00';

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
$resultti = $bc->listUsuarias();
require_once 'views/breakadminView.php';