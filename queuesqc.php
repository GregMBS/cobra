<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectAdmin();
$capt = filter_input(INPUT_GET, 'capt');

/**
 * 
 * @param PDO $pdo
 * @param string $CLIENTE
 * @param string $SDC
 * @return array
 */
function getSegmentoCount($pdo, $CLIENTE, $SDC) {
    $queryc = "SELECT count(1) as ct, sum(saldo_total) as sst
                            FROM resumen
                            WHERE status_de_credito not regexp '-'
                            AND cliente='" . $CLIENTE . "';";
    if ($SDC <> '') {
        $queryc = "SELECT count(1) as ct, sum(saldo_total) as sst
                                FROM resumen
                                WHERE status_de_credito = '" . $SDC . "'
                                and cliente='" . $CLIENTE . "';";
    }
    $resultc = $pdo->query($queryc);
    return $resultc;
}

function getQueueCounts($pdo, $CLIENTE, $SDC, $QUEUE) {
    $querysub = "select count(1),
sum(fecha_ultima_gestion>curdate()),
sum(fecha_ultima_gestion>curdate() - interval 6 day),
sum(fecha_ultima_gestion > last_day(curdate() - interval 1 month) + interval 1 day),
sum(saldo_total),
sum(saldo_total*(fecha_ultima_gestion>curdate())),
sum(saldo_total*(fecha_ultima_gestion>curdate() - interval 6 day)),
sum(saldo_total*(fecha_ultima_gestion > last_day(curdate() - interval 1 month) + interval 1 day))
from resumen
join dictamenes on status_aarsa=dictamen
where cliente='" . $CLIENTE . "'
and status_de_credito not regexp '[dv]o$'
and queue='" . $QUEUE . "'
";
    if ($SDC <> '') {
        $querysub = "select count(1) as ctt,
sum(fecha_ultima_gestion>curdate()) as ctd,
sum(fecha_ultima_gestion>curdate() - interval 6 day) as ctw,
sum(fecha_ultima_gestion > last_day(curdate() - interval 1 month) + interval 1 day) as ctm,
sum(saldo_total) as stt,
sum(saldo_total*(fecha_ultima_gestion>curdate())) as std,
sum(saldo_total*(fecha_ultima_gestion>curdate() - interval 6 day)) as stw,
sum(saldo_total*(fecha_ultima_gestion > last_day(curdate() - interval 1 month) + interval 1 day)) as stm
from resumen
join dictamenes on status_aarsa=dictamen
where cliente='" . $CLIENTE . "'
and status_de_credito='" . $SDC . "'
and queue='" . $QUEUE . "'
";
    }
    $stb = $pdo->query($querysub);
    $resultsub = $stb->fetchAll(PDO::FETCH_ASSOC);
    return $resultsub;
}

$querymainq = "select distinct cliente, status_aarsa, sdc
from queuelist
where status_aarsa not like 'PLASTIC%'
and cliente <> ''
and sdc <> ''
order by cliente, sdc, status_aarsa limit 1000
";
$stq = $pdo->query($querymainq);
$resultq = $stq->fetchAll(PDO::FETCH_ASSOC);
$querymain = "select cliente,
status_de_credito,count(1),sum(saldo_total),
sum(fecha_ultima_gestion<=last_day(curdate()-interval 1 month)+interval 1 day) as ecount,
sum((fecha_ultima_gestion<last_day(curdate()-interval 1 month)+interval 1 day)*saldo_total) as emount
from resumen
where status_de_credito not regexp '[dv]o$'
group by cliente,status_de_credito
";
$stm = $pdo->query($querymain);
$result = $stm->fetchAll(PDO::FETCH_NUM);
require_once 'views/queuesqcView.php';
