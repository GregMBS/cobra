<?php

require_once 'classes/pdoConnect.php';
$pdoc = new pdoConnect();
$pdo = $pdoc->dbConnectAdmin();
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
if ($go == 'ASIGNAR') {
    if ($tipo == 'id_cuenta') {
        $querycc = "select id_cuenta,numero_de_cuenta
			from resumen where id_cuenta = :cuenta
			and status_de_credito not regexp '-'
			LIMIT 1;";
    } else {
        $querycc = "select id_cuenta, numero_de_cuenta
			from resumen where numero_de_cuenta = :cuenta
			and status_de_credito not regexp '-'
			LIMIT 1;";
    }
    $stc = $pdo->prepare($querycc);
    if (!empty($CUENTA)) {
        $C_CONT = 0;
        $stc->bindParam(':cuenta', $CUENTA);
        $stc->execute();
        $resultcc = $stc->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultcc as $answercc) {
            $C_CONT = $answercc['id_cuenta'];
            $CTA = $answercc['numero_de_cuenta'];
        }
        $queryins = "INSERT INTO vasign
			(cuenta, gestor, fechaout,c_cont)
			VALUES 
			(:cuenta, :gestor, now(), :id_cuenta);";
        $sti = $pdo->prepare($queryins);
        if ($C_CONT > 0) {
            $sti->bindParam(':cuenta', $CTA);
            $sti->bindParam(':gestor', $gestor);
            $sti->bindParam(':id_cuenta', $C_CONT);
            $sti->execute();
        } else {
            $message = 'No se guard&oacute;';
        }
    }
}
$query = "SELECT usuaria, completo 
			    FROM nombres where completo<>'' 
			    and tipo IN ('visitador', 'admin') 
			    order by usuaria";
$result = $pdo->query($query);
$querycount = "select sum(fechaout>curdate()) as asig, 
		    sum(fechain>curdate()) as recib
		    from vasign
		    where gestor = :gestor;";
$stn = $pdo->prepare($querycount);
$stn->bindParam(':gestor', $gestor);
$stn->execute();
$resultcount = $stn->fetchAll(PDO::FETCH_ASSOC);
$gstring = 'and fechaout>=curdate()';
if (!empty($gestor)) {
    $gstring = " and gestor = :gestor order by fechaout desc";
}
$querycc = "SELECT id_cuenta, gestor, cuenta, saldo_total,
			    resumen.cliente, q(status_aarsa) as 'queue',
			    nombre_deudor as nombre, fechaout, fechain
			    FROM vasign,resumen, nombres
where iniciales=gestor and c_cont= id_cuenta " . $gstring;
$stm = $pdo->prepare($querycc);
if (!empty($gestor)) {
    $stm->bindParam(':gestor', $gestor);
}
$stm->execute();
$resultcc = $stm->fetchAll(PDO::FETCH_ASSOC);
require_once 'views/checkoutView.php';
