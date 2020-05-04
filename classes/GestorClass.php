<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use PDO;

/**
 * Description of GestorClass
 *
 * @author gmbs
 */
class GestorClass {

    /**
     *
     * @var PDO 
     */
    private $pdo;

    /**
     * 
     * @param PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param string $CUENTA
     * @param string $CLIENTE
     * @return array
     */
    function getPagos($CUENTA, $CLIENTE) {
        $querypag = "select sum(monto) as sm, max(fecha) as mf "
                . "from pagos "
                . "where CUENTA=:cuenta and CLIENTE=':cliente;";
        $stp = $this->pdo->prepare($querypag);
        $stp->bindParam(':cuenta', $CUENTA);
        $stp->bindParam(':cliente', $CLIENTE);
        $stp->execute();
        return $stp->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @param string $gestor
     * @return array
     */
    function getPagosReport($gestor) {
        $query = "SELECT d_prom, cuenta, n_prom, c_cvge, "
                . "ejecutivo_asignado_call_center, status_aarsa, saldo_vencido, "
                . "cliente,id_cuenta,saldo_descuento_1 "
                . "FROM historia JOIN resumen on c_cont=id_cuenta "
                . "WHERE n_prom>0 AND c_cvge =:gestor "
                . "GROUP BY cuenta ORDER BY c_cvge,d_prom,cliente,cuenta";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->execute();
        return $stq->fetchAll(PDO::FETCH_ASSOC);
    }

}
