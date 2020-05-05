<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use PDO;
use PDOStatement;

/**
 * Description of QueuesgClass
 *
 * @author gmbs
 */
class QueuesgClass {

    /**
     *
     * @var PDO 
     */
    private $pdo;

    /**
     * 
     * @param PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $cliente
     * @param string $queue
     * @param string $sdc
     * @param string $capt
     * @return int
     */
    public function getCamp($cliente, $queue, $sdc, $capt) {
        $query  = "select camp from queuelist
    where cliente=:cliente
    and status_aarsa=:queue
    and sdc=:sdc
    and gestor=:capt
    and bloqueado=0 limit 1
    ";
        $stq         = $this->pdo->prepare($query);
        $stq->bindParam(':cliente', $cliente);
        $stq->bindParam(':queue', $queue);
        $stq->bindParam(':sdc', $sdc);
        $stq->bindParam(':capt', $capt);
        $stq->execute();
        $result = $stq->fetch(PDO::FETCH_ASSOC);
        return $result['camp'];
    }
    
    /**
     * 
     * @param int $camp
     * @param string $capt
     */
    public function setCamp($camp, $capt) {
        $queryupd = "UPDATE nombres SET camp=:camp "
            . "where iniciales=:capt;";
        $stu = $this->pdo->prepare($queryupd);
        $stu->bindParam(':camp', $camp);
        $stu->bindParam(':capt', $capt);
        $stu->execute();
    }

    /**
     *
     * @return false|PDOStatement
     */
    public function getClients() {
        $query  = "SELECT distinct cliente
        FROM queuelist where cliente<>''
        ORDER BY cliente";
        return $this->pdo->query($query);
    }
    
    /**
     * 
     * @param string $capt
     * @return array
     */
    public function getSdcClients($capt) {
        $query  = "SELECT distinct sdc,cliente
        FROM queuelist WHERE gestor = :capt and bloqueado=0 and cliente<>''
        ORDER BY cliente,sdc,status_aarsa";
        $sts = $this->pdo->prepare($query);
        $sts->bindParam(':capt', $capt);
        $sts->execute();
        return $sts->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * 
     * @param string $capt
     * @return array
     */
    public function getQueueSdcClients($capt) {
        $query  = "SELECT distinct status_aarsa,sdc,cliente
        FROM queuelist WHERE gestor = :capt and bloqueado = 0
        ORDER BY cliente,sdc,status_aarsa";
        $sts = $this->pdo->prepare($query);
        $sts->bindParam(':capt', $capt);
        $sts->execute();
        return $sts->fetchAll(PDO::FETCH_ASSOC);
    }
}