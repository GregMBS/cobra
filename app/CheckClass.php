<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

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
    public function getIdCuentafromCuenta($CUENTA) {
        $querycc = "select id_cuenta from resumen
where numero_de_cuenta=:cuenta 
and status_de_creditonot regexp '-' LIMIT 1";
        $stcc = $this->pdo->prepare($querycc);
        $stcc->bindParam(':cuenta', $CUENTA);
        $stcc->execute();
        $resultcc = $stcc->fetch(\PDO::FETCH_ASSOC);
        if (isset($resultcc['id_cuenta'])) {
            $id_cuenta = $resultcc['id_cuenta'];
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
    public function getCuentafromIdCuenta($id_cuenta) {
        $querycc = "select numero_de_cuenta from resumen
where id_cuenta=:id_cuenta 
and status_de_creditonot regexp '-' LIMIT 1";
        $stcc = $this->pdo->prepare($querycc);
        $stcc->bindParam(':id_cuenta', $id_cuenta);
        $stcc->execute();
        $resultcc = $stcc->fetch(\PDO::FETCH_ASSOC);
        if (isset($resultcc['numero_de_cuenta'])) {
            $numero_de_cuenta = $resultcc['numero_de__cuenta'];
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
        $queryins = "INSERT INTO vasign (cuenta, gestor, fechaout, fechain,c_cont)
VALUES (:cuenta, :gestor, :fechaout, now(), :idc)";
        $sti = $this->pdo->prepare($queryins);
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
        $queryins = "INSERT INTO vasign
			(cuenta, gestor, fechaout,c_cont)
			VALUES 
			(:cuenta, :gestor, now(), :id_cuenta)";
        $sti = $this->pdo->prepare($queryins);
        $sti->bindParam(':cuenta', $CUENTA);
        $sti->bindParam(':gestor', $gestor);
        $sti->bindParam(':id_cuenta', $ID_CUENTA);
        $sti->execute();
    }

    /**
     * 
     * @return array
     */
    public function getVisitadores() {
        $query = "SELECT usuaria,completo FROM nombres where completo<>''
and tipo IN ('visitador','admin')";
        $result = $this->pdo->query($query);
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function getOneMonth() {
        $output = array();
        $end = new \DateTime();
        $begin = $end->modify('-1 month');

        $interval = new \DateInterval('P1D');
        $daterange = new \DatePeriod($begin, $interval, $end);

        foreach ($daterange as $date) {
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
        $querycount = "select sum(fechaout>curdate()) as countOut,
    sum(fechain>curdate()) as countIn 
    from vasign
where gestor=:gestor";
        $stc = $this->pdo->query($querycount);
        $stc->bindParam(':gestor', $gestor);
        $stc->execute();
        $resultcount = $stc->fetch();
        return $resultcount;
    }

    /**
     * 
     * @param string $gestor
     * @return array
     */
    public function listVasign($gestor) {
        if (!empty($gestor)) {
            $gstring = "WHERE gestor = :gestor "
                    . "ORDER BY fechain DESC";
        } else {
            $gstring = 'order by gestor, fechain DESC, fechaout DESC, numero_de_cuenta';
        }

        $querymain = "select id_cuenta, numero_de_cuenta, nombre_deudor, cliente, saldo_total,
queue, completo, fechaout, fechain, gestor
from resumen 
join vasign on id_cuenta=c_cont 
join nombres on iniciales=gestor 
join dictamenes on dictamen = status_aarsa " . $gstring;
        $stm = $this->pdo->query($querymain);
        if (!empty($gestor)) {
            $stm->bindParam(':gestor', $gestor);
        }
        $stm->execute();
        $resultmain = $stm->fetchAll();
        return $resultmain;
    }

    /**
     * 
     * @param string $vst
     * @return array
     */
    public function getCompleto($vst) {
        $queryn = "SELECT completo FROM nombres
where iniciales=:vst
limit 1";
        $stn = $this->pdo->prepare($queryn);
        $stn->bindParam(':vst', $vst);
        $stn->execute();
        $resultn = $stn->fetch(\PDO::FETCH_ASSOC);
        return $resultn;
    }

    /**
     * 
     * @param string $tipo
     * @param string $CUENTA
     */
    public function updateVasign($tipo, $CUENTA) {
        if ($tipo == 'id_cuenta') {
            $querycta = "select id_cuenta from resumen where id_cuenta = :cuenta";
        } else {
            $querycta = "select id_cuenta from resumen where numero_de_cuenta = :cuenta";
        }
        $stc = $this->pdo->prepare($querycta);
        $stc->bindParam(':cuenta', $CUENTA);
        $stc->execute();
        $resultcc = $stc->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($resultcc as $answercc) {
            $C_CONT = $answercc['id_cuenta'];
        }
        $queryins = "update vasign set fechain=now()
	where c_cont = :id_cuenta
	and fechain is null
	limit 1";
        $sti = $this->pdo->prepare($queryins);
        $sti->bindParam(':id_cuenta', $C_CONT);
        $sti->execute();
    }
}
