<?php

namespace cobra_salsa;

use PDO;
use PDOException;

/**
 * Description of BigClass
 *
 * @author gmbs
 */
class QuickHoyClass
{
    protected PDO $pdo;
    protected string $insertHoy = "create temporary table hoy
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
    protected string $queryHoy = "select c_cvge as 'gestor',
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

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return array|false
     */
    public function getHoy()
    {
        try {
            $this->pdo->query($this->insertHoy);
            $sta = $this->pdo->query($this->queryHoy);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
        return $sta->fetchAll(PDO::FETCH_ASSOC);
    }
}
