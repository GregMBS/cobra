<?php

namespace cobra_salsa;

use PDO;
use PDOStatement;

require_once 'classes/ResumenObject.php';
require_once 'classes/PagosObject.php';
require_once 'classes/PagosumObject.php';
require_once 'classes/PagosQueryObject.php';
require_once 'classes/HistoriaObject.php';

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
    protected PDO $pdo;

    /**
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     *
     * @return array
     */
    public function byGestorThisMonth(): array
    {
        $temp = array();
        $output = array();
        $result = $this->detailsThisMonth();
        return $this->buildRows($result, $temp, $output);
    }

    /**
     *
     * @return PagosQueryObject[]
     */
    public function detailsThisMonth(): array
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
        $array = $resultActDet->fetchAll(PDO::FETCH_CLASS, PagosQueryObject::class);
        return $this->buildDetails($array, $output);
    }

    /**
     * @param PagosQueryObject[] $data
     * @param array $output
     * @return array
     */
    private function buildDetails(array $data, array $output): array
    {
        foreach ($data as $row) {
            $cuenta = $row->cuenta;
            $cliente = $row->cliente;
            $fechaPago = $row->fecha;
            $row->credit = $this->assignCredit($cuenta, $cliente, $fechaPago);
            $output[] = $row;
        }

        return $output;
    }

    /**
     *
     * @param string $cuenta
     * @param string $cliente
     * @param string $fechaPago
     * @return string
     */
    private function assignCredit(string $cuenta, string $cliente, string $fechaPago): string
    {
        $queryId = "select id_cuenta from resumen 
                where numero_de_cuenta = :cuenta
                and cliente = :cliente";
        $stq = $this->pdo->prepare($queryId);
        $stq->bindParam(':cuenta', $cuenta);
        $stq->bindParam(':cliente', $cliente);
        $stq->execute();
        $resultC = $stq->fetch(PDO::FETCH_ASSOC);
        $id_cuenta = $resultC['id_cuenta'];

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
        $result = $stp->fetchObject(HistoriaObject::class);
        if ($result) {
            return $result->C_CVGE;
        }
        return '';
    }

    /**
     * @param PagosQueryObject[] $result
     * @param array $temp
     * @param array $output
     * @return array
     */
    private function buildRows(array $result, array $temp, array $output): array
    {
        foreach ($result as $row) {
            $gestor = strtolower($row->credit);
            $cliente = strtoupper($row->cliente);
            $temp[$gestor][$cliente]['gestor'] = $gestor;
            $temp[$gestor][$cliente]['cliente'] = $cliente;
            if (isset($temp[$gestor][$cliente]['sm'])) {
                $temp[$gestor][$cliente]['sm'] += $row->monto;
            } else {
                $temp[$gestor][$cliente]['sm'] = $row->monto;
            }
            if (isset($temp[$gestor][$cliente]['smc'])) {
                $temp[$gestor][$cliente]['smc'] += $row->monto * $row->confirmado;
            } else {
                $temp[$gestor][$cliente]['smc'] = $row->monto * $row->confirmado;
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
     *
     * @return PagosumObject[]
     */
    public function summaryThisMonth(): array
    {
        $query = "select pagos.cliente as cli, status_de_credito as sdc,
	sum(monto) as sm, sum(monto*confirmado) as smc
from pagos join resumen using (id_cuenta)
where fecha>last_day(curdate()-interval 1 month)
and status_de_credito not regexp '-'
group by cli, sdc with rollup";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS, PagosumObject::class);
    }

    /**
     *
     * @return PagosumObject[]
     */
    public function summaryLastMonth(): array
    {
        $query = "select pagos.cliente as cli, status_de_credito as sdc,
	sum(monto) as sm, sum(monto*confirmado) as smc
from pagos join resumen using (id_cuenta)
where fecha<=last_day(curdate()-interval 1 month)
and fecha>last_day(curdate()-interval 2 month)
and status_de_credito not regexp '-'
group by cli, sdc with rollup";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS, PagosumObject::class);
    }

    /**
     *
     * @return array
     */
    public function byGestorLastMonth(): array
    {
        $temp = array();
        $output = array();
        $result = $this->detailsLastMonth();
        return $this->buildRows($result, $temp, $output);
    }

    /**
     *
     * @return PagosQueryObject[]
     */
    public function detailsLastMonth(): array
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
        $data = $resultAntDet->fetchAll(PDO::FETCH_CLASS, PagosQueryObject::class);
        return $this->buildDetails($data, $output);
    }

    /**
     *
     * @param int $ID_CUENTA
     * @return ResumenObject
     */
    public function getCuentaClienteFromID(int $ID_CUENTA): ResumenObject
    {
        $query = "SELECT *
FROM resumen 
WHERE id_cuenta=:id";
        $stc = $this->pdo->prepare($query);
        $stc->bindParam(':id', $ID_CUENTA, PDO::PARAM_INT);
        $stc->execute();
        $result = $stc->fetchObject(ResumenObject::class);
        if ($result) {
            return $result;
        }
        return new ResumenObject();
    }

    /**
     *
     * @param int $ID_CUENTA
     * @return PagosObject[]
     */
    public function listPagos(int $ID_CUENTA): array
    {
        $query = "SELECT *
FROM pagos
WHERE id_cuenta=:id
ORDER BY fecha";
        $sts = $this->pdo->prepare($query);
        $sts->bindParam(':id', $ID_CUENTA);
        $sts->execute();
        return $sts->fetchAll(PDO::FETCH_CLASS, PagosObject::class);
    }

    /**
     *
     * @return PagosQueryObject[]
     */
    public function querySheet(): array
    {
        $output = array();
        $queryDA = "select cuenta, fecha, fechacapt, monto,
                    pagos.cliente as 'cliente',
                    status_de_credito as 'sdc',
                    gestor, confirmado, pagos.id_cuenta
from pagos, resumen
where fecha>last_day(curdate()-interval 5 week)
and pagos.id_cuenta=resumen.id_cuenta
order by cliente,gestor,fecha";
        return $this->buildSheet($queryDA, $output);
    }

    /**
     * @param string $queryDA
     * @param PagosQueryObject[] $output
     * @return array
     */
    private function buildSheet(string $queryDA, array $output): array
    {
        $std = $this->pdo->query($queryDA);
        return $this->sheetLoop($std, $output);
    }

    /**
     * @param PDOStatement $std
     * @param array $output
     * @return array
     */
    private function sheetLoop(PDOStatement $std, array $output): array
    {
        $result = $std->fetchAll(PDO::FETCH_CLASS, PagosQueryObject::class);
        /** @var PagosQueryObject $row */
        foreach ($result as $row) {
            $cuenta = $row->cuenta;
            $cliente = $row->cliente;
            $fechapago = $row->fecha;
            $row->credit = $this->assignCredit($cuenta, $cliente, $fechapago);
            $output[] = (array)$row;
        }
        return $output;
    }

    /**
     *
     * @param string $start
     * @param string $end
     * @param string $cliente
     * @return string[]
     */
    public function queryAll(string $start, string $end, string $cliente): array
    {
        $output = array();
        $startQuery = " ";
        $endQuery = " ";
        $clienteQuery = " ";
        if (!empty($start)) {
            $startQuery = " and fecha >= :start ";
        }
        if (!empty($end)) {
            $endQuery = " and fecha <= :end ";
        }
        if ($cliente !== "todos") {
            $clienteQuery = " and pagos.cliente = :cliente ";
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
        if ($cliente !== "todos") {
            $std->bindParam(':cliente', $cliente);
        }
        $std->execute();
        return $this->sheetLoop($std, $output);
    }

    /**
     *
     * @return PagosQueryObject[]
     */
    public function queryOldSheet(): array
    {
        $output = array();
        $queryDA = "select cuenta, fecha, fechacapt, monto,
                    pagos.cliente as 'cliente',
                    status_de_credito as 'sdc',
                    gestor, confirmado, pagos.id_cuenta
from pagos, resumen
where fecha<=last_day(curdate()-interval 5 week)
and fecha>(last_day(curdate()-interval 5 week - interval 1 month))
and pagos.id_cuenta=resumen.id_cuenta
order by cliente,gestor,fecha";
        return $this->buildSheet($queryDA, $output);
    }

    /**
     *
     * @return array
     */
    public function listClientes(): array
    {
        $query = "SELECT DISTINCT cliente FROM pagos 
                    ORDER BY cliente
                    LIMIT 1000";
        $stc = $this->pdo->query($query);
        $result = $stc->fetchAll(PDO::FETCH_ASSOC);
        return array_column($result, 'cliente');
    }

}
