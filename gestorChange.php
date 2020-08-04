<?php

use cobra_salsa\GestorChangeClass;
use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
require_once 'classes/GestorChangeClass.php';

$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
$gc = new GestorChangeClass($pdo);
$capt = $pd->capt;
$go = filter_input(INPUT_POST, 'go');
$dataRaw = filter_input(INPUT_POST, 'data');
$post = filter_input_array(INPUT_POST);
$msg = "";
$gestores = $gc->listGestores($post['ejecutivo_asignado-call-center']);
if (!empty($go)) {
    if ($go == 'cargar') {
        $data = preg_split("/[\s,]+/", $dataRaw, 0, PREG_SPLIT_NO_EMPTY);
        $report = $gc->listCuentas($data);
    }
    if ($go == 'cambiar') {
        $ok = $gc->changeGestor($post['cliente'], $post['numero_de_cuenta'], $post['ejecutivo_asignado-call-center'], $post['status_de_credito']);
    }
}
require_once __DIR__. '/views/gestorChangeView.php';

