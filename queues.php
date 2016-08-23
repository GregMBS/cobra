<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectUser();
$capt = filter_input(INPUT_GET, 'capt');
$go = filter_input(INPUT_GET, 'go');
$searchstr = '';
$CAMP = filter_input(INPUT_GET, 'camp', FILTER_VALIDATE_INT);
$GESTOR = filter_input(INPUT_GET, 'gestor');
if ($go == 'INTRO') {
    $queryupd = "UPDATE nombres SET camp=:camp "
            . "where iniciales=:gestor;";
    $stu = $pdo->prepare($queryupd);
    $stu->bindParam(':camp', $CAMP, PDO::PARAM_INT);
    $stu->bindParam(':gestor', $GESTOR);
    $stu->execute();
}
if ($go == 'BLOQUEAR') {
    $queryblock = "UPDATE queuelist SET bloqueado=1
WHERE gestor=:gestor
AND camp=:camp;";
    $stb = $pdo->prepare($queryblock);
    $stb->bindParam(':camp', $CAMP, PDO::PARAM_INT);
    $stb->bindParam(':gestor', $GESTOR);
    $stb->execute();
}
if ($go == 'DESBLOQUEAR') {
    $querydes = "UPDATE queuelist SET bloqueado=0
WHERE gestor=:gestor
AND camp=:camp;";
    $std = $pdo->prepare($querydes);
    $std->bindParam(':camp', $CAMP, PDO::PARAM_INT);
    $std->bindParam(':gestor', $GESTOR);
    $std->execute();
}
if ($go == 'INTRO TODOS') {
    $QUEUE = filter_input(INPUT_GET, 'queue');
    $QUEUES = explode(',', $QUEUE);
    if ($QUEUES[1] == "") {
        $queryqueue = "UPDATE nombres,queuelist SET nombres.camp=queuelist.camp
where iniciales=gestor and cliente=:cliente
and status_aarsa=:status;";
        $stq = $pdo->prepare($queryqueue);
    } else {
        $queryqueue = "UPDATE nombres,queuelist SET nombres.camp=queuelist.camp
where iniciales=gestor and cliente=:cliente
and sdc=:sdc and status_aarsa=:status;";
        $stq = $pdo->prepare($queryqueue);
        $stq->bindParam(':sdc', $QUEUES[1]);
    }
    $stq->bindParam(':cliente', $QUEUES[0]);
    $stq->bindParam(':status', $QUEUES[2]);
    $stq->execute();
}
if ($go == 'BLOQUEAR TODOS') {
    $QUEUE = filter_input(INPUT_GET, 'queue');
    $QUEUES = explode(',', $QUEUE);
    $querybt = "UPDATE queuelist SET bloqueado=1
where cliente=:cliente
and sdc=:sdc and status_aarsa=:status;";
    $stbt = $pdo->prepare($querybt);
    $stbt->bindParam(':cliente', $QUEUES[0]);
    $stbt->bindParam(':sdc', $QUEUES[1]);
    $stbt->bindParam(':status', $QUEUES[2]);
    $stbt->execute();
}
if ($go == 'DESBLOQUEAR TODOS') {
    $QUEUE = filter_input(INPUT_GET, 'queue');
    $querydt = "UPDATE queuelist SET bloqueado=0
where cliente=:cliente
and sdc=:sdc and status_aarsa=:status;";
    $stdt = $pdo->prepare($querydt);
    $stdt->bindParam(':cliente', $QUEUES[0]);
    $stdt->bindParam(':sdc', $QUEUES[1]);
    $stdt->bindParam(':status', $QUEUES[2]);
    $stdt->execute();
}
$oldgestor = '';
$querylist = "SELECT distinct gestor,tipo,nombres.camp as campnow
    FROM queuelist
JOIN nombres ON gestor=iniciales 
WHERE tipo <> ''
ORDER BY gestor";
$resultlist = $pdo->query($querylist);
$queryq = "SELECT distinct cliente,sdc,status_aarsa,bloqueado
FROM queuelist
WHERE cliente<> ''
ORDER BY cliente,sdc,status_aarsa;";
$resultq = $pdo->query($queryq);
require_once 'views/queuesView.php';
