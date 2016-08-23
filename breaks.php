<?php
require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectNobody();
$capt = filter_input(INPUT_GET, 'capt');

/**
 * 
 * @param PDO $pdo
 * @param string $TIEMPO
 * @param string $GESTOR
 * @return array
 */
function getTimes($pdo, $TIEMPO, $GESTOR) {
    $queryq = "select time_to_sec(min(c_hrin))-time_to_sec(:tiempo) as 'diff',
min(c_hrin) as 'minhr'
from historia 
where c_cvge=:gestor and d_fech=curdate()
and c_hrin>:tiempo;";
    $sdq = $pdo->prepare($queryq);
    $sdq->bindParam(':tiempo', $TIEMPO);
    $sdq->bindParam(':gestor', $GESTOR);
    $sdq->execute();
    $resultq = $sdq->fetchAll();
    return $resultq;
}

$queryl = "delete from userlog where gestor = :capt";
$sdl = $pdo->prepare($queryl);
$sdl->bindParam(':capt', $capt);
$sdl->execute();
$ot = '';
$og = '';
$queryp = "select auto,c_cvge,c_cvst,c_hrin,
time_to_sec(now())-time_to_sec(concat_ws(' ',d_fech,c_hrin)) as 'diff'
from historia 
where c_cont=0 
and d_fech=curdate() 
and c_cvst<>'login' 
and c_cvst<>'salir' 
and c_cvge=:capt 
order by c_cvge,c_cvst,c_hrin";
$sdp = $pdo->prepare($queryp);
$sdp->bindParam(':capt', $capt);
$sdp->execute();
$resultp = $sdp->fetchAll();
require_once 'views/breaksView.php';