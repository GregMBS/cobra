<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of PagosClass
 *
 * @author gmbs
 */
class PagosClass extends BaseClass {

    /**
     * 
     * @return array
     */
    public function summaryThisMonth() {
        $queryAct = "select pagos.cliente as cli, status_de_credito as sdc,
	sum(monto) as sm, sum(monto*confirmado) as smc
from pagos join resumen using (id_cuenta)
where fecha>last_day(curdate()-interval 1 month)
and status_de_credito not like '%vo'
group by cli, sdc with rollup";
        $resultAct = $this->pdo->query($queryAct);
        return $resultAct;
    }

    /**
     * 
     * @return array
     */
    public function byGestorThisMonth() {
        $queryActGest = "select gestor,cliente,
sum(monto) as sm, sum(monto*confirmado) as smc
from pagos
where fecha>last_day(curdate()-interval 1 month)
group by gestor,cliente";
        $resultActGest = $this->pdo->query($queryActGest);
        return $resultActGest;
    }

    /**
     * 
     * @return array
     */
    public function detailsThisMonth() {
        $queryActDet = "select cuenta, fecha, monto, cliente, gestor, confirmado
from pagos
where fecha>last_day(curdate()-interval 1 month)
order by cliente,gestor,fecha";
        $resultActDet = $this->pdo->query($queryActDet);
        return $resultActDet;
    }

    /**
     * 
     * @return array
     */
    public function summaryLastMonth() {
        $queryAnt = "select pagos.cliente as cli, status_de_credito as sdc,
	sum(monto) as sm, sum(monto*confirmado) as smc
from pagos join resumen using (id_cuenta)
where fecha<=last_day(curdate()-interval 1 month)
and fecha>last_day(curdate()-interval 2 month)
and status_de_credito not like '%vo'
group by cli, sdc with rollup";
        $resultAnt = $this->pdo->query($queryAnt);
        return $resultAnt;
    }

    /**
     * 
     * @return array
     */
    public function byGestorLastMonth() {
        $queryAntGest = "select gestor,cliente,
sum(monto) as sm, sum(monto*confirmado) as smc
from pagos
where fecha<=last_day(curdate()-interval 1 month)
and fecha>last_day(curdate()-interval 2 month)
group by gestor,cliente";
        $resultAntGest = $this->pdo->query($queryAntGest);
        return $resultAntGest;
    }

    /**
     * 
     * @return array
     */
    public function detailsLastMonth() {
        $queryAntDet = "select cuenta, fecha, monto, cliente, gestor, confirmado
from pagos
where fecha<=last_day(curdate()-interval 1 month)
and fecha>last_day(curdate()-interval 2 month)
order by cliente,gestor,fecha";
        $resultAntDet = $this->pdo->query($queryAntDet);
        return $resultAntDet;
    }

    /**
     * 
     * @param int $ID_CUENTA
     * @return array
     */
    public function getCuentaClienteFromID($ID_CUENTA) {
        $querycc = "SELECT numero_de_cuenta, cliente
FROM resumen 
WHERE id_cuenta=:id";
        $stc = $this->pdo->prepare($querycc);
        $stc->bindParam(':id', $ID_CUENTA, \PDO::PARAM_INT);
        $stc->execute();
        $resultcc = $stc->fetch(\PDO::FETCH_ASSOC);
        return $resultcc;
    }

    /**
     * 
     * @param int $ID_CUENTA
     * @return array
     */
    public function listPagos($ID_CUENTA) {
        $querysub = "SELECT fecha,monto,confirmado
FROM pagos
WHERE id_cuenta=:id
ORDER BY fecha";
        $sts = $this->pdo->prepare($querysub);
        $sts->bindParam(':id', $ID_CUENTA);
        $sts->execute();
        $rowsub = $sts->fetchAll(\PDO::FETCH_ASSOC);
        return $rowsub;
    }

    /**
     * 
     * @return array
     */
    public function querySheet() {
        $queryDA = "select cuenta, fecha, monto,
                    pagos.cliente as 'cliente',
                    status_de_credito as 'sdc',
                    gestor, confirmado
from pagos, resumen
where fecha>last_day(curdate()-interval 5 week)
and pagos.id_cuenta=resumen.id_cuenta
order by cliente,gestor,fecha";
        $std = $this->pdo->query($queryDA);
        if (!$std) {
            $result = array();
        } else {
            $result = $std->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $result;
    }

    /**
     * 
     */
    private function updateAllUltimoPagos() {
        $querypup = "update resumen,pagos 
                set fecha_de_ultimo_pago = fecha, monto_ultimo_pago = monto 
                where fecha_de_ultimo_pago<fecha and pagos.id_cuenta=resumen.id_cuenta;";
        $this->pdo->query($querypup);
    }

    /**
     * 
     * @param string $capt
     * @param string $CUENTA
     * @return string
     */
    private function attributePayment($capt, $CUENTA) {
        $who = $capt;
        $queryd = "select c_cvge "
                . "from historia "
                . "where n_prom>0 "
                . "and c_cvge like 'PRO%' "
                . "and cuenta = :CUENTA "
                . "order by d_fech desc, c_hrin desc limit 1";
        $stn = $this->pdo->prepare($queryd);
        $stn->bindParam(':CUENTA', $CUENTA);
        $stn->execute();
        $result = $stn->fetch(\PDO::FETCH_ASSOC);
        if (isset($result['c_cvge'])) {
            $who = $result['c_cvge'];
        }
        return $who;
    }

    /**
     * 
     * @param array $pagos
     */
    public function addBulkPagos($pagos) {
        $queryins = "INSERT IGNORE INTO pagos 
            (CUENTA,FECHA,MONTO,CLIENTE,GESTOR,CREDITO,ID_CUENTA) 
    SELECT :CUENTA, :FECHA, :MONTO, cliente, :who, numero_de_credito, id_cuenta 
    FROM resumen WHERE numero_de_cuenta = :CUENTA";
        $sti = $this->pdo->prepare($queryins);
        foreach ($pagos as $pago) {
            $who = $this->attributePayment('gmbs', $pago['CUENTA']);
            $sti->bindParam(':CUENTA', $pago['CUENTA']);
            $sti->bindParam(':FECHA', $pago['FECHA']);
            $sti->bindParam(':MONTO', $pago['MONTO']);
            $sti->bindParam(':who', $who);
            $sti->execute();
        }
    }

}
