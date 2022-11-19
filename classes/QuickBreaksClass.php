<?php

namespace cobra_salsa;

use PDO;

/**
 * Description of BigClass
 *
 * @author gmbs
 */
class QuickBreaksClass
{
    protected PDO $pdo;
    protected string $createBreakTab = "CREATE TEMPORARY TABLE  `breaktab` (
  `auto` int(11) NOT NULL AUTO_INCREMENT,
  `gestor` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_spanish_ci,
  `tiempo` time,
  `ntp` time,
  `diff` int(11),
  PRIMARY KEY (`auto`)
)";
    protected string $insertBreakTab          = "insert into breaktab (gestor,tipo,tiempo)
select c_cvge,c_cvst,c_hrin
from historia where c_cont=0 and
d_fech=curdate() and c_cvst<>'login' and c_cvst<>'salir'
order by c_cvge,c_cvst,c_hrin";
    protected string $createNtpDiff         = "create temporary table ntpdiff
select gestor,tiempo,min(c_hrin) as mntp from historia,breaktab
where d_fech = curdate() and gestor = c_cvge and c_hrin > tiempo
group by gestor,tiempo";
    protected string $updateBreakTabDiff    = "update breaktab,ntpdiff 
    set ntp = mntp,
diff = (time_to_sec(mntp)-time_to_sec(ntpdiff.tiempo))/60
where ntpdiff.gestor = breaktab.gestor 
and ntpdiff.tiempo = breaktab.tiempo";
    protected string $dropBreakTemp        = "drop table if exists breaktemp";
    protected string $createBreakTemp   = "create table breaktemp
select gestor,sum(diff) as sum_diff from breaktab
group by gestor";
    protected string $queryBreakTab           = "SELECT * FROM breaktab";

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return array|false
     */
    public function getBreaks()
    {
        $this->pdo->query($this->createBreakTab);
        $this->pdo->query($this->insertBreakTab);
        $this->pdo->query($this->createNtpDiff);
        $this->pdo->query($this->updateBreakTabDiff);
        $this->pdo->query($this->dropBreakTemp);
        $this->pdo->query($this->createBreakTemp);
        $sta    = $this->pdo->query($this->queryBreakTab);
        return $sta->fetchAll(PDO::FETCH_ASSOC);
    }
}