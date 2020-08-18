<?php

namespace cobra_salsa;

use PDO;
use PDOStatement;

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
     * @return DhObject[]
     */
    public function getPromesas(string $gestor, string $fecha) {
        $query = "select c_cont, max(c_hrin) as maxTime from historia 
where c_cvge = :gestor and d_fech = :fecha and n_prom > 0 group by c_cont";
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
            $stl->bindParam(':c_cont',$resumen->id_cuenta);
            $stl->bindParam(':gestor', $gestor);
            $stl->bindParam(':fecha', $fecha);
            $stl->execute();
            /** @var HistoriaObject $promesa */
            $promesa = $stl->fetchObject(HistoriaObject::class);
            $resumen->c_hrin = $promesa->C_HRIN;
            $resumen->n_prom = $promesa->N_PROM;
            $resumen->d_prom = $promesa->D_PROM;
            $report[] = $resumen;
        }
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
     * @param DhObject[] $report
     * @param PDOStatement $stp
     * @param PDOStatement $stv
     */
    private function addPromAndRank(array $report, PDOStatement $stp, PDOStatement $stv): void
    {
       foreach ($report as $resumen) {
            $stp->bindParam(':id_cuenta', $resumen->id_cuenta);
            $stp->execute();
            $promesa = $stp->fetch(PDO::FETCH_ASSOC);
            $resumen->d_prom = $promesa['d_prom'];
            $resumen->n_prom = $promesa['n_prom'];
            $resumen->c_hrin = $promesa['c_hrin'];
            $stv->bindParam(':status_aarsa', $resumen->status_aarsa);
            $stv->execute();
            $ranking = $stv->fetch(PDO::FETCH_ASSOC);
            $resumen->v_cc = $ranking['v_cc'];
        }
    }

}
