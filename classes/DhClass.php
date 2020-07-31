<?php

namespace cobra_salsa;

use PDO;
use PDOStatement;

require_once __DIR__ . '/DhObject.php';

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

    /**
     * @var string
     */
    private $queryWithPromesas = "select n_prom, d_prom, c_hrin 
        from historia
        where c_cont = :id_cuenta
        and n_prom > 0
        order by c_hrin desc";

    /**
     * @var string
     */
    private $queryPromesas = "select n_prom, d_prom, c_hrin 
        from historia
        where c_cont = :id_cuenta
        order by c_hrin desc";

    /**
     * @var string
     */
    private $queryVcc = "select v_cc 
        from dictamenes
        where dictamen = :status_aarsa";

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * @param string $gestor
     * @param string $fecha
     * @return array
     */
    public function getPromesas(string $gestor, string $fecha) {
        $query = "select distinct resumen.*
from resumen
join historia on c_cont=id_cuenta
where c_cvge = :gestor and d_fech = :fecha and n_prom > 0";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->bindParam(':fecha', $fecha);
        $stq->execute();
        $report = $stq->fetchAll(PDO::FETCH_CLASS, DhObject::class);
        $stp = $this->pdo->prepare($this->queryWithPromesas);
        $stv = $this->pdo->prepare($this->queryVcc);
        /** @var DhObject $resumen */
        $this->addPromAndRank($report, $stp, $stv);
        return $report;
    }

    /**
     * 
     * @param string $gestor
     * @param string $fecha
     * @return array
     */
    public function getDhMain($gestor, $fecha) {
        $query = "select distinct resumen.*
    from resumen
    join historia on id_cuenta=c_cont
    join dictamenes on dictamen=status_aarsa
    where c_cvge=:gestor and d_fech=:fecha";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->bindParam(':fecha', $fecha);
        $stq->execute();
        $report = $stq->fetchAll(PDO::FETCH_CLASS, DhObject::class);
        $stp = $this->pdo->prepare($this->queryPromesas);
        $stv = $this->pdo->prepare($this->queryVcc);
        $this->addPromAndRank($report, $stp, $stv);
        return $report;
    }

    /**
     * @param array $report
     * @param PDOStatement $stp
     * @param PDOStatement $stv
     */
    private function addPromAndRank(array $report, PDOStatement $stp, PDOStatement $stv): void
    {
        /** @var DhObject $resumen */
        foreach ($report as $resumen) {
            $stp->bindParam(':id_cuenta', $resumen->id_cuenta);
            $stp->execute();
            $promesa = $stp->fetch(PDO::FETCH_ASSOC);
            $resumen->d_prom = $promesa['d_prom'];
            $resumen->n_prom = $promesa['n_prom'];
            $resumen->c_hrin = $promesa['c_hrin'];
            $stv->bindParam(':status_aarsa', $resumen->status_aarsa);
            $stp->execute();
            $ranking = $stv->fetch(PDO::FETCH_ASSOC);
            $resumen->v_cc = $ranking['v_cc'];
        }
    }

}
