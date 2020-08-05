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
$post = filter_input_array(INPUT_POST);
$result = $gc->changeGestor($post['id_cuenta'], $post['agent'], $post['status_de_credito']);
echo json_encode($result);
