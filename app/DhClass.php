<?php

namespace App;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use PDO;

/**
 * Database Class for ddh/pdh
 *
 * @author gmbs
 *
 */
class DhClass extends BaseClass {

    /**
     * 
     * @param string $gestor
     * @param string $fecha
     * @return array
     */
    public function getPromesas($gestor, $fecha) {
        $query = "select numero_de_cuenta,nombre_deudor,
status_de_credito,ejecutivo_asignado_call_center,
status_aarsa,saldo_descuento_2,cliente,id_cuenta,
max(n_prom) as monto_promesa,max(d_prom) as fecha_promesa
from resumen
join historia on id_cuenta=c_cont
where c_cvge=:gestor and d_fech=:fecha and n_prom>0
group by id_cuenta
ORDER BY saldo_descuento_2 desc";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':gestor', $gestor);
        $stq->bindValue(':fecha', $fecha);
        $stq->execute();
        $result = $stq->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param string $gestor
     * @param string $fecha
     * @return array
     */
    public function getGestiones($gestor, $fecha) {
        $query = "select numero_de_cuenta,nombre_deudor,
status_de_credito,ejecutivo_asignado_call_center,
status_aarsa,saldo_descuento_2,cliente,id_cuenta,
d_fech,c_hrin,c_cvst,c_contan 
from resumen
join historia on c_cont=id_cuenta
where c_cvge=:gestor and d_fech=:fecha
ORDER BY d_fech,c_hrin";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':gestor', $gestor);
        $stq->bindValue(':fecha', $fecha);
        $stq->execute();
        $result = $stq->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param string $gestor
     * @param string $fecha
     * @return array
     */
    public function getDhMain($gestor, $fecha) {
        $querymain = "select numero_de_cuenta, nombre_deudor,
    saldo_total, status_de_credito, status_aarsa,
    ejecutivo_asignado_call_center,
    dias_vencidos, c_cvst, c_hrin,
    saldo_descuento_2, producto, estado_deudor,
    ciudad_deudor, cliente, id_cuenta,
    n_prom, d_prom, v_cc as 'vcc'
    from resumen
    join historia on id_cuenta=c_cont
    join dictamenes on dictamen=status_aarsa
    where c_cvge=:gestor and d_fech=:fecha
    ORDER BY d_fech, c_hrin";
        $stm = $this->pdo->prepare($querymain);
        $stm->bindValue(':gestor', $gestor);
        $stm->bindValue(':fecha', $fecha);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}
