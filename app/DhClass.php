<?php

namespace app;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
        $query = "select numero_de_cuenta,nombre_deudor,saldo_total,
status_de_credito,ejecutivo_asignado_call_center,
pagos_vencidos,status_aarsa,
saldo_descuento_1,producto,estado_deudor,ciudad_deudor,cliente,id_cuenta,
max(n_prom) as monto_promesa,max(d_prom) as fecha_promesa, v_cc as vcc
from resumen
join historia on id_cuenta=c_cont
left join dictamenes on dictamen = status_aarsa
where c_cvge=:gestor and d_fech=:fecha and n_prom>0
group by id_cuenta
ORDER BY
saldo_total desc, pagos_vencidos";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->bindParam(':fecha', $fecha);
        $stq->execute();
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param string $gestor
     * @param string $fecha
     * @return array
     */
    public function getGestiones($gestor, $fecha) {
        $query = "select numero_de_cuenta,nombre_deudor,saldo_total,
status_de_credito,ejecutivo_asignado_call_center,
pagos_vencidos,c_cvst,
saldo_descuento_1,producto,estado_deudor,ciudad_deudor,cliente,id_cuenta,
n_prom,d_prom,v_cc from resumen
join historia on id_cuenta=c_cont
join dictamenes on dictamen=status_aarsa
where c_cvge=:gestor and d_fech=:fecha
ORDER BY
saldo_total desc, pagos_vencidos,d_fech,c_hrin";
        $stq = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $gestor);
        $stq->bindParam(':fecha', $fecha);
        $stq->execute();
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
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
        $stm->bindParam(':gestor', $gestor);
        $stm->bindParam(':fecha', $fecha);
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

}
