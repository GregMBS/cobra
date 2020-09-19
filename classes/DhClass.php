<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/DhObject.php';
require_once __DIR__ . '/HistoriaObject.php';

/**
 * Database Class for ddh/pdh
 *
 * @author gmbs
 *
 */
class DhClass {

    /**
     * @var PDO $pdo
     */
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * @param string $gestor
     * @param string $fecha
     * @return DhObject[]
     */
    public function getPromesas(string $gestor, string $fecha) {
        $query = "select distinct c_cont from historia 
where c_cvge = :gestor and d_fech = :fecha and n_prom > 0 limit 10000";
        return $this->getCommon($query, $gestor, $fecha);
    }

    /**
     * 
     * @param string $gestor
     * @param string $fecha
     * @return array
     */
    public function getDhMain(string $gestor, string $fecha) {
        $query = "select distinct c_cont from historia 
where (c_cvge = :gestor or c_visit = :gestor) and d_fech = :fecha and c_cont > 0 limit 10000";
        return $this->getCommon($query, $gestor, $fecha);
    }

    /**
     * @param string $query
     * @param string $gestor
     * @param string $fecha
     * @return DhObject[]
     */
    protected function getCommon(string $query, string $gestor, string $fecha): array
    {
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->bindParam(':fecha', $fecha);
        $stq->execute();
        $promesas = $stq->fetchAll(PDO::FETCH_ASSOC);
        $queryResumen = "SELECT * from resumen where id_cuenta = :id_cuenta";
        $str = $this->pdo->prepare($queryResumen);
        $queryLastProm = "SELECT * from historia 
        where c_cont = :c_cont and c_cvge = :gestor and d_fech = :fecha and n_prom > 0
        order by c_hrin desc limit 1";
        $stl = $this->pdo->prepare($queryLastProm);
        $report = [];
        foreach ($promesas as $prom) {
            $str->bindParam(':id_cuenta', $prom['c_cont']);
            $str->execute();
            /** @var DhObject $resumen */
            $resumen = $str->fetchObject(DhObject::class);
            $stl->bindParam(':c_cont', $resumen->id_cuenta);
            $stl->bindParam(':gestor', $gestor);
            $stl->bindParam(':fecha', $fecha);
            $stl->execute();
            /** @var HistoriaObject $promesa */
            $promesa = $stl->fetchObject(HistoriaObject::class);
            if ($promesa) {
                $resumen->c_hrin = $promesa->C_HRIN;
                $resumen->n_prom = $promesa->N_PROM;
                $resumen->d_prom = $promesa->D_PROM;
            }
            $report[] = $resumen;
        }
        return $report;
    }

}
