<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of ComparativoClass
 *
 * @author gmbs
 */
class ComparativoClass extends BaseClass {

    /**
     * 
     * @return array
     */
    public function getReport() {
        $querymain = "select c_cvba, mdf, sum(gest) as sg, sum(contact) as sc,
    sum(prom) as sp, count(distinct c_cvge) as cg,
    count(distinct c_cvge,hour(c_hrin)) as ch
from (
select c_cvba,month(d_fech) as mdf,c_cont,1 as tot,
max(if(c_msge is null,1,0)) as gest,
max(if(c_carg <>'',1,0)) as contact,
max(if(n_prom >0,1,0)) as prom,c_cvge,c_hrin
from historia where d_fech>=curdate()-interval 3 month 
and day(d_fech)<day(curdate())
and c_cont>0
group by c_cvba,mdf,c_cont,c_cvge,c_hrin) as tmp
group by c_cvba,mdf;
";
        $result = $this->pdo->query($querymain);
        return $result;
    }

}
