<?php
require_once 'classes/pdoConnect.php';
$pdoc = new pdoConnect();
$pdo = $pdoc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');
$gestor = filter_input(INPUT_GET, 'gestor');

/**
 * 
 * @param PDO $pdo
 * @param string $CUENTA
 * @param string $CLIENTE
 * @return array
 */
function getPagos($pdo, $CUENTA, $CLIENTE) {
    $querypag = "select sum(monto) as sm, max(fecha) as mf "
            . "from pagos "
            . "where CUENTA=:cuenta and CLIENTE=':cliente;";
    $stp = $pdo->prepare($querypag);
    $stp->bindParam(':cuenta', $CUENTA);
    $stp->bindParam(':cliente', $CLIENTE);
    $stp->execute();
    $resultp = $stp->fetchAll(PDO::FETCH_ASSOC);
    return $resultp;
}

$query = "SELECT d_prom, cuenta, n_prom, c_cvge, "
        . "ejecutivo_asignado_call_center, status_aarsa, saldo_vencido, "
        . "cliente,id_cuenta,saldo_descuento_1 "
        . "FROM historia JOIN resumen on c_cont=id_cuenta "
        . "WHERE n_prom>0 AND c_cvge =:gestor "
        . "GROUP BY cuenta ORDER BY c_cvge,d_prom,cliente,cuenta";
$stq = $pdo->prepare($query);
$stq->bindParam(':gestor', $gestor);
$stq->execute();
$result = $stq->fetchAll(PDO::FETCH_ASSOC);
require_once 'views/gestorView.php';