<?php

namespace cobra_salsa;

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
    protected $queryPorHora  = "SELECT * FROM porhora;";

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getPorHora()
    {
        $this->pdo->query($this->createPorHora);
        $this->pdo->query($this->insertPorHora);
        $sta    = $this->pdo->query($this->queryPorHora);
        $result = $sta->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}