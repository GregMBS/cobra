<?php

namespace App;

/**
 * Description of BigClass
 *
 * @author gmbs
 */
class QuickBreaksClass extends BaseClass
{
    /**
     *
     * @var string
     */
    protected $createBreaktab          = "CREATE TEMPORARY TABLE  `breaktab` (
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
    protected $insertBreaktab          = "insert into breaktab (gestor,tipo,tiempo)
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
    protected $updateBreaktabDiff    = "update breaktab,ntpdiff set ntp=mntp,
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
    protected $queryBreaktab           = "SELECT * FROM breaktab";

    /**
     * 
     * @return array          
     */
    public function getBreaks()
    {
        $this->pdo->query($this->createBreaktab);
        $this->pdo->query($this->insertBreaktab);
        $this->pdo->query($this->createNtpdiff);
        $this->pdo->query($this->updateBreaktabDiff);
        $this->pdo->query($this->dropBreaktemp);
        $this->pdo->query($this->createBreaktemp);
        $sta    = $this->pdo->query($this->queryBreaktab);
        $result = $sta->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}