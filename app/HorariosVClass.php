<?php

namespace App;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Database Class for horarios
 *
 * @author gmbs
 */
/*
class HorariosVClass extends BaseClass {

    /**
     *
     * @param float $dec
     * @return string
     */
    /*
    public function convertTime($dec) {
        $hour = floor($dec);
        $min = round(60 * ($dec - $hour));
        return $hour . ':' . str_pad($min, 2, '0', STR_PAD_LEFT);
    }


    /**
     *
     * @return array
     */
    /*
    public function listVisitadores() {
        $query = <<<SQL
            select distinct c_visit as completo, c_visit as iniciales
from historia 
where d_fech>last_day(curdate()-interval 1 month)
and d_fech<=last_day(curdate())
and c_visit <> ''
order by c_visit
SQL;
        $result = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $gestor
     * @param integer $dom
     * @return array
     */
    /*
    public function getStart($gestor, $dom) {
        $query = "select min(C_HRIN) as start
            from historia
            where c_visit=:gestor 
            and D_FECH=last_day(curdate() - interval 1 month) + interval :dom day
            and c_cont>0";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->bindParam(':dom', $dom, \PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetch(\PDO::FETCH_ASSOC);
        return $result['start'];
    }
    */

    /**
     *
     * @param string $gestor
     * @param integer $dom
     * @return array
     */
    /*
    public function getStop($gestor, $dom) {
        $query = "select max(C_HRIN) as stop
            from historia
            where c_visit=:gestor 
            and D_FECH=last_day(curdate() - interval 1 month) + interval :dom day
            and c_cont>0";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->bindParam(':dom', $dom, \PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetch(\PDO::FETCH_ASSOC);
        return $result['stop'];
    }
    */

    /**
     *
     * @param string $status
     * @param string $gestor
     * @param int $dom
     * @return int
     */
    /*
    public function countByStatusAndGestor($status, $gestor, $dom) {
        $query = "select 
            count(1) as visitas
            from historia
            where c_cvst = :status
            and c_visit=:gestor 
            and D_FECH=last_day(curdate() - interval 1 month) + interval :dom day";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':status', $status);
        $stq->bindParam(':gestor', $gestor);
        $stq->bindParam(':dom', $dom, \PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetch(\PDO::FETCH_ASSOC);
        return $result['visitas'];
    }
    */

    /**
     *
     * @param string $visitador
     * @param int $dom
     * @return int
     */
    /*
    public function countAllContacts($visitador, $dom) {
        $query = "select count(1) as visitas
            from historia,dictamenes
            where c_visit = :visitador
            and D_FECH=last_day(curdate() - interval 1 month) + interval :dom day
            and c_cvst=dictamen
            and queue <> 'SIN CONTACTOS'";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':visitador', $visitador);
        $stq->bindParam(':dom', $dom, \PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetch(\PDO::FETCH_ASSOC);
        return $result['visitas'];
    }
    */

    /**
     *
     * @param string $visitador
     * @param int $dom
     * @return int
     */
    /*
    public function countAllVisits($visitador, $dom) {
        $query = "select count(1) as visitas
            from historia,dictamenes
            where c_visit=:visitador
            and D_FECH=last_day(curdate() - interval 1 month) + interval :dom day
            and c_cvst=dictamen";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':visitador', $visitador);
        $stq->bindParam(':dom', $dom, \PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetch(\PDO::FETCH_ASSOC);
        return $result['visitas'];
    }
    */

    /**
     * 
     * @param string $title
     * @param array $array
     * @param int $dhoy
     * @param string $iniciales
     * @return string
     */
    /*
    public function rowDisplay($title, $array, $dhoy, $iniciales) {
        $sum = 0;
        $html = '<tr><td class="heavy">' . $title . '</td>';
        for ($i = 1; $i <= $dhoy; $i++) {
            $item = '';
            if (!is_null($array[$iniciales][$i])) {
                $item = $array[$iniciales][$i];
            }
            if (is_numeric($item)) {
                $sum += $item;
            }

            $html .= '<td class="light">';

            if ($item != 0) {
                $html .= $item;
            }
            $html .= '</td>';
        }
        if ($sum > 0) {
            $html .= '<td class="heavy">' . $sum . '</td>';
        }

        $html .= '</tr>';

        return $html;
    }
    */

    /**
     * 
     * @param int $i
     * @return int
     */
    /*
    public function dayOfWeek($i) {
        $date = date('Y-m-').$i;
        $dow = date('w', strtotime($date));
        return $dow;
    }
    */

    /**
     * 
     * @return array
     */
    /*
    public function countsByStatus() {
        $query = "SELECT 
    c_cvst, COUNT(1) AS visitas
FROM
    historia
WHERE
    D_FECH = LAST_DAY(CURDATE() - INTERVAL 1 MONTH) + INTERVAL 5 DAY
and c_visit <> ''
GROUP BY c_cvst
WITH ROLLUP";
        $stc = $this->pdo->prepare($query);
        $stc->execute();
        $result = $stc->fetchAll();
        return $result;
    }
}
    */
