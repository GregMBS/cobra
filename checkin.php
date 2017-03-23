<?php


use gregmbs\cobra\PdoClass;
use gregmbs\cobra\CheckClass;

require_once 'classes/PdoClass.php';
require_once 'classes/CheckClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$cc = new CheckClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$tipo = filter_input(INPUT_GET, 'tipo');
$get = filter_input_array(INPUT_GET);
$gestor = filter_input(INPUT_GET, 'gestor');
$CUENTA = trim(filter_input(INPUT_GET, 'CUENTA'));
if (empty($tipo)) {
    $tipo = 'id_cuenta';
}
$message = '';
$go = filter_input(INPUT_GET, 'go');
if ($go == 'RECIBIR') {
    if (!empty($CUENTA)) {
        $cc->updateVasign($tipo, $CUENTA);
    }
}
$result = $cc->getVisitadores();
$resultcount = $cc->countInOut($gestor);
$resultcc = $cc->listVasign($gestor);
require_once 'views/checkinView.php';