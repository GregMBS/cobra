<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

/**
 * Description of PagosClass
 *
 * @author gmbs
 */
class PagosClass {

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
     * @return array
     */
    public function queryOldSheet() {
        $queryDA = "select cuenta, fecha, monto,
                    pagos.cliente as 'cliente',
                    status_de_credito as 'sdc',
                    gestor, confirmado
from pagos, resumen
where fecha<=last_day(curdate()-interval 5 week)
and fecha>(last_day(curdate()-interval 5 week)) - interval 1 month
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

}
