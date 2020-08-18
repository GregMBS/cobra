<?php

use cobra_salsa\PdoClass;
use cobra_salsa\DhClass;

require_once 'classes/PdoClass.php';
require_once 'classes/DhClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
$dc = new DhClass($pdo);
$capt = $pd->capt;
$gestor = filter_input(INPUT_GET, 'gestor');
$fecha = filter_input(INPUT_GET, 'fecha');
$result = $dc->getDhMain($gestor, $fecha);
$sumProm = 0;
$sumSaldo = 0;
foreach($result as $item){
    $sumProm += $item->n_prom;
    $sumSaldo += $item->saldo_total;
}
require_once 'views/dhView.php';
