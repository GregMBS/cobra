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
class IntensidadClass extends BaseClass
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
     * @param string $query
     * @param string $fecha1
     * @param string $fecha2
     * @return array
     */
    private function getIntensidad($query, $fecha1, $fecha2)
    {
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':fecha1', $fecha1);
        $stq->bindParam(':fecha2', $fecha2);
        $stq->execute();
        $data = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    /**
     *
     * @param string $fecha1
     * @param string $fecha2
     * @return array
     */
    public function getByCuenta($fecha1, $fecha2)
    {
        $start = min([$fecha1, $fecha2]);
        $end = max([$fecha1, $fecha2]);
        $query = "SELECT numero_de_cuenta,count(distinct auto) as 'intensidad'
from resumen
left join historia on c_cont=id_cuenta
and d_fech between :fecha1 and :fecha2
where status_de_credito not regexp '-'
group by numero_de_cuenta
";
        $data = $this->getIntensidad($query, $start, $end);
        return $data;
    }

    /**
     *
     * @param string $fecha1
     * @param string $fecha2
     * @return array
     */
    public function getBySegmento($fecha1, $fecha2)
    {
        $start = min([$fecha1, $fecha2]);
        $end = max([$fecha1, $fecha2]);
        $query = <<<SQL
SELECT cliente,status_de_credito as 'segmento',queue,
            count(1) as 'intensidad'
from historia,resumen,dictamenes
where c_cont=id_cuenta
and status_aarsa=dictamen
and d_fech between :fecha1 and :fecha2
and status_de_credito not regexp '-'
group by cliente,status_de_credito,queue
with rollup
SQL;
        $data = $this->getIntensidad($query, $start, $end);
        return $data;
    }

    /**
     *
     * @param string $direction
     * @return array
     *
     */
    public function getGestionDates($direction)
    {
        $dir = $this->cleanDirection($direction);
        $start = <<<SQL
        SELECT distinct d_fech FROM historia
        where d_fech>last_day(curdate()-interval 1 year)
        ORDER BY d_fech 
SQL;
        $end = " limit 360";
        $query = $start . $dir . $end;
        $result = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     *
     * @return array
     */
    public function getGestionClientes()
    {
        $query = <<<SQL
SELECT distinct c_cvba FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        limit 10
	
SQL;
        $result = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

}
