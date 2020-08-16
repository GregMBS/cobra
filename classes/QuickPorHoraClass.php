<?php

namespace cobra_salsa;

use PDO;

/**
 * Description of BigClass
 *
 * @author gmbs
 */
class QuickPorHoraClass
{
    protected $pdo;
    protected $createPorHora = "CREATE TEMPORARY TABLE  `porhora` (
  `auto` int(11) NOT NULL AUTO_INCREMENT,
  `gestor` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `contactos` int(11),
  `gestiones` int(11),
  `promesas` int(11),
  `porciento` varchar(10),
  PRIMARY KEY (`auto`)
)";
    protected $insertPorHora = "insert into porhora (gestor,contactos,gestiones,promesas,porciento)
select c_cvge, sum((C_CARG is not null)&&(C_CARG<>'')) as contacto,
count(1), sum(C_CVST like 'PROMESA DE%') as np,
concat(round(sum((C_CARG is not null)&&(C_CARG<>''))/count(1)*100),'%')
from historia
where D_FECH = curdate()
and C_HRIN > now() - interval 1 hour
and c_cont>0
and c_msge is null
and c_cniv is null
group by C_CVGE;";
    protected $queryPorHora  = "select c_cvge as 'gestor', 
    sum((C_CARG is not null)&&(C_CARG<>'')) as 'contactos',
count(1)as 'gestiones', 
sum(n_prom>0) as 'promesas',
concat(round(sum((C_CARG is not null)&&(C_CARG<>''))/count(1)*100),'%') as 'porciento'
from historia
where D_FECH = curdate()
and C_HRIN > hour(now()) - 1
and c_cont>0
and c_msge is null
and c_cniv is null
group by C_CVGE";

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return mixed
     */
    public function getPorHora()
    {
//        $this->pdo->query($this->createPorHora);
//        $this->pdo->query($this->insertPorHora);
        $sta    = $this->pdo->query($this->queryPorHora);
        return $sta->fetchAll(PDO::FETCH_ASSOC);
    }
}