<?php

namespace cobra_salsa;

use PDO;
use PDOException;

/**
 * Description of BigClass
 *
 * @author gmbs
 */
class QuickPorHoraClass
{
    protected PDO $pdo;
    protected string $queryPorHora  = "select c_cvge as 'gestor', 
    sum((C_CARG is not null)&&(C_CARG<>'')) as 'contactos',
count(1)as 'gestiones', 
sum(n_prom>0) as 'promesas',
concat(round(sum((C_CARG is not null)&&(C_CARG<>''))/count(1)*100),'%') as 'porciento'
from historia
where D_FECH = curdate()
and C_HRIN > time(now()) - interval 1 hour
and c_cont>0
and c_msge is null
and c_cniv is null
group by C_CVGE";

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return array|false
     */
    public function getPorHora()
    {
        try {
            $sta = $this->pdo->query($this->queryPorHora);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
        return $sta->fetchAll(PDO::FETCH_ASSOC);
    }
}