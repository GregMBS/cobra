<?php

namespace App;

/**
 * Description of QuickBreaksClass
 *
 * @author gmbs
 */
class QuickBreaksClass extends BaseClass
{
    /**
     *
     * @var string
     */
    protected $createBreakTab          = "CREATE TEMPORARY TABLE  `breaktab` (
  `auto` int(11) NOT NULL AUTO_INCREMENT,
  `gestor` varchar(255) NOT NULL,
  `tipo` varchar(255),
  `tiempo` time,
  `ntp` time,
  `diff` int(11),
  PRIMARY KEY (`auto`)
)";
    
    /**
     *
     * @var string
     */
    protected $insertBreakTab          = "insert into breaktab (gestor,tipo,tiempo)
select c_cvge,c_cvst,c_hrin
from historia where c_cont=0 and
d_fech=curdate() and c_cvst<>'login' and c_cvst<>'salir'
order by c_cvge,c_cvst,c_hrin";
    
    /**
     *
     * @var string
     */
    protected $createNtpdiff         = "create temporary table ntpdiff
select gestor,tiempo,min(c_hrin) as mntp from historia,breaktab
where d_fech=curdate() and gestor=c_cvge and c_hrin>tiempo
group by gestor,tiempo";
    
    /**
     *
     * @var string
     */
    protected $updateBreakTabDiff    = "update breaktab,ntpdiff set ntp=mntp,
diff=(time_to_sec(mntp)-time_to_sec(ntpdiff.tiempo))/60
where ntpdiff.gestor=breaktab.gestor and ntpdiff.tiempo=breaktab.tiempo";
    
    /**
     *
     * @var string
     */
    protected $dropBreaktemp        = "drop table if exists breaktemp";
    
    /**
     *
     * @var string
     */
    protected $createBreaktemp   = "create table breaktemp
select gestor,sum(diff) as sdiff from breaktab
where tipo<>'junta' group by gestor";
    
    /**
     *
     * @var string
     */
    protected $queryBreakTab           = "SELECT * FROM breaktab";

    /**
     * 
     * @return array          
     */
    public function getBreaks()
    {
        $this->pdo->query($this->createBreakTab);
        $this->pdo->query($this->insertBreakTab);
        $this->pdo->query($this->createNtpdiff);
        $this->pdo->query($this->updateBreakTabDiff);
        $this->pdo->query($this->dropBreaktemp);
        $this->pdo->query($this->createBreaktemp);
        $sta    = $this->pdo->query($this->queryBreakTab);
        $result = $sta->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}