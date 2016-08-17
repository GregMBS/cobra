<?php
require_once 'classes/pdoConnect.php'; // returns $pdo
$pdoc      = new pdoConnect();
$pdo       = $pdoc->dbConnectUser();
$capt      = filter_input(INPUT_GET, 'capt');
$querymain = "SELECT numero_de_cuenta, nombre_deudor, saldo_total,
status_de_credito, cliente, status_aarsa,
saldo_descuento_2, id_cuenta,
fecha_ultima_gestion
FROM resumen
where status_de_credito not regexp '-'
and ejecutivo_asignado_call_center = :capt
";
$stm       = $pdo->prepare($querymain);
$stm->bindParam(':capt', $capt);
$stm->execute();
$result    = $stm->fetchAll(PDO::FETCH_ASSOC);
require_once 'views/migoView.php';