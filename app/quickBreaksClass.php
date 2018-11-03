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
    protected $createBreakTab          = "CREATE TEMPORARY TABLE  `break_table` (
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
    protected $insertBreakTab          = "insert into break_table (gestor,tipo,tiempo)
select c_cvge,c_cvst,c_hrin
from historia where c_cont=0 and
d_fech=curdate() and c_cvst<>'login' and c_cvst<>'salir'
order by c_cvge,c_cvst,c_hrin";
    
    /**
     *
     * @var string
     */
    protected $createTimeDiff         = "create temporary table time_diff
select gestor,tiempo,min(c_hrin) as mntp from historia,break_table
where d_fech=curdate() and gestor=c_cvge and c_hrin>tiempo
group by gestor,tiempo";
    
    /**
     *
     * @var string
     */
    protected $updateBreakTabDiff    = "update break_table,time_diff set ntp=mntp,
diff=(time_to_sec(mntp)-time_to_sec(time_diff.tiempo))/60
where time_diff.gestor=break_table.gestor and time_diff.tiempo=break_table.tiempo";
    
    /**
     *
     * @var string
     */
    protected $dropBreakTemp        = "drop table if exists break_temp";
    
    /**
     *
     * @var string
     */
    protected $createBreakTemp   = "create table break_temp
select gestor,sum(diff) as sdiff from break_table
where tipo<>'junta' group by gestor";
    
    /**
     *
     * @var string
     */
    protected $queryBreakTab           = "SELECT * FROM break_table";

    /**
     * 
     * @return array          
     */
    public function getBreaks()
    {
        $this->pdo->query($this->createBreakTab);
        $this->pdo->query($this->insertBreakTab);
        $this->pdo->query($this->createTimeDiff);
        $this->pdo->query($this->updateBreakTabDiff);
        $this->pdo->query($this->dropBreakTemp);
        $this->pdo->query($this->createBreakTemp);
        $sta    = $this->pdo->query($this->queryBreakTab);
        $result = $sta->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}