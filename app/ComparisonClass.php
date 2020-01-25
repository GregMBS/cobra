<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use PDO;

/**
 * Description of ComparisonClass
 *
 * @author gmbs
 */
class ComparisonClass extends BaseClass {

    /**
     * 
     * @return array
     */
    public function getReport() {
        $querymain = <<<SQL
select c_cvba, mdf, sum(gest) as sg, sum(contact) as sc,
    sum(prom) as sp, count(distinct c_cvge) as cg,
    count(distinct c_cvge,hour(c_hrin)) as ch
from (
select c_cvba,month(d_fech) as mdf,c_cont,1 as tot,
max(if(c_msge is null,1,0)) as gest,
max(if(c_carg <>'',1,0)) as contact,
max(if(n_prom >0,1,0)) as prom,c_cvge,c_hrin
from historia where d_fech >= :start 
and day(d_fech) < :startDay
and c_cont>0
group by c_cvba,mdf,c_cont,c_cvge,c_hrin) as tmp
group by c_cvba,mdf
SQL;
        $start = date('Y-m-d', strtotime('3 months ago'));
        $startDay = date('j', strtotime('3 months ago'));
        $stc = $this->pdo->prepare($querymain);
        $stc->bindValue(':start', $start);
        $stc->bindValue(':startDay', $startDay);
        $stc->execute();
        return $stc->fetchAll(PDO::FETCH_ASSOC);
    }

}
