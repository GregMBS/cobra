<?php
require_once 'classes/pdoConnect.php';
$pdoc      = new pdoConnect();
$pdo       = $pdoc->dbConnectUser();
$capt      = filter_input(INPUT_GET, 'capt');
$ID_CUENTA = filter_input(INPUT_GET, 'id_cuenta');
$querycc   = "SELECT numero_de_cuenta, cliente
FROM resumen 
WHERE id_cuenta=:id";
$stc       = $pdo->prepare($querycc);
$stc->bindParam(':id', $ID_CUENTA);
$stc->execute();
$resultcc  = $stc->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultcc as $answercc) {
    $CUENTA  = $answercc['numero_de_cuenta'];
    $CLIENTE = $answercc['cliente'];
}
$querysub = "SELECT fecha,monto,confirmado
FROM cobra.pagos
WHERE id_cuenta=:id
ORDER BY fecha";
$sts      = $pdo->prepare($querysub);
$sts->bindParam(':id', $ID_CUENTA);
$sts->execute();
$rowsub   = $sts->fetchAll(PDO::FETCH_ASSOC);
require_once 'views/pagosView.php';