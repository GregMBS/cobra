<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of PaymentsClass
 *
 * @author gmbs
 */
class PaymentsClass extends BaseClass {

    /**
     * 
     * @return array
     */
    public function summaryThisMonth() {
        $query = "select pagos.cliente as cli, status_de_credito as sdc,
	sum(monto) as sm, sum(monto*confirmado) as smc
from pagos join resumen using (id_cuenta)
where fecha>last_day(curdate()-interval 1 month)
and status_de_credito not like '%vo'
group by cli, sdc with rollup";
        $result = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return array
     */
    public function byAgentThisMonth() {
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
        $query = "select cuenta, fecha, monto, cliente, gestor, confirmado
from pagos
where fecha>last_day(curdate()-interval 1 month)
order by cliente,gestor,fecha";
        $result = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return array
     */
    public function summaryLastMonth() {
        $query = "select pagos.cliente as cli, status_de_credito as sdc,
	sum(monto) as sm, sum(monto*confirmado) as smc
from pagos join resumen using (id_cuenta)
where fecha<=last_day(curdate()-interval 1 month)
and fecha>last_day(curdate()-interval 2 month)
and status_de_credito not like '%vo'
group by cli, sdc with rollup";
        $result = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return array
     */
    public function byAgentLastMonth() {
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
        $query = "select cuenta, fecha, monto, cliente, gestor, confirmado
from pagos
where fecha<=last_day(curdate()-interval 1 month)
and fecha>last_day(curdate()-interval 2 month)
order by cliente,gestor,fecha";
        $result = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @param int $id
     * @return array
     */
    public function getAccountClientFromID($id) {
        $query = "SELECT numero_de_cuenta AS cuenta, cliente
FROM resumen 
WHERE id_cuenta=:id";
        $stc = $this->pdo->prepare($query);
        $stc->bindValue(':id', $id, \PDO::PARAM_INT);
        $stc->execute();
        $result = $stc->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param int $id
     * @return array
     */
    public function listPayments($id) {
        $query = "SELECT fecha,monto,confirmado
FROM pagos
WHERE id_cuenta=:id
ORDER BY fecha";
        $sts = $this->pdo->prepare($query);
        $sts->bindValue(':id', $id);
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
     * @param string $account
     * @return string
     */
    private function attributePayment($capt, $account) {
        $who = $capt;
        $query = "select c_cvge from historia 
where n_prom>0 and c_cvge like 'PRO%' and cuenta = :account 
order by d_fech desc, c_hrin desc limit 1";
        $stn = $this->pdo->prepare($query);
        $stn->bindValue(':account', $account);
        $stn->execute();
        $result = $stn->fetch(\PDO::FETCH_ASSOC);
        if (isset($result['c_cvge'])) {
            $who = $result['c_cvge'];
        }
        return $who;
    }

    /**
     * 
     * @param array $payments
     */
    public function addBulkPayments($payments) {
        $query = "INSERT IGNORE INTO pagos 
            (CUENTA,FECHA,MONTO,CLIENTE,GESTOR,CREDITO,ID_CUENTA) 
    SELECT :CUENTA, :FECHA, :MONTO, cliente, :who, numero_de_credito, id_cuenta 
    FROM resumen WHERE numero_de_cuenta = :CUENTA";
        $sti = $this->pdo->prepare($query);
        foreach ($payments as $pay) {
            $who = $this->attributePayment('gmbs', $pay['CUENTA']);
            $sti->bindValue(':CUENTA', $pay['CUENTA']);
            $sti->bindValue(':FECHA', $pay['FECHA']);
            $sti->bindValue(':MONTO', $pay['MONTO']);
            $sti->bindValue(':who', $who);
            $sti->execute();
        }
    }

}
