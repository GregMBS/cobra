<?php

namespace App;

/**
 * VisitorActivityClass
 *
 * @author gmbs
 *
 */
class VisitorActivityClass extends BaseClass
{
    public function getPromises($agent, $date)
    {
        $query  = "select numero_de_cuenta,nombre_deudor,saldo_total,
status_de_credito,ejecutivo_asignado_call_center,
pagos_vencidos,status_aarsa,
saldo_descuento_2,producto,estado_deudor,ciudad_deudor,cliente,id_cuenta,
max(n_prom) as monto_promesa,max(d_prom) as fecha_promesa, max(v_cc) as vcc
from resumen
join historia on id_cuenta=c_cont
left join dictamenes on dictamen = status_aarsa
where c_visit=:agent and d_fech=:date and n_prom>0
group by id_cuenta
ORDER BY
saldo_total desc, pagos_vencidos";
        $stq    = $this->pdo->prepare($query);
        $stq->bindValue(':agent', $agent);
        $stq->bindValue(':date', $date);
        $stq->execute();
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getCalls($agent, $date)
    {
        $query  = "select numero_de_cuenta,nombre_deudor,saldo_total,
status_de_credito,ejecutivo_asignado_call_center,
pagos_vencidos,c_cvst,
saldo_descuento_2,producto,estado_deudor,ciudad_deudor,cliente,id_cuenta,
n_prom,d_prom,v_cc from resumen
join historia on id_cuenta=c_cont
join dictamenes on dictamen=status_aarsa
where c_visit=:agent and d_fech=:date
ORDER BY
saldo_total desc, pagos_vencidos,d_fech,c_hrin";
        $stq    = $this->pdo->prepare($query);
        $stq->bindValue(':agent', $agent);
        $stq->bindValue(':date', $date);
        $stq->execute();
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

}