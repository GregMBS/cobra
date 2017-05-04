<?php

use gregmbs\cobra\PdoClass;
use gregmbs\cobra\ReporteDiarioClass;

require_once 'classes/PdoClass.php';
require_once 'classes/ReporteDiarioClass.php';

$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$capt = $pdoc->capt;
$rd = new ReporteDiarioClass($pdo);

$querya  = "create temporary table rrotas
select numero_de_cuenta,resumen.cliente,status_de_credito,status_aarsa,producto,subproducto,
nombre_deudor,pagos.auto as pauto,monto,fecha,historia.auto as hauto,
n_prom1,d_prom1,n_prom2,d_prom2,c_cvge,'pagos' as semaforo,resumen.id_cuenta 
from pagos
join resumen using (id_cuenta)
left join historia on c_cont=pagos.id_cuenta 
and fecha between d_fech and (d_prom+interval 2 day) and c_cvst like 'promesa de%'
where fecha > :lbd0
and fecha <= :lbd1
and confirmado=0";
$sta     = $pdo->prepare($querya);
$sta->bindParam(':lbd0', $lbd0);
$sta->bindParam(':lbd1', $lbd1);
$sta->execute();
$queryb  = "create temporary table rotad select pauto from rrotas
group by pauto having count(1)>1";
$pdo->query($queryb);
$queryc  = "select pauto from rotad";
$resultc = $pdo->query($queryc);
$queryd  = "delete from rrotas where pauto = ;pauto order by fecha limit 1";
$std     = $pdo->prepare($queryd);
foreach ($resultc as $answerc) {
    $pauto = $answerc['pauto'];
    $std->bindParam(':pauto', $pauto);
    $std->execute();
}
$queryp              = "create temporary table xrotas
select * from rrotas where hauto>0";
$pdo->query($queryp);
$queryu              = "update rrotas r,xrotas as x
set r.hauto=x.hauto,r.c_cvge=x.c_cvge,
r.n_prom1=x.n_prom1,r.d_prom1=x.d_prom1,
r.n_prom2=x.n_prom2,r.d_prom2=x.d_prom2
where r.id_cuenta=x.id_cuenta and r.hauto is null";
$pdo->query($queryu);
$queryparcial        = "select hauto,numero_de_cuenta,rrotas.cliente,
status_de_credito,producto,subproducto,q(status_aarsa),status_aarsa,
nombre_deudor,n_prom1+n_prom2,n_prom1,d_prom1,n_prom2,d_prom2,
max(folio),c_cvge,monto,rrotas.fecha from rrotas
left join folios on rrotas.cliente like 'credito%' and cuenta=numero_de_cuenta
group by hauto,rrotas.cliente,numero_de_cuenta,monto,rrotas.fecha
order by rrotas.cliente,status_de_credito,numero_de_cuenta";
$queryvencido        = "select h1.auto,concat(h1.CUENTA,' ') as 'numero_de_cuenta',resumen.cliente,
status_de_credito as 'campa&ntilde;a',producto,subproducto,q(status_aarsa) as 'queue',status_aarsa,
nombre_deudor,n_prom as 'Imp. Neg.',n_prom1 as 'pp1',d_prom1 as 'fpp1',n_prom2 as 'pp2',d_prom2 as 'fpp2',
folio,c_cvge as 'gestor'
from historia h1 join resumen on c_cont=id_cuenta 
left join folios on c_cont=id and not exists (select folio from folios f2 where folios.id=f2.id and folios.folio<f2.folio)
where n_prom>0 and d_fech>'".$lbd0."'
and d_fech<='".$lbd1."' 
and d_prom<'".$lbd1."' and c_cvst like 'PROMESA DE%'
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>'".$lbd0."') 
;";
$queryvigente        = "select h1.auto,concat(h1.CUENTA,' ') as 'numero_de_cuenta',resumen.cliente,
status_de_credito as 'campa&ntilde;a',producto,subproducto,q(status_aarsa) as 'queue',status_aarsa,
nombre_deudor,n_prom as 'Imp. Neg.',n_prom1 as 'pp1',d_prom1 as 'fpp1',n_prom2 as 'pp2',d_prom2 as 'fpp2',
folio,c_cvge as 'gestor'
from historia h1 join resumen on c_cont=id_cuenta 
left join folios on c_cont=id and not exists (select folio from folios f2 where folios.id=f2.id and folios.folio<f2.folio)
where n_prom>0 and d_fech>'".$lbd0."' 
and d_fech<='".$lbd1."' 
and d_prom>='".$lbd1."' and c_cvst like 'PROMESA DE%'
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>'".$lbd0."');";
$querydrop           = "DROP TABLE IF EXISTS `gmbtemp`";
$pdo->query($querydrop);
$querymake           = "CREATE TABLE `gmbtemp` (
  `gestor` varchar(50)  NOT NULL,
  `cliente` varchar(50)  NOT NULL,
  `sdc` varchar(50)  NOT NULL,
  `producto` varchar(50)  NOT NULL,
  `subproducto` varchar(50)  NOT NULL,
  `vigente` decimal(10,2) DEFAULT 0,
  `vencido` decimal(10,2) DEFAULT 0,
  `pago` decimal(10,2) DEFAULT 0,
  `meta` decimal(10,2)  DEFAULT '1',
  `metap` decimal(10,2) ,
  `negociado` decimal(10,2)  DEFAULT '0.01',
  `cumplimentop` decimal(10,2) ,
  `pronostico` decimal(10,2) ,
  `pronosticop` decimal(10,2) 
)
CHARACTER SET utf8 COLLATE utf8_spanish_ci;
";
$pdo->query($querymake);
$querycalc           = "update gmbtemp g
set g.meta=1,metap=(pago)/1,
negociado=(vigente+vencido+pago),
cumplimentop=(pago)/(vigente+vencido+pago),
pronostico=((pago)+(vigente*(pago)/(vigente+vencido+pago))),
pronosticop=((pago)+(vigente*(pago)/(vigente+vencido+pago)))/1
";
include 'views/Reporte_diario_specialView.php';