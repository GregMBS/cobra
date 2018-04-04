<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Description of CheckClass
 *
 * @author gmbs
 */
class CheckClass extends BaseClass {
    
    /**
     * 
     * @var string
     */
    private $CUENTA;
    
    /**
     *
     * @var string
     */
    private $gestor;
    
    /**
     *
     * @var int
     */
    private $id_cuenta;
    
    /**
     *
     * @var string
     */
    private $tipo;
    
    /**
     *
     * @var Carbon
     */
    private $fechaout;
    
    public function setVars(Request $r) {
        $this->gestor = $r->gestor;
        $this->tipo = $r->tipo;
        if ($this->tipo == 'numero_de_cuenta') {
            $this->CUENTA = $r->CUENTA;
            $this->id_cuenta = $this->getIdCuentafromCuenta($this->CUENTA);
        } else {
            $this->id_cuenta = $r->CUENTA;
            $this->CUENTA = $this->getCuentafromIdCuenta($this->id_cuenta);
        }
        $this->fechaout == new Carbon($r->fechaout);
    }

    /**
     * 
     * @param string $CUENTA
     * @return int
     */
    private function getIdCuentafromCuenta($CUENTA) {
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
    private function getCuentafromIdCuenta($id_cuenta) {
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

    public function insertVasignBoth() {
        $queryins = "INSERT INTO vasign (cuenta, gestor, fechaout, fechain,c_cont)
VALUES (:cuenta, :gestor, :fechaout, now(), :idc)";
        $sti = $this->pdo->prepare($queryins);
        $sti->bindParam(':cuenta', $this->CUENTA);
        $sti->bindParam(':gestor', $this->gestor);
        $sti->bindParam(':fechaout', $this->fechaout);
        $sti->bindParam(':id_cuenta', $this->id_cuenta);
        $sti->execute();
    }

    public function insertVasign() {
        $queryins = "INSERT INTO vasign
			(cuenta, gestor, fechaout, c_cont)
			VALUES 
			(:cuenta, :gestor, now(), :id_cuenta)";
        $sti = $this->pdo->prepare($queryins);
        $sti->bindParam(':cuenta', $this->CUENTA);
        $sti->bindParam(':gestor', $this->gestor);
        $sti->bindParam(':id_cuenta', $this->id_cuenta);
        $sti->execute();
    }

    /**
     * 
     * @return array
     */
    public function getVisitadores() {
        $query = "SELECT iniciales,completo FROM users where tipo IN ('visitador','admin')";
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
        $query = "select sum(fechaout>curdate()) as countOut,
    sum(fechain>curdate()) as countIn 
    from vasign
where gestor=:gestor";
        $stc = $this->pdo->query($query);
        $stc->bindParam(':gestor', $gestor);
        $stc->execute();
        $result = $stc->fetch();
        return $result;
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
join users on iniciales=gestor 
join dictamenes on dictamen = status_aarsa " . $gstring;
        $stm = $this->pdo->prepare($querymain);
        if (!empty($gestor)) {
            $stm->bindParam(':gestor', $gestor);
        }
        $stm->execute();
        $resultmain = $stm->fetchAll();
        return $resultmain;
    }

    /**
     * 
     * @param string $gestor
     * @return string
     */
    public function getCompleto($gestor) {
        $query = "SELECT completo FROM users
            WHERE iniciales=:gestor
            LIMIT 1";
        $stn = $this->pdo->prepare($query);
        $stn->bindParam(':gestor', $gestor);
        $stn->execute();
        $resultn = $stn->fetch(\PDO::FETCH_ASSOC);
        return $resultn['completo'];
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
