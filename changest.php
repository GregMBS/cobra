<?php

use cobra_salsa\PdoClass;
use cobra_salsa\ChangestClass;

require_once 'classes/PdoClass.php';
require_once 'classes/ChangestClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
$cc = new ChangestClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_GET, 'go');
$field = filter_input(INPUT_GET, 'field');
$find = filter_input(INPUT_GET, 'find');
$C_CONT = filter_input(INPUT_GET, 'C_CONT');
$cliente = filter_input(INPUT_GET, 'cliente');
$SDC = filter_input(INPUT_GET, 'SDC');
$INACTIVO = filter_input(INPUT_GET, 'inactivo');

if ($go == 'CAMBIAR') {
    $field = 'id_cuenta';
    $find = $C_CONT;
    $TAGA = explode('-', $SDC);
    $TAG = trim($TAGA[0]);
    if (!empty($INACTIVO)) {
        $TAGS = $TAG . '-inactivo';
    } else {
        $TAGS = $TAG;
    }
    $cc->updateResumen($TAGS, $C_CONT);
    $cc->updateRlook($TAGS, $C_CONT);
}
$result = $cc->getReport($field, $find, $cliente);
$resultcl = $cc->listClientes();
require_once 'views/changestView.php';