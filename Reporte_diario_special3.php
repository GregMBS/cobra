<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
	$now=date("Y-m-d");
$adjust='';
//last day sunday	
//$adjust='-interval 2 day';
//last day saturday	
//$adjust='-interval 1 day';

$queryparcial="select h1.auto,concat(h1.CUENTA,' ') as 'numero_de_cuenta',resumen.cliente,
status_de_credito as 'campa&ntilde;a',producto,subproducto,q(status_aarsa) as 'queue',status_aarsa,
nombre_deudor,n_prom as 'Imp. Neg.',n_prom1 as 'pp1',d_prom1 as 'fpp1',n_prom2 as 'pp2',d_prom2 as 'fpp2',
folio,c_cvge as 'gestor',
monto as 'pmt1',pagos.fecha as 'fpmt1'
from historia h1
join pagos on c_cont=pagos.id_cuenta
join resumen on c_cont=resumen.id_cuenta
left join folios on c_cont=id and not exists (select folio from folios f2 where folios.id=f2.id and folios.folio<f2.folio)
where n_prom>0 and greatest(d_prom1,d_prom2)>last_day(curdate()-interval 1 month)-interval 2 day  
and pagos.fecha>last_day(curdate()-interval 1 month)".$adjust."
and pagos.fecha between d_fech and greatest(d_prom1,d_prom2)
and status_aarsa not like 'PAGO TOTAL%' and confirmado=0
and not exists 
(select auto from historia h3 
where h1.c_cont=h3.c_cont and h3.auto<h1.auto and h3.n_prom>0 
and pagos.fecha between h3.d_fech and greatest(d_prom1,d_prom2)
and monto>=least(h3.n_prom1,if(h3.n_prom2>0,h3.n_prom2,h3.n_prom1))  and c_cvst like 'PROMESA DE%'
) and c_cvst like 'PROMESA DE%'
order by h1.c_cont,pagos.fecha
;";
$queryliquid="select h1.auto,concat(h1.CUENTA,' ') as 'numero_de_cuenta',resumen.cliente,
status_de_credito as 'campa&ntilde;a',producto,subproducto,q(status_aarsa) as 'queue',status_aarsa,
nombre_deudor,n_prom as 'Imp. Neg.',n_prom1 as 'pp1',d_prom1 as 'fpp1',n_prom2 as 'pp2',d_prom2 as 'fpp2',
folio,c_cvge as 'gestor',
monto as 'pmt1',pagos.fecha as 'fpmt1'
from historia h1
join pagos on c_cont=pagos.id_cuenta
join resumen on c_cont=resumen.id_cuenta
left join folios on c_cont=id and not exists (select folio from folios f2 where folios.id=f2.id and folios.folio<f2.folio)
where n_prom>0 and greatest(d_prom1,d_prom2)>last_day(curdate()-interval 1 month)-interval 2 day  
and pagos.fecha>last_day(curdate()-interval 1 month)".$adjust."
and pagos.fecha between d_fech and greatest(d_prom1,d_prom2)
and status_aarsa like 'PAGO TOTAL%' and confirmado=0
and not exists 
(select auto from historia h3 
where h1.c_cont=h3.c_cont and h3.auto<h1.auto and h3.n_prom>0 
and pagos.fecha between h3.d_fech and greatest(d_prom1,d_prom2)
and monto>=least(h3.n_prom1,if(h3.n_prom2>0,h3.n_prom2,h3.n_prom1))  and c_cvst like 'PROMESA DE%'
) and c_cvst like 'PROMESA DE%'
order by h1.c_cont,pagos.fecha
;";
$queryvencido="select h1.auto,concat(h1.CUENTA,' ') as 'numero_de_cuenta',resumen.cliente,
status_de_credito as 'campa&ntilde;a',producto,subproducto,q(status_aarsa) as 'queue',status_aarsa,
nombre_deudor,n_prom as 'Imp. Neg.',n_prom1 as 'pp1',d_prom1 as 'fpp1',n_prom2 as 'pp2',d_prom2 as 'fpp2',
folio,c_cvge as 'gestor'
from historia h1 join resumen on c_cont=id_cuenta 
left join folios on c_cont=id and not exists (select folio from folios f2 where folios.id=f2.id and folios.folio<f2.folio)
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) 
and d_prom<curdate() and c_cvst like 'PROMESA DE%'
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>last_day(curdate()-interval 1 month)".$adjust." ) 
;";
$queryvigente="select h1.auto,concat(h1.CUENTA,' ') as 'numero_de_cuenta',resumen.cliente,
status_de_credito as 'campa&ntilde;a',producto,subproducto,q(status_aarsa) as 'queue',status_aarsa,
nombre_deudor,n_prom as 'Imp. Neg.',n_prom1 as 'pp1',d_prom1 as 'fpp1',n_prom2 as 'pp2',d_prom2 as 'fpp2',
folio,c_cvge as 'gestor'
from historia h1 join resumen on c_cont=id_cuenta 
left join folios on c_cont=id and not exists (select folio from folios f2 where folios.id=f2.id and folios.folio<f2.folio)
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) 
and d_prom>=curdate() and c_cvst like 'PROMESA DE%'
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>last_day(curdate()-interval 1 month)".$adjust." );";
$querydrop="DROP TABLE IF EXISTS `cobra`.`gmbtemp`;";
mysql_query($querydrop) or die (mysql_error());
$querymake="CREATE TABLE `cobra`.`gmbtemp` (
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
mysql_query($querymake) or die (mysql_error());
$querycalc="update gmbtemp g
set g.meta=1,metap=(pago)/1,
negociado=(vigente+vencido+pago),
cumplimentop=(pago)/(vigente+vencido+pago),
pronostico=((pago)+(vigente*(pago)/(vigente+vencido+pago))),
pronosticop=((pago)+(vigente*(pago)/(vigente+vencido+pago)))/1
";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd"><head>
<meta content="text/html" http-equiv="content-type" charset="utf-8">
<title>Promesas y Pagos</title>
			<link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="vendor/components/jquery/jquery,js" type="text/javascript"></script> 
			<script src="vendor/components/jqueryui/jquery-ui,js" type="text/javascript"></script> 
			<script src="DT/media/js/jquery.dataTables.min.js" type="text/javascript"></script> 
</head>
<body>
<script>
	$(function() {
		$( "#tab" ).tabs();
		$( "body" ).css("font-size", "10pt");
	} );
</script>	
<div class="tab">
	<UL>
		<LI><A href='#pagos'>PAGOS</A></LI>
		<LI><A href='#liquidados'>LIQUIDADOS</A></LI>
		<LI><A href='#vigentes'>VIGENTES</A></LI>
		<LI><A href='#vencidos'>VENCIDOS</A></LI>
		<LI><A href='#analytica'>ANALYTICA</A></LI>
	</UL>
<div id='pagos'>
	PAGOS
</div>
<div id='liquidados'>
	LIQUIDADOS
</div>
<div id='vigentes'>
	VIGENTES
</div>
<div id='vencidos'>
	VENCIDOS
</div>
<div id='analytica'>
	ANALYTICA
<?php 
echo "</div>";
echo "</div>";
echo "</body></html>";
}
}
mysql_close();
?>
