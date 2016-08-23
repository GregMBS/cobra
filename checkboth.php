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
$message = '';
$go = $get['go'];
$fechaout = filter_input(INPUT_GET, 'fechaout');
if ($go == 'RECIBIR') {
    if (!empty($CUENTA)) {
        $querycc = "select id_cuenta from resumen
where ((numero_de_cuenta=:cuenta and cliente<>'Prestamo Relampago')
or (numero_de_credito=:cuenta and cliente='Prestamo Relampago'))
and status_de_credito=who(status_de_credito);";
        $stcc = $pdo->prepare($querycc);
        $stcc->bindParam(':cuenta', $CUENTA);
        $stcc->execute();

        $resultcc = $stcc->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($resultcc as $answercc) {
            $ID_CUENTA = $answercc['id_cuenta'];
        }
        $queryins = "INSERT INTO vasign (cuenta, gestor, fechaout, fechain,c_cont)
VALUES (:cuenta, :gestor, :fechaout, now(), :idc);";
        $sti = $pdo->prepare($queryins);
        if ($C_CONT > 0) {
            $sti->bindParam(':cuenta', $CUENTA);
            $sti->bindParam(':gestor', $gestor);
            $sti->bindParam(':fechaout', $fechaout);
            $sti->bindParam(':id_cuenta', $ID_CUENTA);
            $sti->execute();
        } else {
            $message = 'No se guard&oacute;';
        }
    }
}
$query = "SELECT usuaria,completo FROM nombres where completo<>''
and (tipo='visitador' or tipo='admin')";
$result = $pdo->query($query);
$queryd = "SELECT distinct concat_ws('-',year(d_fech),month(d_fech),day(d_fech)) FROM historia
where d_fech between (curdate()-interval 1 month) AND curdate()
order by d_fech
";
$resultd = $pdo->query($queryd);
$querycount = "select sum(fechaout>curdate()),sum(fechain>curdate()) from vasign
where gestor=:gestor";
$stc = $pdo->query($querycount);
$stc->bindParam(':gestor', $gestor);
$stc->execute();
$resultcount = $stc->fetchAll();
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