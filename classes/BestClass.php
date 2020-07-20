<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/HistoriaObject.php';
require_once __DIR__ . '/ResumenObject.php';

/**
 * Database Queries for 'best' reports
 *
 * @author gmbs
 *
 */
class BestClass extends BaseClass
{

    public function getResumenData() {
        $query = "select * from resumen
        where status_de_credito not regexp '-'
        order by numero_de_cuenta";
        return $this->getResumen($query);
    }

    /**
     * @param int $c_cont
     * @return HistoriaObject
     */
    public function getLastHistoriaData($c_cont) {
        $query = "select * from historia
        where c_cont = :c_cont
        order by d_fech desc, c_hrin desc limit 1";
        return $this->getHistoria($query, $c_cont);
    }

    /**
     * 
     * @param int $c_cont
     * @return HistoriaObject
     */
    public function getBestHistoriaData($c_cont) {
        $query = "select historia.* 
        from historia
join dictamenes on c_cvst = dictamen
where c_cont = :c_cont
order by v_cc asc, d_fech desc limit 1";
        return $this->getHistoria($query, $c_cont);
    }
    
    /**
     * 
     * @param int $c_cont
     * @return int
     */
    public function countGestiones($c_cont): int
    {
        $query = "select count(1) as ct from historia where c_cont = :c_cont";
        $result = $this->getArray($query, $c_cont);
        return (int) $result['ct'];
    }

    /**
     * @param string $query
     * @param int $c_cont
     * @return array
     */
    private function getArray(string $query, int $c_cont): array
    {
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':c_cont', $c_cont);
        $stq->execute();
        $result = $stq->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        }
        return [];
    }

    /**
     * @param string $query
     * @param int $c_cont
     * @return HistoriaObject
     */
    private function getHistoria(string $query, int $c_cont): HistoriaObject
    {
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':c_cont', $c_cont);
        $stq->execute();
        $result = $stq->fetchObject( HistoriaObject::class);
        if ($result) {
            return $result;
        }
        return new HistoriaObject();
    }

    /**
     * @param string $query
     * @return ResumenObject
     */
    private function getResumen(string $query): ResumenObject
    {
        $stq = $this->pdo->prepare($query);
        $stq->execute();
        $result = $stq->fetchObject(ResumenObject::class);
        if ($result) {
            return $result;
        }
        return new ResumenObject();
    }
}
