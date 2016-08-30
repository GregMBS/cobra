<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

/**
 * Description of QueuesgClass
 *
 * @author gmbs
 */
class QueuesgClass {

    /**
     *
     * @var \PDO 
     */
    private $pdo;

    /**
     * 
     * @param \PDO $pdo
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
        return $camp;
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
}
