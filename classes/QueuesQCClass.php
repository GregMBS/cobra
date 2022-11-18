<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/QueuesReportObject.php';
require_once __DIR__ . '/QueuelistObject.php';
require_once __DIR__ . '/EspecialObject.php';

/**
 * Description of QueuesQCClass
 *
 * @author gmbs
 */
class QueuesQCClass {

    /**
     *
     * @var PDO
     */
    private $pdo;

    /**
     *
     * @var string
     */
    private $reportSubHead = "select count(1) as ctt,
sum(fecha_ultima_gestion>curdate()) as ctd,
sum(fecha_ultima_gestion>curdate() - interval 6 day) as ctw,
sum(fecha_ultima_gestion > last_day(curdate() - interval 1 month) + interval 1 day) as ctm,
sum(saldo_total) as mtt,
sum(saldo_total*(fecha_ultima_gestion>curdate())) as mtd,
sum(saldo_total*(fecha_ultima_gestion>curdate() - interval 6 day)) as mtw,
sum(saldo_total*(fecha_ultima_gestion > last_day(curdate() - interval 1 month) + interval 1 day)) as mtm
from resumen
join dictamenes on status_aarsa=dictamen
where cliente = :cliente
and queue = :queue ";

    /**
     * 
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $CLIENTE
     * @param string $SDC
     * @return array
     */
    function getSegmentoCount($CLIENTE, $SDC) {
        $query = "SELECT count(1) as ct, sum(saldo_total) as sst
                            FROM resumen
                            WHERE status_de_credito not regexp '-'
                            AND cliente = :cliente";
        if (!empty($SDC)) {
            $query = "SELECT count(1) as ct, sum(saldo_total) as sst
                                FROM resumen
                                WHERE status_de_credito = :sdc
                                and cliente = :cliente";
        }
        $stc = $this->pdo->prepare($query);
        $stc->bindParam(':cliente', $CLIENTE);
        if (!empty($SDC)) {
            $stc->bindParam(':sdc', $SDC);
        }
        $stc->execute();
        return $stc->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @param string $CLIENTE
     * @param string $SDC
     * @param string $QUEUE
     * @return QueuesReportObject
     */
    function getReportSub($CLIENTE, $SDC, $QUEUE) {
        $query = $this->reportSubHead . " and status_de_credito not regexp '-'";
        if ($SDC <> '') {
            $query = $this->reportSubHead . " and status_de_credito = :sdc";
        }
        return $this->subQuery($query, $CLIENTE, $QUEUE, $SDC);
    }

    /**
     * 
     * @return QueuelistObject[]
     */
    function getQueues() {
        $query = "select distinct queuelist.*
from queuelist
where cliente <> ''
and sdc <> ''
and gestor = 'gmbs'
and (cliente, sdc, status_aarsa) IN (
select cliente, status_de_credito, queue
from resumen, dictamenes
where status_aarsa = dictamen
)
order by cliente, sdc, status_aarsa limit 1000
";
        $stq = $this->pdo->prepare($query);
        $stq->execute();
        $result = $stq->fetchAll(PDO::FETCH_CLASS, QueuelistObject::class);
        if ($result) {
            return $result;
        }
        return [
            new QueuelistObject()
            ];
    }

    /**
     *
     * @return array
     */
    function getMain() {
        $query = "select cliente,
status_de_credito,count(1) as cnt, sum(saldo_total) as mnt,
sum(fecha_ultima_gestion<=last_day(curdate()-interval 1 month)+interval 1 day) as ecount,
sum((fecha_ultima_gestion<last_day(curdate()-interval 1 month)+interval 1 day)*saldo_total) as emount
from resumen
where status_de_credito not regexp '-'
group by cliente,status_de_credito
";
        $stq = $this->pdo->prepare($query);
        $stq->execute();
        $result = $stq->fetchAll(PDO::FETCH_CLASS, EspecialObject::class);
        if ($result) {
            return $result;
        }
        return [];
    }

    /**
     * @param $query
     * @param $CLIENTE
     * @param $QUEUE
     * @param $SDC
     * @return QueuesReportObject
     */
    private function subQuery($query, $CLIENTE, $QUEUE, $SDC)
    {
        $stc = $this->pdo->prepare($query);
        $stc->bindParam(':cliente', $CLIENTE);
        $stc->bindParam(':queue', $QUEUE);
        if (!empty($SDC)) {
            $stc->bindParam(':sdc', $SDC);
        }
        $stc->execute();
        return $stc->fetchObject( QueuesReportObject::class);
    }

}
