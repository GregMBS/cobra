<?php
use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';

$pc = new PdoClass();
$pdo = $pc->dbConnectNobody();
$ticket = filter_input(INPUT_COOKIE, 'auth');
$queryCheck="SELECT gestor,nombres.tipo FROM nombres,userlog 
WHERE ticket = :ticket 
and iniciales = gestor
and userlog.fechahora>curdate() order by fechahora desc limit 1";
$stc = $pdo->prepare($queryCheck);
$stc->bindParam(':ticket', $ticket);
$stc->execute();
$answercheck=$stc->fetch();
$capt=$answercheck[0];
$mytipo=$answercheck[1];
if (empty($capt)) {
        $redirector = "Location: index.php";
        header($redirector);
}
if ($capt=='') {
        $redirector = "Location: index.php";
        header($redirector);
}
$qcamp="update nombres set camp=2 where iniciales=:capt";
$stq = $pdo->prepare($qcamp);
$stq->bindParam(':capt', $capt);
$stq->execute();
$field='ID_CUENTA';
$find= filter_input(INPUT_GET, 'find');
$redirector = "Location: resumen.php?go=FROMBUSCAR&i=0&elastix=yes&field=id_cuenta&find=".$find."&capt=".$capt;
header($redirector);
