<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

/**
 * Description of QueuesqcClass
 *
 * @author gmbs
 */
class QueuesqcClass {

    /**
     *
     * @var \PDO
     */
    private $pdo;

    /**
     *
     * @var string
     */
    private $querysubhead = "select count(1),
sum(fecha_ultima_gestion>curdate()),
sum(fecha_ultima_gestion>curdate() - interval 6 day),
sum(fecha_ultima_gestion > last_day(curdate() - interval 1 month) + interval 1 day),
sum(saldo_total),
sum(saldo_total*(fecha_ultima_gestion>curdate())),
sum(saldo_total*(fecha_ultima_gestion>curdate() - interval 6 day)),
sum(saldo_total*(fecha_ultima_gestion > last_day(curdate() - interval 1 month) + interval 1 day))
from resumen
join dictamenes on status_aarsa=dictamen
where cliente = :cliente
and queue = :queue ";

    /**
     *
     * @var string
     */
    private $reportsubhead = "select count(1),
sum(fecha_ultima_gestion>curdate()),
sum(fecha_ultima_gestion>curdate() - interval 6 day),
sum(fecha_ultima_gestion > last_day(curdate() - interval 1 month) + interval 1 day),
sum(saldo_total),
sum(saldo_total*(fecha_ultima_gestion>curdate())),
sum(saldo_total*(fecha_ultima_gestion>curdate() - interval 6 day)),
sum(saldo_total*(fecha_ultima_gestion > last_day(curdate() - interval 1 month) + interval 1 day))
from resumen
join dictamenes on status_aarsa=dictamen
where cliente = :cliente
and queue = :queue";

    /**
     * 
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $CLIENTE
     * @param string $SDC
     * @return array
     */
    function getSegmentoCount($CLIENTE, $SDC) {
        $queryc = "SELECT count(1) as ct, sum(saldo_total) as sst
                            FROM resumen
                            WHERE status_de_credito not regexp '-'
                            AND cliente = :cliente";
        if (!empty($SDC)) {
            $queryc = "SELECT count(1) as ct, sum(saldo_total) as sst
                                FROM resumen
                                WHERE status_de_credito = :sdc
                                and cliente = :cliente";
        }
        $stc = $this->pdo->prepare($queryc);
        $stc->bindParam(':cliente', $CLIENTE);
        if (!empty($SDC)) {
            $stc->bindParam(':sdc', $SDC);
        }
        $stc->execute();
        $result = $stc->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param string $CLIENTE
     * @param string $SDC
     * @param string $QUEUE
     * @return array
     */
    function getQueueCounts($CLIENTE, $SDC, $QUEUE) {
        $querysub = $this->querysubhead . " and status_de_credito not regexp '-'";
        if ($SDC <> '') {
            $querysub = $this->querysubhead . " and status_de_credito = :sdc";
        }
        $stc = $this->pdo->prepare($querysub);
        $stc->bindParam(':cliente', $CLIENTE);
        $stc->bindParam(':queue', $QUEUE);
        if (!empty($SDC)) {
            $stc->bindParam(':sdc', $SDC);
        }
        $stc->execute();
        $result = $stc->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param string $CLIENTE
     * @param string $SDC
     * @param string $QUEUE
     * @return array
     */
    function getReportSub($CLIENTE, $SDC, $QUEUE) {
        $querysub = $this->reportsubhead . " and status_de_credito not regexp '-'";
        if ($SDC <> '') {
            $querysub = $this->reportsubhead . " and status_de_credito = :sdc";
        }
        $stc = $this->pdo->prepare($querysub);
        $stc->bindParam(':cliente', $CLIENTE);
        $stc->bindParam(':queue', $QUEUE);
        if (!empty($SDC)) {
            $stc->bindParam(':sdc', $SDC);
        }
        $stc->execute();
        $result = $stc->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @return array
     */
    function getQueues() {
        $querymainq = "select distinct cliente, status_aarsa, sdc
from queuelist
where status_aarsa not like 'PLASTIC%'
and cliente <> ''
and sdc <> ''
order by cliente, sdc, status_aarsa limit 1000
";
        $result = $this->pdo->query($querymainq);
        return $result;
    }

    /**
     * 
     * @return array
     */
    function getMain() {
        $querymain = "select cliente,
status_de_credito,count(1),sum(saldo_total),
sum(fecha_ultima_gestion<=last_day(curdate()-interval 1 month)+interval 1 day) as ecount,
sum((fecha_ultima_gestion<last_day(curdate()-interval 1 month)+interval 1 day)*saldo_total) as emount
from resumen
where status_de_credito not regexp '[dv]o$'
group by cliente,status_de_credito
";
        $result = $this->pdo->query($querymain);
        return $result;
    }

}
