<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
$vst = filter_input(INPUT_GET, 'visitador');
$visitstr = '';
$visitador = 'TODOS';
if (isset($vst)) {
    $queryn = "SELECT completo FROM nombres
where iniciales=:vst
limit 1;";
    $stn = $pdo->prepare($queryn);
    $stn->bindParam(':vst', $vst);
    $stn->execute();
    $resultn = $stn->fetch(\PDO::FETCH_ASSOC);
    if ($resultn) {
        $visitador = $resultn['completo'];
        $visitstr = " and gestor=:vst ";
    }
}

$querymain = "SELECT id_cuenta, gestor, cuenta, saldo_total, cliente,
    q(status_aarsa) as 'queue', nombre_deudor as nombre, fechaout, fechain
FROM vasign,resumen 
where (c_cont=id_cuenta)
and fechaout > last_day(curdate()) - interval 3 month - interval 1 day
" . $visitstr . "
order by gestor,fechaout,cuenta+0
;";
$stm = $pdo->prepare($querymain);
if ($visitador != 'TODOS') {
    $stm->bindParam(':vst', $vst);
}
$stm->execute();
$result = $stm->fetchAll(\PDO::FETCH_ASSOC);
require_once 'views/checkoutlistView.php';
