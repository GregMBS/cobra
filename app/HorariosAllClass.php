<?php

namespace app;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Database Class for horarios
 *
 * @author gmbs
 */
class HorariosAllClass extends BaseClass
{
    /**
     * 
     * @param int $dom
     * @return array
     */
    public function getCurrentMain($dom)
    {
        $query = "select count(distinct c_cont) as cuentas,
            sum(c_cvst like 'PROMESA DE%') as promesas,
            count(1) as gestiones,
            count(1)-sum(queue='SIN CONTACTOS') as nocontactos,
            sum(queue='SIN CONTACTOS') as contactos
            from historia
            left join dictamenes on c_cvst=dictamen
            where c_msge is null
            and c_cniv is null
            and D_FECH=last_day(curdate() - interval 1 month) + interval :dom day
            group by D_FECH";
        $stq   = $this->pdo->prepare($query);
        $stq->bindParam(':dom', $dom, \PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @param int $dom
     * @return array
     */
    public function getPagos($dom)
    {
        $query = "select count(1) as ct from pagos
            where fecha=last_day(curdate() - interval 1 month) + interval :dom day";
        $stq   = $this->pdo->prepare($query);
        $stq->bindParam(':dom', $dom, \PDO::PARAM_INT);
        $stq->execute();
        return $stq->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return int
     */
    public function countAccounts()
    {
        $query = "select count(distinct c_cont) as ct
            from historia
            where c_cont>0
            and c_cniv is null and c_msge is null
            and D_FECH>last_day(curdate() - interval 1 month)";
        $stq   = $this->pdo->prepare($query);
        $stq->execute();
        $result = $stq->fetch(\PDO::FETCH_ASSOC);
        return $result['ct'];
    }

    /**
     * 
     * @param int $dom
     * @return int
     */
    public function countAccountsPerDay($dom)
    {
        $query = "select count(distinct c_cont) as ct
            from historia
            where c_cont>0
            and c_cniv is null and c_msge is null
            and D_FECH=last_day(curdate() - interval 1 month) + interval :dom day";
        $stq   = $this->pdo->prepare($query);
        $stq->bindParam(':dom', $dom, \PDO::PARAM_INT);
        $stq->execute();
        $result = $stq->fetch(\PDO::FETCH_ASSOC);
        return $result['ct'];
    }
}