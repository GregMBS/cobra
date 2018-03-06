<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of QueuesgClass
 *
 * @author gmbs
 */
class QueuesgClass extends BaseClass {

    /**
     * 
     * @param string $cliente
     * @param string $queue
     * @param string $sdc
     * @param string $capt
     * @return int
     */
    public function getCamp($cliente, $queue, $sdc, $capt) {
        $queryqueue  = "select camp from queuelist
    where cliente=:cliente
    and status_aarsa=:queue
    and sdc=:sdc
    and gestor=:capt
    and bloqueado=0 limit 1
    ";
        $stq         = $this->pdo->prepare($queryqueue);
        $stq->bindParam(':cliente', $cliente);
        $stq->bindParam(':queue', $queue);
        $stq->bindParam(':sdc', $sdc);
        $stq->bindParam(':capt', $capt);
        $stq->execute();
        $resultqueue = $stq->fetch(\PDO::FETCH_ASSOC);
        $camp = $resultqueue['camp'];
        if ($camp) {
            return $camp;
        } else {
            return -1;
        }
        
    }
    
    /**
     * 
     * @param int $camp
     * @param string $capt
     */
    public function setCamp($camp, $capt) {
        $queryupd = "UPDATE nombres SET camp=:camp "
            . "where iniciales=:capt";
        $stu = $this->pdo->prepare($queryupd);
        $stu->bindParam(':camp', $camp);
        $stu->bindParam(':capt', $capt);
        $stu->execute();
    }
    
    /**
     * 
     * @return array
     */
    public function getClients() {
        $query  = "SELECT distinct cliente
        FROM queuelist where cliente<>''
        ORDER BY cliente";
        $stq = $this->pdo->query($query);
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
    
    /**
     * 
     * @param string $capt
     * @return array
     */
    public function getSdcClients($capt) {
        $querys  = "SELECT distinct sdc,cliente
        FROM queuelist WHERE gestor = :capt and bloqueado=0 and cliente<>''
        ORDER BY cliente,sdc";
        $sts = $this->pdo->prepare($querys);
        $sts->bindParam(':capt', $capt);
        $sts->execute();
        $results=$sts->fetchAll(\PDO::FETCH_ASSOC);
        return $results;
    }
    
    /**
     * 
     * @param string $capt
     * @return array
     */
    public function getQueueSdcClients($capt) {
        $querysa  = "SELECT distinct status_aarsa,sdc,cliente
        FROM queuelist WHERE gestor = :capt and bloqueado = 0
        ORDER BY cliente,sdc,status_aarsa";
        $stsa = $this->pdo->prepare($querysa);
        $stsa->bindParam(':capt', $capt);
        $stsa->execute();
        $resultsa=$stsa->fetchAll(\PDO::FETCH_ASSOC);
        return $resultsa;
    }
}
