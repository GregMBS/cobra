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
    protected $createHoy = "CREATE TEMPORARY TABLE  `hoy` (
  `auto` int(11) NOT NULL AUTO_INCREMENT,
  `gestor` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `Gestiones` int(11),
  `Promesas_Total` int(11),
  `Promesas_Sin_Gestion` int(11),
  `Promesas_Hoy` int(11),
  `Monto_Promesas_Hoy` decimal(10,2),
  `Negociaciones` int(11),
  `Horas` decimal(5,1),
  `Break_min` decimal(5,1),
  `Gestiones_por_hora` decimal(5,1),
  PRIMARY KEY (`auto`)
)";
    protected $insertHoy = "insert into hoy
        (gestor,Horas,Gestiones,Promesas_Hoy,Negociaciones,
        Gestiones_por_hora,Monto_Promesas_Hoy)
        select c_cvge,time_to_sec(subtime(max(c_hrin),min(c_hrin)))/3600 as horas,
        count(1),sum(C_CVST like 'PRO% DE%') as np,
        sum(C_CVST like 'CLIENTE NEG%') as cn,
        count(1)/time_to_sec(subtime(max(c_hrin),min(c_hrin)))*3600,
        sum(n_prom)
        from historia
        where D_FECH = curdate()
        and c_cont>0
        and c_msge is null
        and c_cniv is null
        group by C_CVGE order by c_cvge";
    protected $updateHoyBreaktemp = "update hoy, breaktemp
        set Break_min = sum_diff
        where hoy.gestor = breaktemp.gestor";
    protected $queryHoy = "SELECT * FROM hoy";

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return mixed
     */
    public function getHoy()
    {
        $this->pdo->query($this->createHoy);
        $this->pdo->query($this->insertHoy);
        $this->pdo->query($this->updateHoyBreaktemp);
        $sta = $this->pdo->prepare($this->queryHoy);
        $sta->execute();
        var_dump($sta->fetchAll());
        die();
        return $sta->fetchAll(PDO::FETCH_ASSOC);
    }
}
