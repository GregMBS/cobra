<?php

namespace App;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Database queries for 'big' reports
 *
 * @author gmbs
 *
 */
class BigCallClass extends BaseClass
{

    /**
     *
     * @param string $direction
     * @return string
     */
    private function cleanDirection($direction)
    {
        $haystack = array('asc', 'ASC', 'desc', 'DESC');
        if (!in_array($direction, $haystack)) {
            $direction = 'ASC';
        }
        return $direction;
    }

    /**
     *
     * @param string $queryFront
     * @param string $queryBack
     * @param BigDataClass $bdc
     * @return array
     */
    private function getHistory($queryFront, $queryBack, BigDataClass $bdc)
    {
        $agentString = $bdc->getAgentString();
        $clientString = $bdc->getClientString();
        $userTypeString = $bdc->getTipoString();
        $query = $queryFront . $agentString . $clientString . $userTypeString . $queryBack;
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':fecha1', $bdc->date1);
        $stq->bindValue(':fecha2', $bdc->date2);
        if ($bdc->hasAgent()) {
            $stq->bindValue(':gestor', $bdc->agent);
        }
        if ($bdc->hasClient()) {
            $stq->bindValue(':cliente', $bdc->client);
        }
        $stq->execute();
        $data = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    /**
     *
     * @param BigDataClass $bdc
     * @return array
     */
    public function getAllCalls(BigDataClass $bdc)
    {
        $queryFront = "SELECT numero_de_cuenta,nombre_deudor,
            resumen.cliente,status_de_credito,saldo_total,queue,h1.*
    from resumen join historia h1 on c_cont=id_cuenta
join dictamenes on status_aarsa=dictamen
where d_fech between :fecha1 and :fecha2
";

        $queryBack = "and status_de_credito not regexp '-'
ORDER BY d_fech,c_hrin";
        $data = $this->getHistory($queryFront, $queryBack, $bdc);
        return $data;
    }

    /**
     *
     * @param string $direction
     * @return array
     */
    public function getCallDates($direction)
    {
        $dir = $this->cleanDirection($direction);
        $start = "SELECT distinct d_fech FROM historia
        WHERE d_fech>LAST_DAY(CURDATE()-INTERVAL 1 YEAR)
        ORDER BY d_fech ";
        $end = " LIMIT 360";
        $query = $start . $dir . $end;
        $stq = $this->pdo->query($query);
        $result = $stq->fetchAll(\PDO::FETCH_BOTH);
        return $result;
    }

    /**
     *
     * @return string[]
     */
    public function getCallClients()
    {
        $query = "SELECT distinct c_cvba FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        limit 10
	";
        $stq = $this->pdo->query($query);
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        $clients = array_column($result, 'c_cvba');
        return $clients;
    }

    /**
     *
     * @return string[]
     */
    public function getCallAgents()
    {
        $query = "SELECT c_cvge, count(1) FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        group by c_cvge";
        $stq = $this->pdo->query($query);
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        $agents = array_column($result, 'c_cvge');
        return $agents;
    }

}
