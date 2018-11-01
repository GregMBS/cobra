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
        return $resultAct->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return array
     */
    public function byGestorThisMonth() {
        $query = "select gestor,cliente,
sum(monto) as sm, sum(monto*confirmado) as smc
from pagos
where fecha>last_day(curdate()-interval 1 month)
group by gestor,cliente";
        $result = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
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
        return $resultActDet->fetchAll(\PDO::FETCH_ASSOC);
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
        return $resultAnt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return array
     */
    public function byGestorLastMonth() {
        $query = "select gestor,cliente,
sum(monto) as sm, sum(monto*confirmado) as smc
from pagos
where fecha<=last_day(curdate()-interval 1 month)
and fecha>last_day(curdate()-interval 2 month)
group by gestor,cliente";
        $result = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
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
        return $resultAntDet->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @param int $ID_CUENTA
     * @return array
     */
    public function getCuentaClienteFromID($ID_CUENTA) {
        $query = "SELECT numero_de_cuenta AS cuenta, cliente
FROM resumen 
WHERE id_cuenta=:id";
        $stc = $this->pdo->prepare($query);
        $stc->bindValue(':id', $ID_CUENTA, \PDO::PARAM_INT);
        $stc->execute();
        $result = $stc->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param int $ID_CUENTA
     * @return array
     */
    public function listPagos($ID_CUENTA) {
        $query = "SELECT fecha,monto,confirmado
FROM pagos
WHERE id_cuenta=:id
ORDER BY fecha";
        $sts = $this->pdo->prepare($query);
        $sts->bindValue(':id', $ID_CUENTA);
        $sts->execute();
        $row = $sts->fetchAll(\PDO::FETCH_ASSOC);
        return $row;
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
        if ($std) {
            return $std->fetchAll(\PDO::FETCH_ASSOC);
        }
        return [];
    }

    /**
     * 
     * @param string $capt
     * @param string $CUENTA
     * @return string
     */
    private function attributePayment($capt, $CUENTA) {
        $who = $capt;
        $query = "select c_cvge "
                . "from historia "
                . "where n_prom>0 "
                . "and c_cvge like 'PRO%' "
                . "and cuenta = :CUENTA "
                . "order by d_fech desc, c_hrin desc limit 1";
        $stn = $this->pdo->prepare($query);
        $stn->bindValue(':CUENTA', $CUENTA);
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
        $query = "INSERT IGNORE INTO pagos 
            (CUENTA,FECHA,MONTO,CLIENTE,GESTOR,CREDITO,ID_CUENTA) 
    SELECT :CUENTA, :FECHA, :MONTO, cliente, :who, numero_de_credito, id_cuenta 
    FROM resumen WHERE numero_de_cuenta = :CUENTA";
        $sti = $this->pdo->prepare($query);
        foreach ($pagos as $pago) {
            $who = $this->attributePayment('gmbs', $pago['CUENTA']);
            $sti->bindValue(':CUENTA', $pago['CUENTA']);
            $sti->bindValue(':FECHA', $pago['FECHA']);
            $sti->bindValue(':MONTO', $pago['MONTO']);
            $sti->bindValue(':who', $who);
            $sti->execute();
        }
    }

}
