<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/QueuelistObject.php';
require_once __DIR__ . '/QueueObject.php';
require_once __DIR__ . '/UserDataObject.php';

/**
 * Description of QueuesClass
 *
 * @author gmbs
 */
class QueuesClass extends BaseClass
{

    /**
     *
     * @param int $CAMP
     * @param string $GESTOR
     */
    public function updateQueue($CAMP, $GESTOR)
    {
        $query = "UPDATE nombres SET camp=:camp 
        where iniciales=:gestor";
        $stu = $this->pdo->prepare($query);
        $stu->bindParam(':camp', $CAMP, PDO::PARAM_INT);
        $stu->bindParam(':gestor', $GESTOR);
        $stu->execute();
    }

    /**
     *
     * @param int $CAMP
     * @param string $GESTOR
     */
    public function blockQueue($CAMP, $GESTOR)
    {
        $query = "UPDATE queuelist SET bloqueado = 1 
        WHERE gestor = :gestor 
        AND camp = :camp";
        $stu = $this->pdo->prepare($query);
        $stu->bindParam(':camp', $CAMP, PDO::PARAM_INT);
        $stu->bindParam(':gestor', $GESTOR);
        $stu->execute();
    }

    /**
     *
     * @param int $CAMP
     * @param string $GESTOR
     */
    public function unblockQueue($CAMP, $GESTOR)
    {
        $query = "UPDATE queuelist SET bloqueado = 0 
        WHERE gestor = :gestor 
        AND camp = :camp";
        $stu = $this->pdo->prepare($query);
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
    public function updateQueueAll($cliente, $sdc, $status)
    {
        $query = "UPDATE nombres,queuelist SET nombres.camp=queuelist.camp
where iniciales=gestor and cliente=:cliente
and status_aarsa=:status";
        $stq = $this->pdo->prepare($query);
        if (!empty($sdc)) {
            $query = "UPDATE nombres,queuelist SET nombres.camp=queuelist.camp
where iniciales=gestor and cliente=:cliente
and sdc=:sdc and status_aarsa=:status";
            $stq = $this->pdo->prepare($query);
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
    public function blockQueueAll($cliente, $sdc, $status)
    {
        $query = "UPDATE queuelist SET bloqueado = 1 
        where cliente=:cliente 
        and sdc=:sdc 
        and status_aarsa=:status";
        $stu = $this->pdo->prepare($query);
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
    public function unblockQueueAll($cliente, $sdc, $status)
    {
        $query = "UPDATE queuelist SET bloqueado = 0 
        where cliente=:cliente 
        and sdc=:sdc 
        and status_aarsa=:status";
        $stu = $this->pdo->prepare($query);
        $stu->bindParam(':cliente', $cliente);
        $stu->bindParam(':sdc', $sdc);
        $stu->bindParam(':status', $status);
        $stu->execute();
    }

    /**
     *
     * @return UserDataObject[]
     */
    public function getGestores()
    {
        $query = "SELECT distinct nombres.*
            FROM nombres
        JOIN queuelist ON gestor=iniciales
        WHERE tipo <> ''
        ORDER BY iniciales";
        $stl = $this->pdo->prepare($query);
        $stl->execute();
        return $stl->fetchAll(PDO::FETCH_CLASS, UserDataObject::class);
    }

    /**
     *
     * @return QueueObject[]
     */
    public function getAllQueues()
    {
        $query = "SELECT distinct cliente,sdc,status_aarsa,bloqueado
        FROM queuelist
        WHERE cliente <> ''
        ORDER BY cliente,sdc,status_aarsa";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS, QueueObject::class);
    }

    /**
     *
     * @param string $GESTOR
     * @return QueuelistObject
     */
    public function getMyQueue($GESTOR)
    {
        $query = "SELECT queuelist.*
                                FROM queuelist, nombres 
                                WHERE gestor = :gestor and gestor=iniciales 
                                and nombres.camp=queuelist.camp
                                and cliente<>''
                                ORDER BY cliente,sdc,status_aarsa
                                LIMIT 1";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $GESTOR);
        $stq->execute();
        return $stq->fetchObject(QueuelistObject::class);
    }

    /**
     *
     * @param string $GESTOR
     * @return QueuelistObject[]
     */
    public function getMyQueuelist($GESTOR): array
    {
        $query = "SELECT * FROM queuelist
                                    WHERE gestor = :gestor
                                    and cliente<>''
                                    ORDER BY cliente,sdc,camp";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':gestor', $GESTOR);
        $stq->execute();
        return $stq->fetchAll(PDO::FETCH_CLASS, QueuelistObject::class);
    }

}
