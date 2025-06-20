<?php

namespace cobra_salsa;

use PDO;
use PDOStatement;

/**
 * Description of BigClass
 *
 * @author gmbs
 */
class QuickAhoraClass
{
    /** @var PDO $pdo */
    protected $pdo;
    protected $createAhora          = "CREATE TEMPORARY TABLE  `ahora` (
  `auto` int(11) NOT NULL AUTO_INCREMENT,
  `gestor` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `cuenta` varchar(255) COLLATE utf8_spanish_ci,
  `nombre` varchar(255) COLLATE utf8_spanish_ci,
  `cliente` varchar(255) COLLATE utf8_spanish_ci,
  `camp` varchar(255) COLLATE utf8_spanish_ci,
  `status` varchar(255) COLLATE utf8_spanish_ci,
  `tiempo` int(11),
  `queue` varchar(255) COLLATE utf8_spanish_ci,
  `sistema` varchar(255) COLLATE utf8_spanish_ci,
  `login` varchar(255) COLLATE utf8_spanish_ci,
  `logout` varchar(255) COLLATE utf8_spanish_ci,
  `id_cuenta` int(11),
  PRIMARY KEY (`auto`)
)";
    protected $insertAhora          = "insert into ahora (gestor,cuenta,nombre,cliente,camp,status,
tiempo,queue,sistema,logout,id_cuenta) 
SELECT distinct userlog.gestor,numero_de_cuenta,nombre_deudor,
resumen.cliente, status_de_credito,resumen.status_aarsa,
time_to_sec(timediff(now(),timelock))/60,
ifnull(queuelist.status_aarsa,if(resumen.status_aarsa<>'','ELASTIX','BREAK')),
usuario,userlog.gestor,id_cuenta
FROM userlog
left join resumen on locker=userlog.gestor
left JOIN nombres ON userlog.gestor=iniciales
LEFT JOIN queuelist ON nombres.camp=queuelist.camp and locker=userlog.gestor
WHERE userlog.gestor IS NOT NULL
and fechahora>curdate()";
    protected $createLogins         = "create temporary table logins
select c_cvge,min(c_hrin) as tlog from historia
where d_fech=curdate()
group by c_cvge";
    protected $updateAhoraLogins    = "update ahora,logins set login=tlog where c_cvge=gestor;";
    protected $createLogouts        = "create temporary table logouts
select c_cvge,max(c_hrin) as tlogo from historia 
where d_fech=curdate() and c_cont = 0 and c_cvst <> 'login'
group by c_cvge";
    protected $updateAhoraLogouts   = "update ahora,logouts set logout=tlogo where c_cvge=gestor and tlogo > login";
    protected $cleanAhoraLogouts   = "update ahora,logouts set logout=gestor where c_cvge=gestor AND status <> 'salir'";
    protected $createBreakstat      = "create temporary table breakstat
select c_cvge,max(auto) as mau from historia
where d_fech=curdate() and c_cont=0
group by c_cvge;";
    protected $updateAhoraBreakstat = "update ahora,breakstat,historia set status=c_cvst
where breakstat.c_cvge=gestor and historia.auto=mau and queue='BREAK'";
    protected $queryAhora           = "SELECT * FROM ahora";

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return PDOStatement
     */
    public function getAhora()
    {
        $this->pdo->query($this->createAhora);
        $this->pdo->query($this->insertAhora);
        $this->pdo->query($this->createLogins);
        $this->pdo->query($this->updateAhoraLogins);
        $this->pdo->query($this->createLogouts);
        $this->pdo->query($this->updateAhoraLogouts);
        $this->pdo->query($this->cleanAhoraLogouts);
        $this->pdo->query($this->createBreakstat);
        $this->pdo->query($this->updateAhoraBreakstat);
        $sta    = $this->pdo->query($this->queryAhora);
        /** @var PDOStatement $result */
        $result = $sta->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}