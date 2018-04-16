<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of GestorClass
 *
 * @author gmbs
 */
class GestorClass extends BaseClass {

    /**
     * 
     * @param string $CUENTA
     * @param string $CLIENTE
     * @return array
     */
    function getPagos($CUENTA, $CLIENTE) {
        $querypag = "select sum(monto) as sm, max(fecha) as mf "
                . "from pagos "
                . "where CUENTA=:cuenta and CLIENTE=':cliente";
        $stp = $this->pdo->prepare($querypag);
        $stp->bindParam(':cuenta', $CUENTA);
        $stp->bindParam(':cliente', $CLIENTE);
        $stp->execute();
        $resultp = $stp->fetchAll(\PDO::FETCH_ASSOC);
        return $resultp;
    }

    /**
     * 
     * @param string $gestor
     * @return array
     */
    function getPagosReport($gestor) {
        $query = "SELECT d_prom, cuenta, n_prom, c_cvge, "
                . "ejecutivo_asignado_call_center, status_aarsa, saldo_total, "
                . "cliente,id_cuenta,saldo_descuento_2 "
                . "FROM historia JOIN resumen on c_cont=id_cuenta "
                . "WHERE n_prom>0 AND c_cvge =:gestor "
                . "GROUP BY cuenta ORDER BY c_cvge,d_prom,cliente,cuenta";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->execute();
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

}
