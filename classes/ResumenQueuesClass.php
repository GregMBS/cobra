<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

/**
 * Description of ResumenQueuesClass
 *
 * @author gmbs
 */
class ResumenQueuesClass {

    /**
     * @var \PDO $pdo
     */
    protected $pdo;

    /**
     * 
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $capt
     * @param int $camp
     * @return array
     */
    public function getMyQueue($capt, $camp) {
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
    public function searchCount($field, $find) {
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
    public function prepareResumenMain($cliente, $sdc, $cr) {
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

        $querymain = "SELECT * FROM resumen 
join dictamenes on dictamen=status_aarsa 
WHERE locker is null
$clientStr
$sdcStr
$crStr
ORDER BY fecha_ultima_gestion LIMIT 1";

        if ($cr == 'SIN GESTION') {
            $querymain = "SELECT * FROM resumen " .
                    "WHERE locker is null " .
                    $clientStr . $sdcStr .
                    " AND ((status_aarsa='') or (status_aarsa is null)) " .
                    " ORDER BY saldo_total desc LIMIT 1";
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
            $querymain = "SELECT * FROM resumen
WHERE locker is null
 $clientStr
     $sdcStr
AND fecha_ultima_gestion<last_day(curdate()-interval 1 month)+interval 1 day
order by fecha_ultima_gestion  LIMIT 1
";
        }
    if ($cr == 'MANUAL') {
        $querymain = "select * from resumen
where locker is null
$clientStr
$sdcStr
and status_aarsa not in (
	select dictamen from dictamenes
	where queue in ('PAGOS','PROMESAS','ACLARACION')
	)
and especial > 0
order by (ejecutivo_asignado_call_center=:capt) desc, especial, saldo_descuento_1 desc limit 1";
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
    public function bindResumenMain($stm, $capt, $cliente, $sdc, $cr) {
        if (in_array($cr, array('MANUAL','INICIAL'))) {
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
     * @param int $id_cuenta
     * @return \PDOStatement
     */
    public function prepareQuicksearch($id_cuenta) {
        $querymain = "SELECT * FROM resumen WHERE id_cuenta = :id_cuenta LIMIT 1";
        $stm = $this->pdo->prepare($querymain);
        $stm->bindParam(':id_cuenta', $id_cuenta);
        return $stm;
    }

    /**
     * 
     * @param \PDOStatement $stm
     * @return array
     */
    public function runResumenMain($stm) {
        try {
            $stm->execute();
            $result = $stm->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\Exception $e) {
            return array();
        }
    }

}
