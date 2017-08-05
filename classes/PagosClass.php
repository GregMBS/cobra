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
        $temp = array();
        $output = array();
        $result = $this->detailsThisMonth();
        foreach ($result as $row) {
            $gestor = strtolower($row['credit']);
            $cliente = strtoupper($row['cliente']);
            $temp[$gestor][$cliente]['gestor'] = $gestor;
            $temp[$gestor][$cliente]['cliente'] = $cliente;
            $temp[$gestor][$cliente]['sm'] += $row['monto'];
            $temp[$gestor][$cliente]['smc'] += $row['monto'] * $row['confirmado'];
        }
        foreach ($temp as $group) {
            foreach ($group as $row) {
                $output[] = $row;
            }
        }
        return $output;
    }

    /**
     * 
     * @return array
     */
    public function detailsThisMonth() {
        $queryActDet = "select cuenta, fecha, fechacapt, monto, cliente, 
            gestor, confirmado, id_cuenta
from pagos
where fecha>last_day(curdate()-interval 1 month)
order by cliente,gestor,fecha";
        $resultActDet = $this->pdo->query($queryActDet);
        $array = $resultActDet->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($array as $row) {
            $cuenta = $row['cuenta'];
            $cliente = $row['cliente'];
            $fechacapt = $row['fechacapt'];
            $row['credit'] = $this->assignCredit($cuenta, $cliente, $fechacapt);
            $output[] = $row;
        }

        return $output;
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
        $temp = array();
        $output = array();
        $result = $this->detailsLastMonth();
        foreach ($result as $row) {
            $gestor = strtolower($row['credit']);
            $cliente = strtoupper($row['cliente']);
            $temp[$gestor][$cliente]['gestor'] = $gestor;
            $temp[$gestor][$cliente]['cliente'] = $cliente;
            $temp[$gestor][$cliente]['sm'] += $row['monto'];
            $temp[$gestor][$cliente]['smc'] += $row['monto'] * $row['confirmado'];
        }
        foreach ($temp as $group) {
            foreach ($group as $row) {
                $output[] = $row;
            }
        }
        return $output;
    }

    /**
     * 
     * @return array
     */
    public function detailsLastMonth() {
        $output = array();
        $queryAntDet = "select cuenta, fecha, fechacapt, monto, cliente, 
            gestor, confirmado, id_cuenta
from pagos
where fecha<=last_day(curdate()-interval 1 month)
and fecha>last_day(curdate()-interval 2 month)
order by cliente,gestor,fecha";
        $resultAntDet = $this->pdo->query($queryAntDet);
        $array = $resultAntDet->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($array as $row) {
            $cuenta = $row['cuenta'];
            $cliente = $row['cliente'];
            $fechacapt = $row['fechacapt'];
            $row['credit'] = $this->assignCredit($cuenta, $cliente, $fechacapt);
            $output[] = $row;
        }

        return $output;
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
        $output = array();
        $queryDA = "select cuenta, fecha, fechacapt, monto,
                    pagos.cliente as 'cliente',
                    status_de_credito as 'sdc',
                    gestor, confirmado, pagos.id_cuenta
from pagos, resumen
where fecha>last_day(curdate()-interval 5 week)
and pagos.id_cuenta=resumen.id_cuenta
order by cliente,gestor,fecha";
        $std = $this->pdo->query($queryDA) or var_dump($this->pdo->errorInfo());
        if ($std) {
            $result = $std->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $cuenta = $row['cuenta'];
                $cliente = $row['cliente'];
                $fechacapt = $row['fechacapt'];
                $row['credit'] = $this->assignCredit($cuenta, $cliente, $fechacapt);
                $output[] = $row;
            }
        } else {
            die();
        }

        return $output;
    }

    /**
     * 
     * @return array
     */
    public function queryOldSheet() {
        $queryDA = "select cuenta, fecha, fechacapt, monto,
                    pagos.cliente as 'cliente',
                    status_de_credito as 'sdc',
                    gestor, confirmado, pagos.id_cuenta
from pagos, resumen
where fecha<=last_day(curdate()-interval 5 week)
and fecha>(last_day(curdate()-interval 5 week - interval 1 month))
and pagos.id_cuenta=resumen.id_cuenta
order by cliente,gestor,fecha";
        $std = $this->pdo->query($queryDA) or var_dump($this->pdo->errorInfo());
        if ($std) {
            $result = $std->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $cuenta = $row['cuenta'];
                $cliente = $row['cliente'];
                $fechacapt = $row['fechacapt'];
                $row['credit'] = $this->assignCredit($cuenta, $cliente, $fechacapt);
                $output[] = $row;
            }
        } else {
            die();
        }

        return $output;
    }

    /**
     * 
     * @param string $cuenta
     * @param string $cliente
     * @param string $fechacapt
     * @return string
     */
    private function assignCredit($cuenta, $cliente, $fechacapt) {
        $query = "SELECT c_cvge FROM historia  WHERE cuenta = :cuenta 
            AND c_cvba = :cliente
                AND d_fech <= :fechacapt  AND n_prom > 0 
                ORDER by d_fech desc, c_hrin desc 
                LIMIT 1";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':cuenta', $cuenta);
        $stq->bindParam(':cliente', $cliente);
        $stq->bindParam(':fechacapt', $fechacapt);
        $stq->execute();
        $result = $stq->fetch(\PDO::FETCH_ASSOC);
        return $result['c_cvge'];
    }

}
