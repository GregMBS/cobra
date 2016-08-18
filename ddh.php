<?php
require_once 'classes/pdoConnect.php';
$pdoc      = new pdoConnect();
$pdo       = $pdoc->dbConnectAdmin();
$capt      = filter_input(INPUT_GET, 'capt');
$gestor    = filter_input(INPUT_GET, 'gestor');
$fecha     = filter_input(INPUT_GET, 'fecha');
$querymain = "select numero_de_cuenta, nombre_deudor,
    saldo_total, status_de_credito, status_aarsa,
    ejecutivo_asignado_call_center,
    dias_vencidos, c_cvst, c_hrin,
    saldo_descuento_2, producto, estado_deudor,
    ciudad_deudor, cliente, id_cuenta,
    n_prom, d_prom, vcc(status_aarsa) as 'vcc'
    from resumen
    join historia on id_cuenta=c_cont
    where c_cvge=:gestor and d_fech=:fecha
    ORDER BY d_fech, c_hrin;";
$stm       = $pdo->prepare($querymain);
$stm->bindParam(':gestor', $gestor);
$stm->bindParam(':fecha', $fecha);
$stm->execute();
$result    = $stm->fetchAll(PDO::FETCH_ASSOC);
require_once 'views/ddhView.php';