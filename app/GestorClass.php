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
     * @var string
     */
    /*
    private $query = "SELECT d_prom, historia.cuenta, n_prom, c_cvge, 
    ejecutivo_asignado_call_center, status_aarsa, saldo_vencido, 
    cliente,resumen.id_cuenta,saldo_descuento_1, monto, fecha 
    FROM historia 
    JOIN resumen on c_cont = resumen.id_cuenta 
    LEFT JOIN pagos on pagos.id_cuenta = resumen.id_cuenta and fecha >= d_fech
    WHERE n_prom>0 AND c_cvge = :gestor 
    GROUP BY cuenta ORDER BY c_cvge,d_prom,cliente,cuenta";
*/
    /**
     * 
     * @param string $gestor
     * @return array
     */
    /*
    public function getPagosReport($gestor) {
        $stq = $this->pdo->prepare($this->query);
        $stq->bindParam(':gestor', $gestor);
        $stq->execute();
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
*/
}
