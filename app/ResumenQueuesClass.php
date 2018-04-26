<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of ResumenQueuesClass
 *
 * @author gmbs
 */
class ResumenQueuesClass extends BaseClass
{

    /**
     *
     * @param string $capt
     * @param int $camp
     * @return array
     */
    public function getMyQueue($capt, $camp)
    {
        $queryquery = "SELECT cliente, status_aarsa as cr, sdc 
        FROM queuelist 
        WHERE gestor = :capt 
        AND camp= :camp 
        LIMIT 1";
        $stq = $this->pdo->prepare($queryquery);
        $stq->bindParam(':capt', $capt);
        $stq->bindParam(':camp', $camp, \PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @param string $field
     * @param string $find
     * @return int
     */
    public function searchCount($field, $find)
    {
        $querycount = "SELECT count(1) as ct 
            FROM resumen 
            WHERE " . $field . " = :find 
            LIMIT 1";
        $stc = $this->pdo->prepare($querycount);
        $stc->bindParam(':find', $find);
        $stc->execute();
        $result = $stc->fetch(\PDO::FETCH_ASSOC);
        return $result['ct'];
    }

    /**
     *
     * @param string $cliente
     * @param string $sdc
     * @param string $cr
     * @return \PDOStatement
     */
    private function prepareResumenMain($cliente, $sdc, $cr)
    {
        if (empty($cliente)) {
            $clientStr = '';
        } else {
            $clientStr = " AND cliente = :cliente ";
        }
        if (empty($sdc)) {
            $sdcStr = " AND status_de_credito not regexp '-' ";
        } else {
            $sdcStr = " AND status_de_credito = :sdc ";
        }
        if (empty($cr)) {
            $crStr = " AND status_aarsa not in ('PAGO TOTAL','PAGO PARCIAL','PAGANDO CONVENIO', 'ACLARACION') ";
        } else {
            $crStr = " AND queue = :cr ";
        }

        $start = "SELECT * FROM resumen 
join dictamenes on dictamen=status_aarsa 
WHERE locker is null";
        $end = "ORDER BY fecha_ultima_gestion LIMIT 1";
        $querymain = $start . $clientStr . $sdcStr . $crStr . $end;

        if ($cr == 'SIN GESTION') {
            $start = "SELECT * FROM resumen WHERE locker is null ";
            $end = "AND ((status_aarsa='') or (status_aarsa is null)) ORDER BY saldo_total desc LIMIT 1";
            $querymain = $start . $clientStr . $sdcStr . $end;
        }

        if (($cr == 'INICIAL')) {
            $querymain = "SELECT * FROM resumen
WHERE status_de_credito not regexp '-' 
AND status_aarsa not in ('PAGO TOTAL','PAGO PARCIAL','PAGANDO CONVENIO', 'ACLARACION')
AND ejecutivo_asignado_call_center = :capt
AND locker is null 
and fecha_ultima_gestion < curdate()
order by fecha_ultima_gestion  LIMIT 1";
        }
        if ($cr == 'ESPECIAL') {
            $querymain = "SELECT * FROM resumen WHERE locker is null" . $clientStr . $sdcStr .
                "AND fecha_ultima_gestion<last_day(curdate()-interval 1 month)+interval 1 day
order by fecha_ultima_gestion  LIMIT 1";
        }
        if ($cr == 'MANUAL') {
            $start = "select * from resumen where locker is null";
            $middle = "and status_aarsa not in (
                select dictamen from dictamenes
	where queue in ('PAGOS','PROMESAS','ACLARACION')
	)
and especial > 0";
            $end = "order by (ejecutivo_asignado_call_center=:capt) desc, especial, saldo_descuento_1 desc limit 1";
            $querymain = $start . $clientStr . $sdcStr . $middle . $end;
        }
        $stm = $this->pdo->prepare($querymain);
        return $stm;
    }

    /**
     *
     * @param \PDOStatement $stm
     * @param string $capt
     * @param string $cliente
     * @param string $sdc
     * @param string $cr
     * @return \PDOStatement
     */
    private function bindResumenMain($stm, $capt, $cliente, $sdc, $cr)
    {
        if (in_array($cr, array('MANUAL', 'INICIAL'))) {
            $stm->bindParam(':capt', $capt);
            return $stm;
        }
        if (!empty($cliente)) {
            $stm->bindParam(':cliente', $cliente);
        }
        if (!empty($sdc)) {
            $stm->bindParam(':sdc', $sdc);
        }
        if (in_array($cr, array('ESPECIAL', 'SIN GESTION'))) {
            return $stm;
        }
        if (empty($cr)) {
            return $stm;
        }
        $stm->bindParam(':cr', $cr);
        return $stm;
    }

    /**
     *
     * @param \PDOStatement $stm
     * @return array
     */
    private function runResumenMain($stm)
    {
        try {
            $stm->execute();
            $result = $stm->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\Exception $e) {
            return array();
        }
    }

    /**
     *
     * @param string $capt
     * @param int $camp
     * @return array
     */
    public function getResumen($capt, $camp)
    {
        $queue = $this->getMyQueue($capt, $camp);
        $cliente = $queue['cliente'];
        $sdc = $queue['sdc'];
        $cr = $queue['cr'];
        $stm = $this->prepareResumenMain($cliente, $sdc, $cr);
        $stmBound = $this->bindResumenMain($stm, $capt, $cliente, $sdc, $cr);
        $result = $this->runResumenMain($stmBound);
        return $result;
    }

    /**
     *
     * @param int $id_cuenta
     * @return array
     */
    public function getOne($id_cuenta)
    {
        $query = "SELECT * FROM resumen where id_cuenta = :id_cuenta LIMIT 1";
        $stm = $this->pdo->prepare($query);
        $stm->bindParam(':id_cuenta', $id_cuenta, \PDO::PARAM_INT);
        $stm->execute();
        $result = $stm->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
}
