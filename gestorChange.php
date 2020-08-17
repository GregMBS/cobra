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
$agent = '';
if (isset($post['agent'])) {
    $agent = $post['agent'];
}
$gestores = $gc->listGestores($agent);
if (!empty($go)) {
    if ($go == 'cargar') {
        $data = preg_split("/[\s,]+/", $dataRaw, 0, PREG_SPLIT_NO_EMPTY);
        $report = $gc->listCuentas($data);
    }
}
require_once __DIR__. '/views/gestorChangeView.php';

