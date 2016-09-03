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
$querycc = "select id_cuenta, numero_de_cuenta as cuenta,
				    nombre_deudor as nombre, resumen.cliente,
				    saldo_total, q(status_aarsa) as queue,
				    completo as gestor, fechaout, fechain
from resumen join vasign on c_cont=id_cuenta 
join nombres on iniciales=gestor 
where gestor = :gestor 
order by fechain desc";
$stm = $pdo->prepare($querycc);
$stm->bindParam(':gestor', $gestor);
$stm->execute();
$resultcc = $stm->fetchAll(\PDO::FETCH_ASSOC);
require_once 'views/checkinView.php';