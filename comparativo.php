<?php
require_once 'classes/pdoConnect.php';
$pdoc      = new pdoConnect();
$pdo       = $pdoc->dbConnectAdmin();
$capt      = filter_input(INPUT_GET, 'capt');
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
group by c_cont,mdf) as tmp
group by c_cvba,mdf;
";
$result    = $pdo->query($querymain);
require_once 'views/comparativoView.php';