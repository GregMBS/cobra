<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use PDO;

/**
 * Description of QueuesClass
 *
 * @author gmbs
 */
class QueuesClass extends BaseClass
{

    /**
     *
     * @param int $campaign
     * @param string $agent
     */
    public function updateQueue($campaign, $agent)
    {
        $query = "UPDATE users SET camp=:camp "
            . "where iniciales=:agent";
        $stu = $this->pdo->prepare($query);
        $stu->bindValue(':camp', $campaign, \PDO::PARAM_INT);
        $stu->bindValue(':agent', $agent);
        $stu->execute();
    }

    /**
     *
     * @param int $campaign
     * @param string $agent
     */
    public function blockQueue($campaign, $agent)
    {
        $query = "UPDATE queuelist SET bloqueado = 1 "
            . "WHERE gestor = :agent "
            . "AND camp = :camp";
        $stu = $this->pdo->prepare($query);
        $stu->bindValue(':camp', $campaign, \PDO::PARAM_INT);
        $stu->bindValue(':gestor', $agent);
        $stu->execute();
    }

    /**
     *
     * @param int $campaign
     * @param string $agent
     */
    public function unblockQueue($campaign, $agent)
    {
        $query = "UPDATE queuelist SET bloqueado = 0 "
            . "WHERE gestor = :gestor "
            . "AND camp = :camp";
        $stu = $this->pdo->prepare($query);
        $stu->bindValue(':camp', $campaign, \PDO::PARAM_INT);
        $stu->bindValue(':gestor', $agent);
        $stu->execute();
    }

    /**
     *
     * @param string $client
     * @param string $sdc
     * @param string $status
     */
    public function updateQueueAll($client, $sdc, $status)
    {

        $query = "UPDATE users,queuelist SET users.camp=queuelist.camp
where iniciales=gestor and cliente=:cliente
and status_aarsa=:status";
        $stq = $this->pdo->prepare($query);

        if (!empty($sdc)) {
            $query = "UPDATE users,queuelist SET users.camp=queuelist.camp
where iniciales=gestor and cliente=:client
and sdc=:sdc and status_aarsa=:status";
            $stq = $this->pdo->prepare($query);
            $stq->bindValue(':sdc', $sdc);
        }
        $stq->bindValue(':client', $client);
        $stq->bindValue(':status', $status);
        $stq->execute();
    }

    /**
     *
     * @param string $client
     * @param string $sdc
     * @param string $status
     */
    public function blockQueueAll($client, $sdc, $status)
    {
        $query = "UPDATE queuelist SET bloqueado = 1 "
            . "where cliente=:client "
            . "and sdc=:sdc "
            . "and status_aarsa=:status";
        $stu = $this->pdo->prepare($query);
        $stu->bindValue(':client', $client);
        $stu->bindValue(':sdc', $sdc);
        $stu->bindValue(':status', $status);
        $stu->execute();
    }

    /**
     *
     * @param string $client
     * @param string $sdc
     * @param string $status
     */
    public function unblockQueueAll($client, $sdc, $status)
    {
        $query = "UPDATE queuelist SET bloqueado = 0 "
            . "where cliente=:client "
            . "and sdc=:sdc "
            . "and status_aarsa=:status";
        $stu = $this->pdo->prepare($query);
        $stu->bindValue(':client', $client);
        $stu->bindValue(':sdc', $sdc);
        $stu->bindValue(':status', $status);
        $stu->execute();
    }

    /**
     *
     * @return array
     */
    public function getAgents()
    {
        $query = "SELECT distinct gestor 
            FROM queuelist
        JOIN users ON gestor=iniciales 
        WHERE tipo <> ''
        ORDER BY gestor";
        $result = $this->pdo->query($query);
        $all = $result->fetchAll();
        $output = array_column($all, 0);
        return $output;
    }

    /**
     *
     * @return array
     */
    public function getQueues()
    {
        $query = "SELECT distinct cliente,sdc,status_aarsa as 'cr',bloqueado
        FROM queuelist
        WHERE cliente<> ''
        ORDER BY cliente,sdc,status_aarsa";
        $stq = $this->pdo->query($query);
        $result = $stq->fetchAll(\PDO::FETCH_BOTH);
        return $result;
    }

    /**
     *
     * @param string $agent
     * @return array
     */
    public function getMyQueue($agent)
    {
        $query = "SELECT cliente, sdc, status_aarsa as 'cr', 
                                users.camp as 'camp'
                                FROM queuelist, users 
                                WHERE gestor = :gestor and gestor=iniciales 
                                and users.camp=queuelist.camp
                                and cliente<>''
                                ORDER BY cliente,sdc,status_aarsa
                                LIMIT 1";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':gestor', $agent);
        $stq->execute();
        $result = $stq->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @param string $agent
     * @return array
     */
    public function getMyQueues($agent)
    {
        $query = "SELECT cliente, sdc, status_aarsa as 'cr',
                                    camp, bloqueado
                                    FROM queuelist
                                    WHERE gestor = :gestor
                                    and cliente<>''
                                    ORDER BY cliente,sdc,camp";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':gestor', $agent);
        $stq->execute();
        $result = $stq->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}
