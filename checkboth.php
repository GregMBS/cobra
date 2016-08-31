<?php

use cobra_salsa\PdoClass;
use cobra_salsa\CheckClass;

require_once 'classes/PdoClass.php';
require_once 'classes/CheckClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$cc = new CheckClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');
$tipo = filter_input(INPUT_GET, 'tipo');
$go = filter_input(INPUT_GET, 'go');
$gestor = filter_input(INPUT_GET, 'gestor');
$CUENTA = trim(filter_input(INPUT_GET, 'CUENTA'));
$fechaout = filter_input(INPUT_GET, 'fechaout');
$message = '';
if ($go == 'RECIBIR') {
    if (!empty($CUENTA)) {
        $ID_CUENTA = $cc->getIdCuentafromCuenta($CUENTA);
        if ($ID_CUENTA > 0) {
            $cc->insertVasign($CUENTA, $gestor, $fechaout, $ID_CUENTA);
        } else {
            $message = 'No se guard&oacute;';
        }
    }
}
$result = $cc->getVisitadores();
$resultd = $cc->getOneMonth();
$resultcount = $cc->countInOut($gestor);
$querymain = "select id_cuenta, numero_de_cuenta, nombre_deudor, cliente, saldo_total,
q(status_aarsa),completo, fechaout, fechain
from resumen join vasign on id_cuenta=c_cont join nombres on iniciales=gestor " . $gstring;
$stm = $pdo->query($querymain);
if (!empty($gestor)) {
    $stm->bindParam(':gestor', $gestor);
}
$stm->execute();
$resultmain = $stm->fetchAll();
require_once 'views/checkbothView.php';