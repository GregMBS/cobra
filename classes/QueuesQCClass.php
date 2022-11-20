<?php

namespace cobra_salsa;

use PDO;

require_once 'classes/QueuesReportObject.php';
require_once 'classes/QueuelistObject.php';
require_once 'classes/EspecialObject.php';

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
    private PDO $pdo;

    /**
     *
     * @var string
     */
    private string $reportSubHead = "select count(1) as ctt,
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
    public function getSegmentoCount(string $CLIENTE, string $SDC): array
    {
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
    public function getReportSub(string $CLIENTE, string $SDC, string $QUEUE): QueuesReportObject
    {
        $query = $this->reportSubHead . " and status_de_credito not regexp '-'";
        if ($SDC !== '') {
            $query = $this->reportSubHead . " and status_de_credito = :sdc";
        }
        return $this->subQuery($query, $CLIENTE, $QUEUE, $SDC);
    }

    /**
     * 
     * @return QueuelistObject[]
     */
    public function getQueues(): array
    {
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
        $stq = $this->pdo->query($query);
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
    public function getMain(): array
    {
        $query = "select cliente,
status_de_credito,count(1) as cnt, sum(saldo_total) as mnt,
sum(fecha_ultima_gestion<=last_day(curdate()-interval 1 month)+interval 1 day) as ecount,
sum((fecha_ultima_gestion<last_day(curdate()-interval 1 month)+interval 1 day)*saldo_total) as emount
from resumen
where status_de_credito not regexp '-'
group by cliente,status_de_credito
";
        $stq = $this->pdo->query($query);
        $result = $stq->fetchAll(PDO::FETCH_CLASS, EspecialObject::class);
        if ($result) {
            return $result;
        }
        return [];
    }

    /**
     * @param string $query
     * @param string $CLIENTE
     * @param string $QUEUE
     * @param string $SDC
     * @return QueuesReportObject
     */
    private function subQuery(string $query, string $CLIENTE, string $QUEUE, string $SDC): QueuesReportObject
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
