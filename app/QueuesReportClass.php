<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App;

/**
 * Description of QueuesReportClass
 *
 * @author gmbs
 */
class QueuesReportClass extends BaseClass
{

    /**
     *
     * @var string
     */
    private $queryHead = "select count(1) as ctt,
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
     * @param string $client
     * @param string $sdc
     * @return array
     */
    private function getSegmentCount($client, $sdc='')
    {
        $query = "SELECT count(1) as ct, sum(saldo_total) as sst
                            FROM resumen
                            WHERE cliente = :cliente";
        if ($sdc !== '') {
            $query = "SELECT count(1) as ct, sum(saldo_total) as sst
                                FROM resumen
                                WHERE status_de_credito = :sdc
                                AND cliente = :cliente";
        }
        $stc = $this->pdo->prepare($query);
        $stc->bindValue(':cliente', $client);
        if (!empty($sdc)) {
            $stc->bindValue(':sdc', $sdc);
        }
        $stc->execute();
        $result = $stc->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @param string $client
     * @param string $sdc
     * @param string $queue
     * @return array
     */
    private function getQueueCounts($client, $sdc, $queue)
    {
        $query = $this->queryHead;
        if ($sdc != '') {
            $query = $this->queryHead . " and status_de_credito = :sdc";
        }
        $stc = $this->pdo->prepare($query);
        $stc->bindValue(':cliente', $client);
        $stc->bindValue(':queue', $queue);
        $stc->bindValue(':startWeek', date('Y-m-d', strtotime('last Saturday')));
        $stc->bindValue(':startMonth', date('Y-m-d', strtotime('first day of this month')));
        $stc->bindValue(':startOfWeek', date('Y-m-d', strtotime('last Saturday')));
        $stc->bindValue(':startOfMonth', date('Y-m-d', strtotime('first day of this month')));
        if ($sdc !== '') {
            $stc->bindValue(':sdc', $sdc);
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
        /** @var QueuesReportDataClass[] $output */
        $output = [];
        $queues = $this->getQueues();
        foreach ($queues as $q) {
            $temp = new QueuesReportDataClass();
            $temp->client = $q['cliente'];
            $temp->queue = $q['status_aarsa'];
            $temp->sdc = $q['sdc'];
            $output[] = $temp;
        }
        foreach ($output as &$o) {
            $segmentCounts = $this->getSegmentCount($o->client, $o->sdc);
            $o->assigned = $segmentCounts['ct'];
            $o->money = $segmentCounts['sst'];
            $queueCounts = $this->getQueueCounts($o->client, $o->sdc, $o->queue);
            $o->count = $queueCounts['ctt'];
            $o->countDay = $queueCounts['ctd'];
            $o->countWeek = $queueCounts['ctw'];
            $o->countMonth = $queueCounts['ctm'];
            $o->amount = $queueCounts['stt'];
            $o->amountDay = $queueCounts['std'];
            $o->amountWeek = $queueCounts['stw'];
            $o->amountMonth = $queueCounts['stm'];
            $o->percent  = $this->roundPc($o->count, $o->assigned);
            $pcd  = $this->roundPc($o->countDay, $o->count);
            $o->alertDay = $this->alertClass($pcd, 80, 40);
            $o->percentDay = max([$pcd, 0]);
            $pcs  = $this->roundPc($o->countWeek, $o->count);
            $o->alertWeek = $this->alertClass($pcs, 80, 40);
            $o->percentWeek = max([$pcs, 0]);
            $pcm  = $this->roundPc($o->countMonth, $o->count);
            $o->alertMonth = $this->alertClass($pcm, 80, 40);
            $o->percentMonth = max([$pcm, 0]);
            $o->percentMoney = max([$this->roundPc($o->amount, $o->money),0]);
            $o->percentDay = max([$this->roundPc($o->amountDay, $o->amount),0]);
            $o->percentWeek = max([$this->roundPc($o->amountWeek, $o->amount),0]);
            $o->percentMonth = max([$this->roundPc($o->amountMonth, $o->amount),0]);
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
            $temp->client = $q['cliente'];
            $temp->sdc =  $q['status_de_credito'];
            $temp->assigned = $q['ct'];
            $temp->money = $q['mt'];
            $temp->count = $q['ect'];
            $temp->amount = $q['emt'];
            $temp->percent  = $this->roundPc($temp->count, $temp->assigned);
            $temp->percentMoney = $this->roundPc($temp->amount, $temp->money);
            $output[] = $temp;
        }
        return $output;
    }
}
