<?php
use cobra_salsa\PdoClass;
use cobra_salsa\PagobulkClass;

require_once 'classes/PdoClass.php';
require_once 'classes/PagobulkClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
$capt = $pd->capt;
$pc = new PagobulkClass($pdo);
$go = filter_input(INPUT_POST, 'go');
$data = filter_input(INPUT_POST, 'data');
$message = '';
if ($go == 'cargar') {
    $pc->cargar($data);
    $message = 'Pagos cargados';
}
require_once 'views/pagobulkView.php';