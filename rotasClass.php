<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of rotasClass
 *
 * @author gmbs
 */
class rotasClass
{
    protected $pdo;
    protected $queryRotasStart = "select resumen.cliente,numero_de_cuenta,nombre_deudor,saldo_total,
status_de_credito,c_cvge,
status_aarsa,n_prom1,d_prom1,n_prom2,d_prom2,
resumen.id_cuenta,datediff(curdate(),d_prom) as semaforo,d_fech,sum(monto) as sum_monto,
n_prom3,d_prom3,n_prom4,d_prom4
from resumen
join dictamenes on dictamen=status_aarsa
join historia h1 on id_cuenta=c_cont
left join pagos on pagos.id_cuenta=c_cont and fecha>=d_fech
where n_prom>0 and queue in ('CLIENTE NEGOCIANDO','PROMESAS','PAGOS','PAGANDO CONVENIO', 'PROMESAS INCUMPLIDAS')
and status_de_credito not regexp 'inactivo$'
and GREATEST(d_prom1,d_prom2,d_prom3,d_prom4)>last_day(curdate()-interval 1 month - interval 1 week)
and d_fech>last_day(curdate()-interval 2 month)
and not exists (select * from historia h2 where h1.c_cont=h2.c_cont
and n_prom>0 and concat(h2.d_fech,h2.c_hrfi)>concat(h1.d_fech,h1.c_hrfi))
";
    protected $queryRotasEnd = "group by c_cvge,cliente,status_de_credito,numero_de_cuenta
order by c_cvge,sum(monto),d_prom
";


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getUserType($capt)
    {
        $query = "SELECT tipo FROM nombres "
            ."WHERE iniciales = :gestor;";
        $stq   = $this->pdo->prepare($query);
        $stq->bindParam(':gestor', $capt);
        $stq->execute();
        $types = $stq->fetch();
        $type  = $types['tipo'];
        return $type;
    }

    public function getRotas($capt, $d_prom = '')
    {
        $gestorstr = " and (ejecutivo_asignado_call_center=:capt or c_cvge=:capt) ";
        $tipo = $this->getUserType($capt);
        if ($tipo == 'admin') {
            $gestorstr = "";
        }
        if (!empty($d_prom)) {
            $gestorstr = $gestorstr." and d_prom=:dprom  ";
        }
        $query = $this->queryRotasStart.$gestorstr.$this->queryRotasEnd;
        $stq   = $this->pdo->prepare($query);
        if ($tipo != 'admin') {
            $stq->bindParam(':capt', $capt);
        }
        if (!empty($d_prom)) {
            $stq->bindParam(':dprom', $d_prom);
        }
        $stq->execute();
        $result = $stq->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}