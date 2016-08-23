<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
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
if ($go == 'RECIBIR') {
    $CUENTA = trim(filter_input(INPUT_GET, 'cuenta'));
    if (!empty($CUENTA)) {
        if ($tipo == 'id_cuenta') {
            $querycta = "select id_cuenta from resumen where id_cuenta = :cuenta";
        } else {
            $querycta = "select id_cuenta from resumen where numero_de_cuenta = :cuenta";
        }
        $stc = $pdo->prepare($querycc);
        $stc->bindParam(':cuenta', $CUENTA);
        $stc->execute();
        $resultcc = $stc->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($resultcc as $answercc) {
            $C_CONT = $answercc['id_cuenta'];
            $CTA = $answercc['numero_de_cuenta'];
        }
        $queryins = "update vasign set fechain=now()
	where c_cont = :id_cuenta
	and fechain is null
	limit 1";
        $sti = $pdo->prepare($queryins);
        $sti->bindParam(':id_cuenta', $C_CONT);
        $sti->execute();
    }
}
$query = "SELECT usuaria,completo
			    FROM nombres
			    where usuaria in
				(select gestor from vasign
				where fechain is null)
			    order by usuaria";
$result = $pdo->query($query);
$querycount = "select sum(fechaout>curdate()) as asig,
		    sum(fechain>curdate()) as recib
		    from vasign
		    where gestor = :gestor;";
$stn = $pdo->prepare($querycount);
$stn->bindParam(':gestor', $gestor);
$stn->execute();
$resultcount = $stn->fetchAll(\PDO::FETCH_ASSOC);
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