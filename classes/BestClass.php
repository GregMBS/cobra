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
    public function getLastHistoriaData(int $c_cont): HistoriaObject
    {
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
    public function getBestHistoriaData(int $c_cont): HistoriaObject
    {
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

    /**
     * @return void
     */
    public function createLastBest()
    {
        $queryDropL = "drop table if exists lasttemp";
        $this->pdo->query($queryDropL);
        $queryL = "create table lasttemp
select c_cont,
       c_cvst as ultimo_status,
       c_tele as ultimo_tel,
       c_obse1 as ultimo_comentario,
       c_accion as ultimo_accion
from historia
limit 0";
        $this->pdo->query($queryL);
        $queryDropB = "drop table if exists besttemp";
        $this->pdo->query($queryDropB);
        $queryB = "create table besttemp 
select c_cont,
       c_cvst as mejor_status,
       c_tele as mejor_tel,
       d_fech as mejor_fecha,
       c_accion as mejor_accion
from historia
limit 0";
        $this->pdo->query($queryB);
        $queryDropG = "drop table if exists gestioncount";
        $this->pdo->query($queryDropG);
        $queryG = "create table gestioncount (PRIMARY KEY id (c_cont))
select c_cont, count(1) as gestiones
from historia
group by c_cont";
        $this->pdo->query($queryG);
        $queryDropLB = "drop table if exists lastbest";
        $this->pdo->query($queryDropLB);
        $queryLB = "create table lastbest (INDEX id (id_cuenta))
select ejecutivo_asignado_call_center, concat('',numero_de_cuenta,'') as 'numero_de_cuenta', nombre_deudor, cliente, status_de_credito,
       id_cuenta, saldo_total, saldo_descuento_1, saldo_descuento_2, date(fecha_ultima_gestion) as fecha_ultima,
       time(fecha_ultima_gestion) as hora_ultima,
       producto, subproducto, status_aarsa, tel_1, tel_2, fecha_de_ultimo_pago, monto_ultimo_pago,
       ultimo_status, ultimo_tel, ultimo_comentario, ultimo_accion,
       mejor_status,mejor_tel,mejor_fecha,mejor_accion, gestiones
from resumen
         left join lasttemp on lasttemp.c_cont=id_cuenta
         left join besttemp on besttemp.c_cont=id_cuenta
         left join gestioncount on gestioncount.c_cont=id_cuenta
where status_de_credito not regexp '-'";
        $this->pdo->query($queryLB);
        $queryUL = "update lastbest, historia
set ultimo_status = c_cvst,
    ultimo_tel = c_tele, ultimo_comentario = c_obse1,
    ultimo_accion = c_accion
where id_cuenta=c_cont and fecha_ultima=d_fech and hora_ultima=c_hrin";
        $this->pdo->query($queryUL);
        $queryUB = "update lastbest, bestrankedtemp
set mejor_status = c_cvst,
    mejor_tel = c_tele, mejor_fecha = d_fech,
    mejor_accion = c_accion
where id_cuenta=c_cont";
        $this->pdo->query($queryUB);
    }

    /**
     * @return false|PDOStatement
     */
    public function getLastBest()
    {
        $query = "select * from lastbest";
        $stq = $this->pdo->prepare($query);
        $stq->execute();
        return $stq;
    }

    public function createBestTemp()
    {
        $queryDropR = "drop table if exists ranked";
        $this->pdo->query($queryDropR);
        $queryR = "create table ranked
select historia.*,v_cc
from historia
         join dictamenes on c_cvst = dictamen";
        $this->pdo->query($queryR);
        $queryDropBR = "drop table if exists bestrank";
        $this->pdo->query($queryDropBR);
        $queryBR = "create table bestrank
select c_cont, min(v_cc) as vc
from ranked
group by c_cont";
        $this->pdo->query($queryBR);
        $queryDropBRT = "drop table if exists bestrankedtemp";
        $this->pdo->query($queryDropBRT);
        $queryBT = "create table bestrankedtemp
select * from ranked
where (c_cont, v_cc) IN (select c_cont, vc from bestrank)";
        $this->pdo->query($queryBT);
    }

    /**
     *
     * @param int $c_cont
     * @return array
     */
    public function getNewBestHistoriaData(int $c_cont): array
    {
        $query = "select * 
        from bestrankedtemp
where c_cont = :c_cont
limit 1";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':c_cont', $c_cont, PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        }
        return array(
            'C_CVST' => '',
            'C_TELE' => '',
            'D_FECH' => '',
            'C_ACCION' => ''
        );
    }

}
