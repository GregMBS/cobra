<?php

namespace cobra_salsa;

/**
 * Description of BigClass
 *
 * @author gmbs
 */
class QuickBreaksClass
{
    protected $pdo;
    protected $createBreaktab          = "CREATE TEMPORARY TABLE  `breaktab` (
  `auto` int(11) NOT NULL AUTO_INCREMENT,
  `gestor` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_spanish_ci,
  `tiempo` time,
  `ntp` time,
  `diff` int(11),
  PRIMARY KEY (`auto`)
)";
    protected $insertBreaktab          = "insert into breaktab (gestor,tipo,tiempo)
select c_cvge,c_cvst,c_hrin
from historia where c_cont=0 and
d_fech=curdate() and c_cvst<>'login' and c_cvst<>'salir'
order by c_cvge,c_cvst,c_hrin;";
    protected $createNtpdiff         = "create temporary table ntpdiff
select gestor,tiempo,min(c_hrin) as mntp from historia,breaktab
where d_fech=curdate() and gestor=c_cvge and c_hrin>tiempo
group by gestor,tiempo;";
    protected $updateBreaktabGiff    = "update breaktab,ntpdiff set ntp=mntp,
diff=(time_to_sec(mntp)-time_to_sec(ntpdiff.tiempo))/60
where ntpdiff.gestor=breaktab.gestor and ntpdiff.tiempo=breaktab.tiempo;";
    protected $dropBreaktemp        = "drop table if exists breaktemp;";
    protected $createBreaktemp   = "create table breaktemp
select gestor,sum(diff) as sdiff from breaktab
where tipo<>'junta' group by gestor;";
    protected $queryBreaktab           = "SELECT * FROM breaktab;";

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

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