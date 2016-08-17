<?php
require_once 'classes/pdoConnect.php';
$pc	 = new pdoConnect();
$pdo	 = $pc->dbConnectAdmin();
set_time_limit(300);
$capt	 = filter_input(INPUT_GET, 'capt');
$cliente = filter_input(INPUT_GET, 'cliente');
$queue	 = filter_input(INPUT_GET, 'queue');
$sdc	 = filter_input(INPUT_GET, 'status_de_credito');
$rato	 = filter_input(INPUT_GET, 'rato');
$ratostr = "";
switch ($rato) {
	case 'diario':
		$ratostr = " AND fecha_ultima_gestion>curdate() ";
		break;
	case 'semanal':
		$ratostr = "AND week(fecha_ultima_gestion)=week(curdate())
        AND year(fecha_ultima_gestion)=year(curdate()) ";
		break;
	case 'mensual':
		$ratostr = "AND fecha_ultima_gestion > last_day(curdate() - interval 1 month) + interval 1 day ";
		break;
}
$sdcstr = 'AND status_de_credito not regexp "-" ';
if (!(empty($sdc))) {
	$sdcstr = "AND status_de_credito=:sdc ";
}
$querymain	 = "SELECT numero_de_cuenta, nombre_deudor, saldo_total,
	status_aarsa, ejecutivo_asignado_call_center, sum(monto) as sm,
	status_de_credito, producto, estado_deudor, ciudad_deudor,
	resumen.cliente as cli, resumen.id_cuenta as idc,
	fecha_ultima_gestion, saldo_vencido
FROM resumen
JOIN dictamenes ON dictamen=status_aarsa
LEFT JOIN pagos using (id_cuenta)
WHERE resumen.cliente=:cliente
AND queue=:queue ".$sdcstr.$ratostr.
    " GROUP BY id_cuenta
ORDER BY saldo_total desc";
$stm		 = $pdo->prepare($querymain);
$stm->bindParam(':cliente', $cliente);
$stm->bindParam(':queue', $queue);
if (!(empty($sdc))) {
	$stm->bindParam(':sdc', $sdc);
}
$stm->execute();
$result	 = $stm->fetchAll(PDO::FETCH_ASSOC);
require_once 'views/speclistqcView.php';