<?php

namespace cobra_salsa;

use PDO;

/**
 * Description of BigClass
 *
 * @author gmbs
 */
class QuickHoyClass
{
    protected $pdo;
    protected $insertHoy = "create temporary table hoy
        select c_cvge as 'gestor',
        time_to_sec(subtime(max(c_hrin),min(c_hrin)))/3600 as 'Horas',
        count(1) as 'Gestiones',
        sum(C_CVST like 'PRO% DE%') as 'Promesas_Hoy',
        sum(C_CVST like 'CLIENTE NEG%') as 'Negociaciones',
        count(1)/time_to_sec(subtime(max(c_hrin),min(c_hrin)))*3600 as 'Gestiones_por_hora',
        sum(n_prom) as 'Monto_Promesas_Hoy'
        from historia
        where D_FECH = curdate()
        and c_cont>0
        and c_msge is null
        and c_cniv is null
        group by C_CVGE order by c_cvge";
    protected $queryHoy = "select c_cvge as 'gestor',
        time_to_sec(subtime(max(c_hrfi),min(c_hrin)))/3600 as 'Horas',
        count(1) as 'Gestiones',
        sum(C_CVST like 'PRO% DE%') as 'Promesas_Hoy',
        sum(C_CVST like 'CLIENTE NEG%') as 'Negociaciones',
        count(1)/time_to_sec(subtime(max(c_hrfi),min(c_hrin)))*3600 as 'Gestiones_por_hora',
        sum(n_prom) as 'Monto_Promesas_Hoy',
        max(sum_diff) as 'Break_Minutos'
        from historia
        left join breaktemp on c_cvge = gestor
        where D_FECH = curdate()
        and c_cont>0
        and c_msge is null
        and c_cniv is null
        group by C_CVGE order by c_cvge";

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return mixed
     */
    public function getHoy()
    {
        $this->pdo->query($this->insertHoy);
        $sta = $this->pdo->prepare($this->queryHoy);
        $sta->execute();
        return $sta->fetchAll(PDO::FETCH_ASSOC);
    }
}
