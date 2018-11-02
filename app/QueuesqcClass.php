<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App;

/**
 * Description of QueuesqcClass
 *
 * @author gmbs
 */
class QueuesqcClass extends BaseClass
{

    /**
     *
     * @var string
     */
    private $querysubhead = "select count(1) as ctt,
sum(fecha_ultima_gestion > curdate()) as ctd,
sum(fecha_ultima_gestion > :startWeek) as ctw,
sum(fecha_ultima_gestion > :startMonth) as ctm,
sum(saldo_total) as stt,
sum(saldo_total*(fecha_ultima_gestion > curdate())) as std,
sum(saldo_total*(fecha_ultima_gestion > :startOfWeek)) as stw,
sum(saldo_total*(fecha_ultima_gestion > :startOfMonth)) as stm
from resumen
join dictamenes on status_aarsa=dictamen
where cliente = :cliente
and queue = :queue ";

    /**
     *
     * @param string $CLIENTE
     * @param string $SDC
     * @return array
     */
    private function getSegmentoCount($CLIENTE, $SDC='')
    {
        $queryc = "SELECT count(1) as ct, sum(saldo_total) as sst
                            FROM resumen
                            WHERE cliente = :cliente";
        if ($SDC !== '') {
            $queryc = "SELECT count(1) as ct, sum(saldo_total) as sst
                                FROM resumen
                                WHERE status_de_credito = :sdc
                                AND cliente = :cliente";
        }
        $stc = $this->pdo->prepare($queryc);
        $stc->bindValue(':cliente', $CLIENTE);
        if (!empty($SDC)) {
            $stc->bindValue(':sdc', $SDC);
        }
        $stc->execute();
        $result = $stc->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @param string $CLIENTE
     * @param string $SDC
     * @param string $QUEUE
     * @return array
     */
    private function getQueueCounts($CLIENTE, $SDC, $QUEUE)
    {
        $querysub = $this->querysubhead;
        if ($SDC != '') {
            $querysub = $this->querysubhead . " and status_de_credito = :sdc";
        }
        $stc = $this->pdo->prepare($querysub);
        $stc->bindValue(':cliente', $CLIENTE);
        $stc->bindValue(':queue', $QUEUE);
        $stc->bindValue(':startWeek', date('Y-m-d', strtotime('last Saturday')));
        $stc->bindValue(':startMonth', date('Y-m-d', strtotime('first day of this month')));
        $stc->bindValue(':startOfWeek', date('Y-m-d', strtotime('last Saturday')));
        $stc->bindValue(':startOfMonth', date('Y-m-d', strtotime('first day of this month')));
        if ($SDC !== '') {
            $stc->bindValue(':sdc', $SDC);
        }
        $stc->execute();
        $result = $stc->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

   /**
     *
     * @return array
     */
    private function getQueues()
    {
        $query = "select distinct cliente, status_aarsa, sdc
from queuelist
where cliente <> ''
and sdc <> ''
order by cliente, sdc, status_aarsa limit 1000
";
        $stq = $this->pdo->query($query);
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @return array
     */
    private function getSpecial()
    {
        $query = "select cliente,
status_de_credito,count(1) as ct,sum(saldo_total) as mt,
sum(fecha_ultima_gestion<=last_day(curdate()-interval 1 month)+interval 1 day) as ect,
sum((fecha_ultima_gestion<last_day(curdate()-interval 1 month)+interval 1 day)*saldo_total) as emt
from resumen
where status_de_credito not regexp '-'
group by cliente,status_de_credito
";
        $stq = $this->pdo->query($query);
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
    
    /**
     * 
     * @param int|float $numerator
     * @param int|float $denominator
     * @return int
     */
    private function roundPc($numerator, $denominator) {
        if ($denominator == 0) {
            return -1;
        }
        $result = round($numerator / $denominator * 100, 0);
        return $result;
    }
    
    /**
     * 
     * @param int $percent
     * @param int $warning
     * @param int $error
     * @return string
     */
    private function alertClass($percent, $warning, $error) {
        $result = "class=good";
        if ($percent < $warning) {
            $result = "class=fair";
        }
        if ($percent < $error) {
            $result = "class=bad";
        }
        if ($percent < 0 ) {
            $result = "";
        }
        return $result;
    }

    /**
     * 
     * @return QueuesReportDataClass[]
     */
    public function normalQueues()
    {
        $output = [];
        $queues = $this->getQueues();
        foreach ($queues as $q) {
            $temp = new QueuesReportDataClass();
            $temp->CLIENTE = $q['cliente'];
            $temp->QUEUE = $q['status_aarsa'];
            $temp->SDC = $q['sdc'];
            $output[] = $temp;
        }
        foreach ($output as &$o) {
            $segmentCounts = $this->getSegmentoCount($o->CLIENTE, $o->SDC);
            $o->ASIGNADOS = $segmentCounts['ct'];
            $o->DINERO = $segmentCounts['sst'];
            $queueCounts = $this->getQueueCounts($o->CLIENTE, $o->SDC, $o->QUEUE);
            $o->count = $queueCounts['ctt'];
            $o->countd = $queueCounts['ctd'];
            $o->counts = $queueCounts['ctw'];
            $o->countm = $queueCounts['ctm'];
            $o->monto = $queueCounts['stt'];
            $o->montod = $queueCounts['std'];
            $o->montos = $queueCounts['stw'];
            $o->montom = $queueCounts['stm'];
            $o->pcc  = $this->roundPc($o->count, $o->ASIGNADOS);
            $pcd  = $this->roundPc($o->countd, $o->count);
            $o->empd = $this->alertClass($pcd, 80, 40);
            $o->pcd = max([$pcd, 0]);
            $pcs  = $this->roundPc($o->counts, $o->count);
            $o->emps = $this->alertClass($pcs, 80, 40);
            $o->pcs = max([$pcs, 0]);
            $pcm  = $this->roundPc($o->countm, $o->count);
            $o->empm = $this->alertClass($pcm, 80, 40);
            $o->pcm = max([$pcm, 0]);
            $o->pcmc = max([$this->roundPc($o->monto, $o->DINERO),0]);
            $o->pcmd = max([$this->roundPc($o->montod, $o->monto),0]);
            $o->pcms = max([$this->roundPc($o->montos, $o->monto),0]);
            $o->pcmm = max([$this->roundPc($o->montom, $o->monto),0]);            
        }
        return $output;
    }
    
    /**
     * 
     * @return QueuesReportDataClass[]
     */
    public function specialQueues() {
        $output = [];
        $queues = $this->getSpecial();
        foreach ($queues as $q) {
            $temp = new QueuesReportDataClass();
            $temp->CLIENTE = $q['cliente'];
            $temp->SDC =  $q['status_de_credito'];
            $temp->ASIGNADOS = $q['ct'];
            $temp->DINERO = $q['mt'];
            $temp->count = $q['ect'];
            $temp->monto = $q['emt'];
            $temp->pcc  = $this->roundPc($temp->count, $temp->ASIGNADOS);
            $temp->pcmc = $this->roundPc($temp->monto, $temp->DINERO);
            $output[] = $temp;
        }
        return $output;
    }
}
