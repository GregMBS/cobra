<?php

namespace App;

/**
 * Description of BigClass
 *
 * @author gmbs
 */
class QuickPorHoraClass extends BaseClass
{
    /**
     *
     * @var string
     */
    protected $createPorHora = "CREATE TEMPORARY TABLE  `porhora` (
  `auto` int(11) NOT NULL AUTO_INCREMENT,
  `gestor` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `contactos` int(11),
  `gestiones` int(11),
  `promesas` int(11),
  `firmas` int(11),
  `porciento` varchar(10),
  PRIMARY KEY (`auto`)
)";

    /**
     *
     * @var string
     */
    protected $insertPorHora = "insert into porhora (gestor,contactos,gestiones,promesas,firmas,porciento)
select c_cvge, sum((C_CARG is not null)&&(C_CARG<>'')) as contacto,
count(1), sum(C_CVST like 'PROMESA DE P%') as np, sum(C_CVST = 'PROMESA DE FIRMA') as nf,
concat(round(sum((C_CARG is not null)&&(C_CARG<>''))/count(1)*100),'%')
from historia
where D_FECH = curdate()
and C_HRIN > now() - interval 1 hour
and c_cont>0
and c_msge is null
and c_cniv is null
group by C_CVGE";
    
    /**
     *
     * @var string
     */
    protected $queryPorHora  = "SELECT * FROM porhora";

    /**
     * 
     * @return array
     */
    public function getPorHora()
    {
        $this->pdo->query($this->createPorHora);
        $this->pdo->query($this->insertPorHora);
        $sta    = $this->pdo->query($this->queryPorHora);
        $result = $sta->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}