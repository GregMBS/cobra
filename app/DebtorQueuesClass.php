<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Query\Builder;

/**
 * Description of DebtorQueuesClass
 *
 * @author gmbs
 */
class DebtorQueuesClass extends BaseClass
{

    /**
     *
     * @param string $capt
     * @param int $camp
     * @return array
     */
    public function getMyQueue($capt, $camp)
    {
        $ql = new Queue();
        /**
         * @var Queue $queueList
         */
        $queueList = $ql->whereGestor($capt);
        $queueList = $queueList->whereCamp($camp);
        try {
            $queueList = $queueList->firstOrFail();
            $result = $queueList->toArray();
            $result['cr'] = $result['status_aarsa'];
        } catch (ModelNotFoundException $m) {
            $result = [
                'cliente' => '',
                'cr' => '',
                'sdc' => ''
            ];
        }
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
        /** @var Builder $rc */
        $rc = new Debtor();
        /**
         * @var Debtor|Builder $query
         */
        $query = $rc->where($field, '=', $find);
        $count = $query->count();
        return $count;
    }

    /**
     *
     * @param string $client
     * @param string $sdc
     * @param string $cr
     * @return \PDOStatement
     */
    private function prepareDebtorMain($client, $sdc, $cr)
    {
        $clientStr = " AND cliente = :cliente ";
        $sdcStr = " AND status_de_credito = :sdc ";
        $crStr = " AND queue = :cr ";
        if (empty($client)) {
            $clientStr = '';
        }
        if (empty($sdc)) {
            $sdcStr = " AND status_de_credito not regexp '-' ";
        }
        if (empty($cr)) {
            $crStr = " AND status_aarsa not in ('PAGO TOTAL','PAGO PARCIAL','PAGANDO CONVENIO', 'ACLARACION') ";
        }

        $start = "SELECT * FROM resumen 
join dictamenes on dictamen=status_aarsa 
WHERE locker is null";
        $end = "ORDER BY fecha_ultima_gestion LIMIT 1";
        $query = $start . $clientStr . $sdcStr . $crStr . $end;

        if ($cr == 'SIN GESTION') {
            $start = "SELECT * FROM resumen WHERE locker is null ";
            $end = "AND ((status_aarsa='') or (status_aarsa is null)) ORDER BY saldo_total desc LIMIT 1";
            $query = $start . $clientStr . $sdcStr . $end;
        }

        if (($cr == 'INICIAL')) {
            $query = "SELECT * FROM resumen
WHERE status_de_credito not regexp '-' 
AND status_aarsa not in ('PAGO TOTAL','PAGO PARCIAL','PAGANDO CONVENIO', 'ACLARACION')
AND ejecutivo_asignado_call_center = :capt
AND locker is null 
and fecha_ultima_gestion < curdate()
order by fecha_ultima_gestion  LIMIT 1";
        }
        if ($cr == 'ESPECIAL') {
            $query = "SELECT * FROM resumen WHERE locker is null" . $clientStr . $sdcStr .
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
            $query = $start . $clientStr . $sdcStr . $middle . $end;
        }
        $stm = $this->pdo->prepare($query);
        return $stm;
    }

    /**
     *
     * @param \PDOStatement $stm
     * @param string $capt
     * @param string $client
     * @param string $sdc
     * @param string $cr
     * @return \PDOStatement
     */
    private function bindDebtorMain($stm, $capt, $client, $sdc, $cr)
    {
        if (in_array($cr, array('MANUAL', 'INICIAL'))) {
            $stm->bindValue(':capt', $capt);
            return $stm;
        }
        if (!empty($client)) {
            $stm->bindValue(':cliente', $client);
        }
        if (!empty($sdc)) {
            $stm->bindValue(':sdc', $sdc);
        }
        if (in_array($cr, array('ESPECIAL', 'SIN GESTION'))) {
            return $stm;
        }
        if (empty($cr)) {
            return $stm;
        }
        $stm->bindValue(':cr', $cr);
        return $stm;
    }

    /**
     *
     * @param \PDOStatement $stm
     * @return array
     */
    private function runDebtorMain($stm)
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
     * @param int $campaign
     * @return array
     */
    public function getDebtor($capt, $campaign)
    {
        $queue = $this->getMyQueue($capt, $campaign);
        $client = $queue['cliente'];
        $sdc = $queue['sdc'];
        $cr = $queue['cr'];
        $stm = $this->prepareDebtorMain($client, $sdc, $cr);
        $stmBound = $this->bindDebtorMain($stm, $capt, $client, $sdc, $cr);
        $result = $this->runDebtorMain($stmBound);
        return $result;
    }

    /**
     *
     * @param int $id
     * @return array
     */
    public function getOne($id)
    {
        /** @var Debtor|Builder $rc */
        $rc = new Debtor();
        /**
         * @var \Illuminate\Database\Eloquent\Builder $query
         */
        $query = $rc->whereIdCuenta($id);
        $debtor = $query->firstOrFail();
        $result = $debtor->toArray();
        return $result;
    }
}
