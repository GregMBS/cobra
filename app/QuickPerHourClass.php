<?php

namespace App;

/**
 * Description of QuickPerHourClass
 *
 * @author gmbs
 */
class QuickPerHourClass extends BaseClass
{
    /**
     *
     * @var string
     */
    protected $create = "CREATE TEMPORARY TABLE  `hourly` (
  `auto` int(11) NOT NULL AUTO_INCREMENT,
  `gestor` varchar(255) NOT NULL,
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
    protected $insert = "insert into hourly (gestor,contactos,gestiones,promesas,firmas,porciento)
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
    protected $query  = "SELECT * FROM hourly";

    /**
     * 
     * @return array
     */
    public function getPorHora()
    {
        $this->pdo->query($this->create);
        $this->pdo->query($this->insert);
        $sta    = $this->pdo->query($this->query);
        $result = $sta->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}