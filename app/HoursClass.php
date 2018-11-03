<?php
namespace App;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Database Class for Hours
 *
 * @author gmbs
 */
class HoursClass extends BaseClass
{

    /**
     *
     * @return array
     */
    public function listAgents()
    {
        $query = 'select distinct c_cvge from historia
            where d_fech>last_day(curdate() - interval 1 month)
            order by c_cvge limit 1000;';
        $result = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     *
     * @return array
     */
    public function listVisitors()
    {
        $query = 'select distinct completo,iniciales
from nombres join historia on iniciales=c_visit
where d_fech>last_day(curdate()-interval 1 month)
and d_fech<=last_day(curdate())
order by iniciales;';
        $result = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $agent
     * @param integer $day
     * @return array
     */
    private function getStartStopDiff($agent, $day)
    {
        $query = "select min(C_HRIN) as start, max(C_HRFI) as stop,
            time_to_sec(timediff(max(C_HRFI),min(C_HRIN))) as diff
            from historia
            where c_cvge=:agent and c_msge is null
            and c_cniv is null
            and D_FECH=last_day(curdate() - interval 1 month) + interval :day day
            and c_cont=0";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':agent', $agent);
        $stq->bindValue(':day', $day, \PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @param string $agent
     * @param int $day
     * @return array
     */
    private function getCurrentMain($agent, int $day)
    {
        $query = "select count(distinct c_cont) as cuentas,
            sum(n_prom > 0) as promesas,
            count(1) as gestiones,
            count(1)-sum(queue='SIN CONTACTOS') as nocontactos,
            sum(queue='SIN CONTACTOS') as contactos
            from historia
            left join dictamenes on c_cvst=dictamen
            where c_cvge=:agent and c_msge is null
            and c_cniv is null and c_cont>0
            and D_FECH=last_day(curdate() - interval 1 month) + interval :day day";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':agent', $agent);
        $stq->bindValue(':day', $day, \PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $visitor
     * @param int $day
     * @return array
     */
    private function getVisitorMain($visitor, $day)
    {
        $query = "select count(distinct c_cont) as cuentas,
            sum(n_prom > 0) as promesas,
            count(1) as gestiones,
            count(1)-sum(queue='SIN CONTACTOS') as nocontactos,
            sum(queue='SIN CONTACTOS') as contactos
            from historia
            left join dictamenes on c_cvst=dictamen
            where c_visit=:visitor and c_msge is null
            and c_cniv <> '' and c_cont>0
            and D_FECH=last_day(curdate() - interval 1 month) + interval :day day
            ";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':visitor', $visitor);
        $stq->bindValue(':day', $day, \PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $yr
     * @param string $mes
     * @param int $todayDay
     * @return string[]
     */
    public function dowArray($yr, $mes, $todayDay)
    {
        $dow = array();
        for ($i = 1; $i <= $todayDay; $i ++) {
            $dow[$i] = date("l", strtotime($yr . "-" . $mes . "-" . $i));
        }
        return $dow;
    }

    /**
     * @param string $c_visit
     * @param int $todayDay
     * @return array
     */
    public function packVisit($c_visit, $todayDay): array
    {
        $row = array();
        for ($i = 1; $i <= $todayDay; $i++) {
            $data = new HoursDataClass($i);
            $main = $this->getVisitorMain($c_visit, $i);
            $data->calls = $main['gestiones'];
            $data->accounts = $main['cuentas'];
            $data->contacts = $main['contactos'];
            $data->noContacts = $main['nocontactos'];
            $data->promises = $main['promesas'];
            $data->payments = 0;
            $row[$i] = $data;
        }
        return $row;
    }

    /**
     * @param string $agent
     * @param int $todayDay
     * @return array
     */
    public function packData(string $agent, int $todayDay) {
        $row = array();
        for ($i = 1; $i <= $todayDay; $i++) {
            $data = new HoursDataClass($i);
            $startStop = $this->getStartStopDiff($agent, $i);
            $data->start = $startStop['start'];
            $data->stop = $startStop['stop'];
            $data->diff = $startStop['diff'];
            $main = $this->getCurrentMain($agent, $i);
            $data->calls = $main['gestiones'];
            $data->accounts = $main['cuentas'];
            $data->contacts = $main['contactos'];
            $data->noContacts = $main['nocontactos'];
            $data->promises = $main['promesas'];
            $data->payments = 0;
            $row[$i] = $data;
        }
        return $row;
    }


}