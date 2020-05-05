<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use PDO;
use PDOStatement;

/**
 * Description of PagosClass
 *
 * @author gmbs
 */
class PagosClass
{

    /**
     * @var PDO $pdo
     */
    protected $pdo;

    /**
     *
     * @param PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     *
     * @return false|PDOStatement
     */
    public function summaryThisMonth()
    {
        $queryAct = "select pagos.cliente as cli, status_de_credito as sdc,
	sum(monto) as sm, sum(monto*confirmado) as smc
from pagos join resumen using (id_cuenta)
where fecha>last_day(curdate()-interval 1 month)
and status_de_credito not like '%vo'
group by cli, sdc with rollup";
        return $this->pdo->query($queryAct);
    }

    /**
     *
     * @return array
     */
    public function byGestorThisMonth()
    {
        $temp = array();
        $output = array();
        $result = $this->detailsThisMonth();
        return $this->buildRow($result, $temp, $output);
    }

    /**
     *
     * @return array
     */
    public function detailsThisMonth()
    {
        $output = array();
        $queryActDet = "select cuenta, fecha, monto, pagos.cliente, 
            status_de_credito as sdc, 
            gestor, confirmado, fechacapt, pagos.id_cuenta 
from pagos,resumen
where fecha>last_day(curdate()-interval 1 month)
and pagos.id_cuenta = resumen.id_cuenta
order by cliente,gestor,fecha";
        $resultActDet = $this->pdo->query($queryActDet);
        $array = $resultActDet->fetchAll(PDO::FETCH_ASSOC);
        return $this->buildDetails($array, $output);
    }

    /**
     *
     * @return false|PDOStatement
     */
    public function summaryLastMonth()
    {
        $queryAnt = "select pagos.cliente as cli, status_de_credito as sdc,
	sum(monto) as sm, sum(monto*confirmado) as smc
from pagos join resumen using (id_cuenta)
where fecha<=last_day(curdate()-interval 1 month)
and fecha>last_day(curdate()-interval 2 month)
and status_de_credito not like '%vo'
group by cli, sdc with rollup";
        return $this->pdo->query($queryAnt);
    }

    /**
     *
     * @return array
     */
    public function byGestorLastMonth()
    {
        $temp = array();
        $output = array();
        $result = $this->detailsLastMonth();
        return $this->buildRow($result, $temp, $output);
    }

    /**
     *
     * @return array
     */
    public function detailsLastMonth()
    {
        $output = array();
        $queryAntDet = "select cuenta, fecha, monto, pagos.cliente, 
            status_de_credito as 'sdc', 
            gestor, confirmado, fechacapt, pagos.id_cuenta
from pagos
join resumen using (id_cuenta)
where fecha<=last_day(curdate()-interval 1 month)
and fecha>last_day(curdate()-interval 2 month)
order by cliente,gestor,fecha";
        $resultAntDet = $this->pdo->query($queryAntDet);
        $array = $resultAntDet->fetchAll(PDO::FETCH_ASSOC);
        return $this->buildDetails($array, $output);
    }

    /**
     *
     * @param int $ID_CUENTA
     * @return array
     */
    public function getCuentaClienteFromID($ID_CUENTA)
    {
        $query = "SELECT numero_de_cuenta, cliente
FROM resumen 
WHERE id_cuenta=:id";
        $stc = $this->pdo->prepare($query);
        $stc->bindParam(':id', $ID_CUENTA, PDO::PARAM_INT);
        $stc->execute();
        return $stc->fetch(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param int $ID_CUENTA
     * @return array
     */
    public function listPagos($ID_CUENTA)
    {
        $query = "SELECT fecha,monto,confirmado
FROM pagos
WHERE id_cuenta=:id
ORDER BY fecha";
        $sts = $this->pdo->prepare($query);
        $sts->bindParam(':id', $ID_CUENTA);
        $sts->execute();
        return $sts->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @return array
     */
    public function querySheet()
    {
        $query = "select cuenta, fecha, fechacapt, monto,
                    pagos.cliente as 'cliente',
                    status_de_credito as 'sdc',
                    gestor, confirmado, pagos.id_cuenta
from pagos, resumen
where fecha>last_day(curdate()-interval 5 week)
and pagos.id_cuenta=resumen.id_cuenta
order by cliente,gestor,fecha";
        return $this->buildCredit($query);
    }

    /**
     *
     * @param string $start
     * @param string $end
     * @param string $cliente
     * @return string[][]
     */
    public function queryAll($start, $end, $cliente)
    {
        if (!empty($start)) {
            $startQuery = " and fecha >= :start ";
        } else {
            $startQuery = " ";
        }
        if (!empty($end)) {
            $endQuery = " and fecha <= :end ";
        } else {
            $endQuery = " ";
        }
        if ($cliente != "todos") {
            $clienteQuery = " and pagos.cliente = :cliente ";
        } else {
            $clienteQuery = " ";
        }
        $query = "select cuenta, fecha, fechacapt, monto,
                    pagos.cliente as 'cliente',
                    status_de_credito as 'sdc',
                    gestor, confirmado, pagos.id_cuenta
from pagos, resumen
where pagos.id_cuenta=resumen.id_cuenta 
$startQuery
$endQuery
$clienteQuery
order by cliente,gestor,fecha";
        $std = $this->pdo->prepare($query);
        if (!empty($start)) {
            $std->bindParam(':start', $start);
        }
        if (!empty($end)) {
            $std->bindParam(':end', $end);
        }
        if ($cliente != "todos") {
            $std->bindParam(':cliente', $cliente);
        }
        $std->execute();
        return $this->getCreditSub($std);
    }

    /**
     *
     * @return array
     */
    public function queryOldSheet()
    {
        $query = "select cuenta, fecha, fechacapt, monto,
                    pagos.cliente as 'cliente',
                    status_de_credito as 'sdc',
                    gestor, confirmado, pagos.id_cuenta
from pagos, resumen
where fecha<=last_day(curdate()-interval 5 week)
and fecha>(last_day(curdate()-interval 5 week - interval 1 month))
and pagos.id_cuenta=resumen.id_cuenta
order by cliente,gestor,fecha";
        return $this->buildCredit($query);
    }

    /**
     *
     * @param string $cuenta
     * @param string $cliente
     * @param string $fechaPago
     * @return string
     */
    private function assignCredit($cuenta, $cliente, $fechaPago)
    {
        $queryID = "select id_cuenta from resumen 
                where numero_de_cuenta = :cuenta
                and cliente = :cliente";
        $stq = $this->pdo->prepare($queryID);
        $stq->bindParam(':cuenta', $cuenta);
        $stq->bindParam(':cliente', $cliente);
        $stq->execute();
        $resultc = $stq->fetch(PDO::FETCH_ASSOC);
        $id_cuenta = $resultc['id_cuenta'];

        $query = "SELECT * FROM historia 
            WHERE c_cont= :id_cuenta
                AND d_fech <= :fechapago 
                AND n_prom > 0
                order by auto desc
                limit 1";
        $stp = $this->pdo->prepare($query);
        $stp->bindParam(':id_cuenta', $id_cuenta);
        $stp->bindParam(':fechapago', $fechaPago);
        $stp->execute();
        $result = $stp->fetch(PDO::FETCH_ASSOC);
        return $result['C_CVGE'];
    }

    /**
     *
     * @return array
     */
    public function listClientes()
    {
        $query = "SELECT DISTINCT cliente FROM pagos 
                    ORDER BY cliente
                    LIMIT 1000";
        $stc = $this->pdo->prepare($query);
        $stc->execute();
        return $stc->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * @param array $result
     * @param array $temp
     * @param array $output
     * @return array
     */
    private function buildRow(array $result, array $temp, array $output)
    {
        foreach ($result as $row) {
            $gestor = strtolower($row['credit']);
            $cliente = strtoupper($row['cliente']);
            $temp[$gestor][$cliente]['gestor'] = $gestor;
            $temp[$gestor][$cliente]['cliente'] = $cliente;
            if (isset($temp[$gestor][$cliente]['sm'])) {
                $temp[$gestor][$cliente]['sm'] += $row['monto'];
            } else {
                $temp[$gestor][$cliente]['sm'] = $row['monto'];
            }
            if (isset($temp[$gestor][$cliente]['smc'])) {
                $temp[$gestor][$cliente]['smc'] += $row['monto'] * $row['confirmado'];
            } else {
                $temp[$gestor][$cliente]['smc'] = $row['monto'] * $row['confirmado'];
            }
        }
        foreach ($temp as $group) {
            foreach ($group as $row) {
                $output[] = $row;
            }
        }
        return $output;
    }

    /**
     * @param array $array
     * @param array $output
     * @return array
     */
    private function buildDetails(array $array, array $output)
    {
        foreach ($array as $row) {
            $cuenta = $row['cuenta'];
            $cliente = $row['cliente'];
            $fechaPago = $row['fecha'];
            $row['credit'] = $this->assignCredit($cuenta, $cliente, $fechaPago);
            $output[] = $row;
        }

        return $output;
    }

    /**
     * @param string $query
     * @return array
     */
    private function buildCredit($query)
    {
        $std = $this->pdo->query($query) or var_dump($this->pdo->errorInfo());
        return $this->getCreditSub($std);
    }

    /**
     * @param PDOStatement $std
     * @return array
     */
    private function getCreditSub(PDOStatement $std)
    {
        $output = [];
        if ($std) {
            $result = $std->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $cuenta = $row['cuenta'];
                $cliente = $row['cliente'];
                $fechaPago = $row['fecha'];
                $row['credit'] = $this->assignCredit($cuenta, $cliente, $fechaPago);
                $output[] = $row;
            }
        }
        return $output;
    }

}
