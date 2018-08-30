<?php

namespace App;

/**
 * Description of QuickHoyClass
 *
 * @author gmbs
 */
class QuickHoyClass extends BaseClass
{
    /**
     *
     * @var string
     */
    protected $createHoy          = "CREATE TEMPORARY TABLE  `hoy` (
  `auto` int(11) NOT NULL AUTO_INCREMENT,
  `gestor` varchar(255) NOT NULL,
  `Gestiones` int(11),
  `Promesas_Total` int(11),
  `Promesas_Sin_Gestion` int(11),
  `Promesas_Hoy` int(11),
  `Monto_Promesas_Hoy` decimal(10,2),
  `Firmas_Hoy` int(11),
  `Negociaciones` int(11),
  `Pagos_Hoy` int(11) DEFAULT 0,
  `Horas` decimal(5,1),
  `Break_min` decimal(5,1),
  `Gestiones_por_hora` decimal(5,1),
  `Efectividad` decimal(5,4),
  PRIMARY KEY (`auto`)
)";
    
    /**
     *
     * @var string
     */
    protected $insertHoy          = "insert into hoy
        (gestor,Horas,Gestiones,Promesas_Hoy,Firmas_Hoy,Negociaciones,
        Gestiones_por_hora,Monto_Promesas_Hoy)
        select c_cvge,time_to_sec(subtime(max(c_hrin),min(c_hrin)))/3600 as horas,
        count(1),sum(C_CVST like 'PRO% DE P%') as np,sum(C_CVST like 'PRO% DE F%') as nf,
        sum(C_CVST like 'CLIENTE NEG%') as cn,
        count(1)/time_to_sec(subtime(max(c_hrin),min(c_hrin)))*3600,
        sum(n_prom)
        from historia
        where D_FECH = curdate()
        and c_cont>0
        and c_msge is null
        and c_cniv is null
        group by C_CVGE order by c_cvge";
    
    /**
     *
     * @var string
     */
    protected $updateHoyBreaktemp    = "update hoy,breaktemp
        set Break_min=sdiff
        where hoy.gestor=breaktemp.gestor";
    
    /**
     *
     * @var string
     */
    protected $updateHoyEfectividad    = "update hoy
        set Efectividad = (Promesas_Hoy + Firmas_Hoy + Pagos_Hoy) / Gestiones 
        where Gestiones > 0";
    
    /**
     *
     * @var string
     */
    protected $queryHoy           = "SELECT * FROM hoy";

    private function getPagos() {
        $queryListGestores = "SELECT gestor AS name FROM hoy";
        $gestores = $this->pdo->query($queryListGestores);
        $queryGetPagos = "SELECT count(1) as ct FROM pagos "
                . "WHERE fecha = CURDATE() "
                . "AND gestor = :gestor";
        $stp = $this->pdo->prepare($queryGetPagos);
        $updateHoyPagos    = "update hoy
        set hoy.Pagos_Hoy = :count
        where hoy.gestor = :gestor";
        $stu = $this->pdo->prepare($updateHoyPagos);
        foreach ($gestores as $gestor) {
           $stp->bindValue(':gestor', $gestor['name']);
           $stp->execute();
           $result = $stp->fetch(\PDO::FETCH_ASSOC);
           $stu->bindValue(':gestor', $gestor['name']);
           $stu->bindValue(':count', $result['ct']);
           $stu->execute();
        }
    }
    
    /**
     * 
     * @return array
     */
    public function getHoy()
    {
        $this->pdo->query($this->createHoy);
        $this->pdo->query($this->insertHoy);
        $this->pdo->query($this->updateHoyBreaktemp);
        $this->getPagos();
        $this->pdo->query($this->updateHoyEfectividad);
        $sta    = $this->pdo->query($this->queryHoy);
        $result = $sta->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}
