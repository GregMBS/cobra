<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

/**
 * Description of CheckClass
 *
 * @author gmbs
 */
class CheckClass {

    /**
     *
     * @var \PDO
     */
    private $pdo;

    /**
     * 
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

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
     * @param string $CUENTA
     * @param string $gestor
     * @param string $fechaout
     * @param int $ID_CUENTA
     */
    public function insertVasign($CUENTA, $gestor, $fechaout, $ID_CUENTA) {
        $queryins = "INSERT INTO vasign (cuenta, gestor, fechaout, fechain,c_cont)
VALUES (:cuenta, :gestor, :fechaout, now(), :idc);";
        $sti = $this->pdo->prepare($queryins);
        $sti->bindParam(':cuenta', $CUENTA);
        $sti->bindParam(':gestor', $gestor);
        $sti->bindParam(':fechaout', $fechaout);
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
        $end = new DateTime();
        $begin = $end->modify('-1 month');

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval, $end);

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
            $gstring = '';
        }

        $querymain = "select id_cuenta, numero_de_cuenta, nombre_deudor, cliente, saldo_total,
queue, completo, fechaout, fechain
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

}
