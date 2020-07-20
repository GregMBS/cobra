<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use PDO;

/**
 * Description of QueuesClass
 *
 * @author gmbs
 */
class QueuesClass extends BaseClass {

    /**
     * 
     * @param int $CAMP
     * @param string $GESTOR
     */
    public function updateQueue($CAMP, $GESTOR) {
        $queryupd = "UPDATE nombres SET camp=:camp "
                . "where iniciales=:gestor";
        $stu = $this->pdo->prepare($queryupd);
        $stu->bindParam(':camp', $CAMP, PDO::PARAM_INT);
        $stu->bindParam(':gestor', $GESTOR);
        $stu->execute();
    }

    /**
     * 
     * @param int $CAMP
     * @param string $GESTOR
     */
    public function blockQueue($CAMP, $GESTOR) {
        $queryupd = "UPDATE queuelist SET bloqueado = 1 "
                . "WHERE gestor = :gestor "
                . "AND camp = :camp";
        $stu = $this->pdo->prepare($queryupd);
        $stu->bindParam(':camp', $CAMP, PDO::PARAM_INT);
        $stu->bindParam(':gestor', $GESTOR);
        $stu->execute();
    }

    /**
     * 
     * @param int $CAMP
     * @param string $GESTOR
     */
    public function unblockQueue($CAMP, $GESTOR) {
        $queryupd = "UPDATE queuelist SET bloqueado = 0 "
                . "WHERE gestor = :gestor "
                . "AND camp = :camp";
        $stu = $this->pdo->prepare($queryupd);
        $stu->bindParam(':camp', $CAMP, PDO::PARAM_INT);
        $stu->bindParam(':gestor', $GESTOR);
        $stu->execute();
    }

    /**
     * 
     * @param string $cliente
     * @param string $sdc
     * @param string $status
     */
    public function updateQueueAll($cliente, $sdc, $status) {
        if (empty($sdc)) {
            $queryqueue = "UPDATE nombres,queuelist SET nombres.camp=queuelist.camp
where iniciales=gestor and cliente=:cliente
and status_aarsa=:status";
            $stq = $this->pdo->prepare($queryqueue);
        } else {
            $queryqueue = "UPDATE nombres,queuelist SET nombres.camp=queuelist.camp
where iniciales=gestor and cliente=:cliente
and sdc=:sdc and status_aarsa=:status";
            $stq = $this->pdo->prepare($queryqueue);
            $stq->bindParam(':sdc', $sdc);
        }
        $stq->bindParam(':cliente', $cliente);
        $stq->bindParam(':status', $status);
        $stq->execute();
    }

    /**
     * 
     * @param string $cliente
     * @param string $sdc
     * @param string $status
     */
    public function blockQueueAll($cliente, $sdc, $status) {
        $queryupd = "UPDATE queuelist SET bloqueado = 1 "
                . "where cliente=:cliente "
                . "and sdc=:sdc "
                . "and status_aarsa=:status";
        $stu = $this->pdo->prepare($queryupd);
        $stu->bindParam(':cliente', $cliente);
        $stu->bindParam(':sdc', $sdc);
        $stu->bindParam(':status', $status);
        $stu->execute();
    }

    /**
     * 
     * @param string $cliente
     * @param string $sdc
     * @param string $status
     */
    public function unblockQueueAll($cliente, $sdc, $status) {
        $queryupd = "UPDATE queuelist SET bloqueado = 0 "
                . "where cliente=:cliente "
                . "and sdc=:sdc "
                . "and status_aarsa=:status";
        $stu = $this->pdo->prepare($queryupd);
        $stu->bindParam(':cliente', $cliente);
        $stu->bindParam(':sdc', $sdc);
        $stu->bindParam(':status', $status);
        $stu->execute();
    }

    /**
     * 
     * @return array
     */
    public function getGestores() {
        $querylist = "SELECT distinct gestor,tipo,nombres.camp as campnow
            FROM queuelist
        JOIN nombres ON gestor=iniciales 
        WHERE tipo <> ''
        ORDER BY gestor";
        $stl = $this->pdo->prepare($querylist);
        $stl->execute();
        return $stl->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return array
     */
    public function getQueues() {
        $query = "SELECT distinct cliente,sdc,status_aarsa,bloqueado
        FROM queuelist
        WHERE cliente<> ''
        ORDER BY cliente,sdc,status_aarsa";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @param string $GESTOR
     * @return array
     */
    public function getMyQueue($GESTOR) {
        $queryqc = "SELECT cliente, sdc, status_aarsa, 
                                nombres.camp as campnow
                                FROM queuelist, nombres 
                                WHERE gestor = :gestor and gestor=iniciales 
                                and nombres.camp=queuelist.camp
                                and cliente<>''
                                ORDER BY cliente,sdc,status_aarsa
                                LIMIT 1";
        $stqc = $this->pdo->prepare($queryqc);
        $stqc->bindParam(':gestor', $GESTOR);
        $stqc->execute();
        return $stqc->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @param string $GESTOR
     * @return array
     */
    public function getMyQueuelist($GESTOR) {
        $queryqa = "SELECT cliente, sdc, status_aarsa,
                                    camp, bloqueado
                                    FROM queuelist
                                    WHERE gestor = :gestor
                                    and cliente<>''
                                    ORDER BY cliente,sdc,camp;";
        $stqa = $this->pdo->prepare($queryqa);
        $stqa->bindParam(':gestor', $GESTOR);
        $stqa->execute();
        return $stqa->fetchAll(PDO::FETCH_ASSOC);
    }

}
