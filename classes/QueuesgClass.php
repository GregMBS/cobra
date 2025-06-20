<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/QueuelistObject.php';

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
        return (int) $result['camp'];
    }
    
    /**
     * 
     * @param int $camp
     * @param string $capt
     */
    public function setCamp($camp, $capt) {
        $query = "UPDATE nombres SET camp=:camp 
        where iniciales=:capt;";
        $stu = $this->pdo->prepare($query);
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
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * 
     * @param string $capt
     * @return array
     */
    public function getSdcClients($capt) {
        $query  = "SELECT distinct sdc,cliente
        FROM queuelist WHERE gestor = :capt and bloqueado=0 and cliente<>''
        ORDER BY cliente,sdc";
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

    /**
     * @param string $capt
     * @return QueuelistObject
     */
    public function getMyQueue(string $capt)
    {
        $query = "SELECT queuelist.* FROM queuelist, nombres 
        WHERE iniciales = :capt 
        AND nombres.camp = queuelist.camp";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':capt', $capt);
        $stq->execute();
        $result = $stq->fetchObject(QueuelistObject::class);
        if ($result) {
            return $result;
        }
        return new QueuelistObject();
    }
}
