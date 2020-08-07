<?php

namespace cobra_salsa;

use DateTime;
use DateInterval;
use DatePeriod;
use PDO;

require_once __DIR__ . '/VisitSheetObject.php';

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
    public function getIdCuentaFromCuenta($CUENTA) {
        $query = "select id_cuenta from resumen
where numero_de_cuenta=:cuenta
and status_de_credito not regexp '-' LIMIT 1";
        $stc = $this->pdo->prepare($query);
        $stc->bindParam(':cuenta', $CUENTA);
        $stc->execute();
        $result = $stc->fetch(PDO::FETCH_ASSOC);
        if (isset($result['id_cuenta'])) {
            $id_cuenta = $result['id_cuenta'];
        } else {
            $id_cuenta = 0;
        }
        return $id_cuenta;
    }

    /**
     *
     * @param int $id_cuenta
     * @return string
     */
    public function getCuentaFromIdCuenta($id_cuenta) {
        $query = "select numero_de_cuenta from resumen
where id_cuenta=:id_cuenta
and status_de_credito not regexp '-' LIMIT 1";
        $stc = $this->pdo->prepare($query);
        $stc->bindParam(':id_cuenta', $id_cuenta);
        $stc->execute();
        $result = $stc->fetch(PDO::FETCH_ASSOC);
        if (isset($result['numero_de_cuenta'])) {
            $numero_de_cuenta = $result['numero_de__cuenta'];
        } else {
            $numero_de_cuenta = '';
        }
        return $numero_de_cuenta;
    }

    /**
     *
     * @param string $CUENTA
     * @param string $gestor
     * @param string $fechaout
     * @param int $ID_CUENTA
     */
    public function insertVasignBoth($CUENTA, $gestor, $fechaout, $ID_CUENTA) {
        $query = "INSERT INTO vasign (cuenta, gestor, fechaout, fechain, c_cont)
VALUES (:cuenta, :gestor, :fechaout, now(), :idc)";
        $sti = $this->pdo->prepare($query);
        $sti->bindParam(':cuenta', $CUENTA);
        $sti->bindParam(':gestor', $gestor);
        $sti->bindParam(':fechaout', $fechaout);
        $sti->bindParam(':id_cuenta', $ID_CUENTA);
        $sti->execute();
    }

    /**
     *
     * @param string $CUENTA
     * @param string $gestor
     * @param int $ID_CUENTA
     */
    public function insertVasign($CUENTA, $gestor, $ID_CUENTA) {
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
    public function getVisitadores() {
        $query = "SELECT * FROM nombres where completo<>''
and tipo IN ('visitador','admin')";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS, UserDataObject::class);
    }

    /**
     *
     * @return array
     */
    public function getOneMonth() {
        $output = array();
        $end = new DateTime();
        $begin = $end->modify('-1 month');

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
    public function countInOut($gestor) {
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
    public function listVasign($gestor) {
        if (!empty($gestor)) {
            $gString = "WHERE gestor = :gestor "
                    . "ORDER BY fechain DESC";
        } else {
            $gString = 'order by gestor, fechain DESC, fechaout DESC, numero_de_cuenta';
        }

        $querymain = "select id_cuenta, numero_de_cuenta, nombre_deudor, cliente, saldo_total,
queue, completo, fechaout, fechain, gestor
from resumen
join vasign on id_cuenta=c_cont
join nombres on iniciales=gestor
join dictamenes on dictamen = status_aarsa " . $gString;
        $stm = $this->pdo->query($querymain);
        if (!empty($gestor)) {
            $stm->bindParam(':gestor', $gestor);
        }
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS, VisitSheetObject::class);
    }

    /**
     *
     * @param string $vst
     * @return array
     */
    public function getCompleto($vst) {
        $query = "SELECT completo FROM nombres
where iniciales=:vst
limit 1;";
        $stn = $this->pdo->prepare($query);
        $stn->bindParam(':vst', $vst);
        $stn->execute();
        return $stn->fetch(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @param string $tipo
     * @param string $CUENTA
     */
    public function updateVasign($tipo, $CUENTA) {
        if ($tipo == 'id_cuenta') {
            $queryCuenta = "select id_cuenta from resumen where id_cuenta = :cuenta";
        } else {
            $queryCuenta = "select id_cuenta from resumen where numero_de_cuenta = :cuenta";
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
