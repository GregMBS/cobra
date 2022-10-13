<?php

namespace cobra_salsa;

use PDO;
use PDOStatement;

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

    /**
     * @return false|PDOStatement
     */
    public function getResumenData() {
        $query = "select ejecutivo_asignado_call_center, numero_de_cuenta, nombre_deudor, cliente, status_de_credito, 
        id_cuenta, saldo_total, saldo_descuento_1, saldo_descuento_2, date(fecha_ultima_gestion) as fecha_ultima, 
        time(fecha_ultima_gestion) as hora_ultima, 
        producto, subproducto, status_aarsa, tel_1, tel_2, fecha_de_ultimo_pago, monto_ultimo_pago from resumen
        force index (cuenta)
        where status_de_credito not regexp '-'";
        $stq = $this->pdo->prepare($query);
        $stq->execute();
        return $stq;
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
order by v_cc, d_fech desc limit 1";
        return $this->getHistoria($query, $c_cont);
    }
    
    /**
     * 
     * @param int $c_cont
     * @return int
     */
    public function countGestiones(int $c_cont): int
    {
        $query = "select count(1) as ct from historia where c_cont = :c_cont";
        if (!is_int($c_cont)) {
            return 'X';
        }
        if ($c_cont == 0) {
            return 'XX';
        }
        $result = $this->getArray($query, $c_cont);
        if (isset($result['ct'])) {
            return $result['ct'];
        }
        return 0;
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
        try {
            $stq = $this->pdo->prepare($query);
            $stq->bindValue(':c_cont', $c_cont, PDO::PARAM_INT);
            $stq->execute();
            $result = $stq->fetchObject(HistoriaObject::class);
        } catch (\PDOException $p) {
            var_dump($p->errorInfo);
            die();
        }
        if (is_object($result)) {
            return $result;
        }
        return new HistoriaObject();
    }
}
