<?php

namespace cobra_salsa;

use DateTime;
use DateInterval;
use DatePeriod;
use PDO;

require_once 'classes/VisitSheetObject.php';
require_once 'classes/UserDataObject.php';

/**
 * Description of CheckClass
 *
 * @author gmbs
 */
class CheckClass extends BaseClass {

    /**
     *
     * @param string $CUENTA
     * @return int
     */
    public function getIdCuentaFromCuenta(string $CUENTA): int
    {
        $id_cuenta = 0;
        $query = "select id_cuenta from resumen
where numero_de_cuenta=:cuenta
and status_de_credito not regexp '-' LIMIT 1";
        $stc = $this->pdo->prepare($query);
        $stc->bindParam(':cuenta', $CUENTA);
        $stc->execute();
        $result = $stc->fetch(PDO::FETCH_NUM);
        if ($result) {
            $id_cuenta = (int) $result[0];
        }
        return $id_cuenta;
    }

    /**
     *
     * @param int $id_cuenta
     * @return string
     */
    public function getCuentaFromIdCuenta(int $id_cuenta): string
    {
        $query = "select numero_de_cuenta from resumen
where id_cuenta=:id_cuenta
and status_de_credito not regexp '-' LIMIT 1";
        $stc = $this->pdo->prepare($query);
        $stc->bindParam(':id_cuenta', $id_cuenta);
        $stc->execute();
        $result = $stc->fetch(PDO::FETCH_ASSOC);
        if (is_string($result['numero_de_cuenta'])) {
            return $result['numero_de_cuenta'];
        }
        return (string)$result['numero_de_cuenta'];
    }

    /**
     *
     * @param string $CUENTA
     * @param string $gestor
     * @param string $fechaOut
     * @param int $ID_CUENTA
     */
    public function insertVasignBoth(string $CUENTA, string $gestor, string $fechaOut, int $ID_CUENTA): void
    {
        $query = "INSERT INTO vasign (cuenta, gestor, fechaout, fechain, c_cont)
VALUES (:cuenta, :gestor, :fechaout, now(), :idc)";
        $sti = $this->pdo->prepare($query);
        $sti->bindParam(':cuenta', $CUENTA);
        $sti->bindParam(':gestor', $gestor);
        $sti->bindParam(':fechaout', $fechaOut);
        $sti->bindParam(':id_cuenta', $ID_CUENTA);
        $sti->execute();
    }

    /**
     *
     * @param string $CUENTA
     * @param string $gestor
     * @param int $ID_CUENTA
     */
    public function insertVasign(string $CUENTA, string $gestor, int $ID_CUENTA): void
    {
        $query = "INSERT INTO vasign
			(cuenta, gestor, fechaout,c_cont)
			VALUES
			(:cuenta, :gestor, now(), :id_cuenta)";
        $sti = $this->pdo->prepare($query);
        $sti->bindParam(':cuenta', $CUENTA);
        $sti->bindParam(':gestor', $gestor);
        $sti->bindParam(':id_cuenta', $ID_CUENTA);
        $sti->execute();
    }

    /**
     *
     * @return UserDataObject[]
     */
    public function getVisitadores(): array
    {
        $query = "SELECT * FROM nombres where completo<>''
and tipo IN ('visitador','admin')";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS, UserDataObject::class);
    }

    /**
     *
     * @return string[]
     */
    public function getOneMonth(): array
    {
        $output = array();
        $end = new DateTime();
        $begin = new DateTime();
        $oneMonth = new DateInterval('P1M');
        $begin->sub($oneMonth);
        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($begin, $interval, $end);
        foreach ($dateRange as $date) {
            $output[] = $date->format("Y-m-d");
        }
        return $output;
    }

    /**
     *
     * @param string $gestor
     * @return array
     */
    public function countInOut(string $gestor): array
    {
        $query = "select sum(fechaout>curdate()) as countOut,
    sum(fechain>curdate()) as countIn
    from vasign
where gestor=:gestor";
        $stc = $this->pdo->prepare($query);
        $stc->bindParam(':gestor', $gestor);
        $stc->execute();
        return $stc->fetch(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $gestor
     * @return VisitSheetObject[]
     */
    public function listVasign(string $gestor = ''): array
    {
        $gString = 'order by gestor, fechaIn DESC, fechaout DESC, numero_de_cuenta';
        if (!empty($gestor)) {
            $gString = "WHERE gestor = :gestor 
            ORDER BY fechaIn DESC";
        }

        $queryMain = "select id_cuenta, numero_de_cuenta, nombre_deudor, cliente, saldo_total,
queue, completo, fechaout, fechain, gestor
from resumen
join vasign on id_cuenta=c_cont
join nombres on iniciales=gestor
join dictamenes on dictamen = status_aarsa " . $gString;
        $stm = $this->pdo->prepare($queryMain);
        if (!empty($gestor)) {
            $stm->bindValue(':gestor', $gestor);
        }
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS, VisitSheetObject::class);
    }

    /**
     *
     * @param string $vst
     * @return string
     */
    public function getCompleto(string $vst): string
    {
        $query = "SELECT completo FROM nombres
where iniciales=:vst
limit 1";
        $stn = $this->pdo->prepare($query);
        $stn->bindParam(':vst', $vst);
        $stn->execute();
        $result = $stn->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['completo'];
        }
        return '';
    }

    /**
     *
     * @param string $tipo
     * @param string $CUENTA
     */
    public function updateVasign(string $tipo, string $CUENTA): void
    {
        $queryCuenta = "select id_cuenta from resumen where numero_de_cuenta = :cuenta";
        if ($tipo === 'id_cuenta') {
            $queryCuenta = "select id_cuenta from resumen where id_cuenta = :cuenta";
        }
        $stc = $this->pdo->prepare($queryCuenta);
        $stc->bindParam(':cuenta', $CUENTA);
        $stc->execute();
        $resultCuenta = $stc->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultCuenta as $answerCuenta) {
            $C_CONT = $answerCuenta['id_cuenta'];
        }
        $query = "update vasign set fechain=now()
	where c_cont = :id_cuenta
	and fechain is null
	limit 1";
        $sti = $this->pdo->prepare($query);
        $sti->bindParam(':id_cuenta', $C_CONT);
        $sti->execute();
    }
}
