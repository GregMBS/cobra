<?php

namespace app;

/**
 * Description of BigClass
 *
 * @author gmbs
 */
class QuickAhoraClass extends BaseClass
{
    /**
     *
     * @var string
     */
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
    
    /**
     *
     * @var string
     */
    protected $insertAhora          = "insert into ahora (gestor,cuenta,nombre,cliente,camp,status,
tiempo,queue,sistema,logout,id_cuenta) 
SELECT distinct userlog.gestor,numero_de_cuenta,nombre_deudor,
rslice.cliente, status_de_credito,rslice.status_aarsa,
time_to_sec(timediff(now(),timeuser))/60,
ifnull(queuelist.status_aarsa,if(rslice.status_aarsa<>'','ELASTIX','BREAK')),
usuario,userlog.gestor,id_cuenta
FROM userlog
left join rslice on user=userlog.gestor
left JOIN nombres use index (grupo) ON userlog.gestor=iniciales
LEFT JOIN queuelist ON nombres.camp=queuelist.camp and user=userlog.gestor
WHERE userlog.gestor IS NOT NULL
and fechahora>curdate()
order by nombres.tipo desc,gestor";
    
    /**
     *
     * @var string
     */
    protected $createLogins         = "create temporary table logins
select c_cvge,min(c_hrin) as tlog from historia
where d_fech=curdate() and c_cvst='login'
group by c_cvge";
    
    /**
     *
     * @var string
     */
    protected $updateAhoraLogins    = "update ahora,logins set login=tlog where c_cvge=gestor";
    
    /**
     *
     * @var string
     */
    protected $createLogouts        = "create temporary table logouts
select c_cvge,max(c_hrin) as tlogo from historia 
where d_fech=curdate() and c_cvst='salir' 
group by c_cvge";
    
    /**
     *
     * @var string
     */
    protected $updateAhoraLogouts   = "update ahora,logouts set logout=tlogo where c_cvge=gestor";
    
    /**
     *
     * @var string
     */
    protected $createBreakstat      = "create temporary table breakstat
select c_cvge,max(auto) as mau from historia
where d_fech=curdate() and c_cont=0
group by c_cvge";
    
    /**
     *
     * @var string
     */
    protected $updateAhoraBreakstat = "update ahora,breakstat,historia set status=c_cvst
where breakstat.c_cvge=gestor and historia.auto=mau and queue='BREAK'";
    
    /**
     *
     * @var string
     */
    protected $queryAhora           = "SELECT * FROM ahora";

    /**
     * 
     * @return array
     */
    public function getAhora()
    {
        $this->pdo->query($this->createAhora);
        $this->pdo->query($this->insertAhora);
        $this->pdo->query($this->createLogins);
        $this->pdo->query($this->updateAhoraLogins);
        $this->pdo->query($this->createLogouts);
        $this->pdo->query($this->updateAhoraLogouts);
        $this->pdo->query($this->createBreakstat);
        $this->pdo->query($this->updateAhoraBreakstat);
        $sta    = $this->pdo->query($this->queryAhora);
        $result = $sta->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}