<?php

namespace App;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * AgentActivityClass
 *
 * @author gmbs
 *
 */
class AgentActivityClass extends BaseClass {

    /**
     * 
     * @param string $agent
     * @param string $date
     * @return array
     */
    public function getPromises($agent, $date) {
        $query = "select numero_de_cuenta,nombre_deudor,
status_de_credito,ejecutivo_asignado_call_center,
status_aarsa,saldo_descuento_2,cliente,id_cuenta,
max(n_prom) as monto_promesa,max(d_prom) as fecha_promesa
from resumen
join historia on id_cuenta=c_cont
where c_cvge=:agent and d_fech=:date and n_prom>0
group by id_cuenta
ORDER BY saldo_descuento_2 desc";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':agent', $agent);
        $stq->bindValue(':date', $date);
        $stq->execute();
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param string $agent
     * @param string $date
     * @return array
     */
    public function getCalls($agent, $date) {
        $query = "select numero_de_cuenta,nombre_deudor,
status_de_credito,ejecutivo_asignado_call_center,
status_aarsa,saldo_descuento_2,cliente,id_cuenta,
d_fech,c_hrin,c_cvst,c_contan 
from resumen
join historia on c_cont=id_cuenta
where c_cvge=:agent and d_fech=:date
ORDER BY d_fech,c_hrin";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':agent', $agent);
        $stq->bindValue(':date', $date);
        $stq->execute();
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param string $agent
     * @param string $date
     * @return array
     */
    public function getReport($agent, $date) {
        $query = "select numero_de_cuenta, nombre_deudor,
    saldo_total, status_de_credito, status_aarsa,
    ejecutivo_asignado_call_center,
    dias_vencidos, c_cvst, c_hrin,
    saldo_descuento_2, producto, estado_deudor,
    ciudad_deudor, cliente, id_cuenta,
    n_prom, d_prom, v_cc as 'vcc'
    from resumen
    join historia on id_cuenta=c_cont
    join dictamenes on dictamen=status_aarsa
    where c_cvge=:agent and d_fech=:date
    ORDER BY d_fech, c_hrin";
        $stm = $this->pdo->prepare($query);
        $stm->bindValue(':agent', $agent);
        $stm->bindValue(':date', $date);
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

}
