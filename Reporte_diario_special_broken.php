<?php
require_once 'Spreadsheet/Excel/Writer.php';
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
	$now=date("Y-m-d");
$adjust='';
//last day sunday	
//$adjust='-interval 2 day';
//last day saturday	
$adjust='-interval 1 day';

$querydrop="DROP TABLE IF EXISTS	`cobra`.`gmbtemp`;";
$querymake="CREATE TABLE `cobra`.`gmbtemp` (
  `gestor` varchar(255)  NOT NULL,
  `pagando` decimal(10,2) ,
  `liquidado` decimal(10,2) ,
  `vigente` decimal(10,2) ,
  `vencido` decimal(10,2) ,
  `meta` decimal(10,2)  DEFAULT '0.01',
  `metap` decimal(10,2) ,
  `negociado` decimal(10,2)  DEFAULT '0.01',
  `cumplimentop` decimal(10,2) ,
  `pronostico` decimal(10,2) ,
  `pronosticop` decimal(10,2) ,
  PRIMARY KEY (`gestor`)
)
CHARACTER SET utf8 COLLATE utf8_spanish_ci;
";
$querynames="insert into gmbtemp (gestor) select distinct c_cvge from historia 
where greatest(d_prom1,d_prom2)>last_day(curdate()-interval 1 month)".$adjust." 
order by c_cvge;";
$querylist="select gestor from gmbtemp order by gestor;";
$querydrop2="DROP TABLE IF EXISTS `cobra`.`gmbtemp2`;";
$querymake2="CREATE TABLE `cobra`.`gmbtemp2` (
  `cliente` varchar(255)  NOT NULL,
  `pagando` decimal(10,2) ,
  `liquidado` decimal(10,2) ,
  `vigente` decimal(10,2) ,
  `vencido` decimal(10,2) ,
  `meta` decimal(10,2)  DEFAULT '0.01',
  `metap` decimal(10,2) ,
  `negociado` decimal(10,2)  DEFAULT '0.01',
  `cumplimentop` decimal(10,2) ,
  `pronostico` decimal(10,2) ,
  `pronosticop` decimal(10,2) ,
  PRIMARY KEY (`cliente`)
)
CHARACTER SET utf8 COLLATE utf8_spanish_ci;
";
$querynames2="insert into gmbtemp2 (cliente) 
select distinct c_cvba from historia 
where d_fech>last_day(curdate()-interval 1 month)".$adjust."  
order by c_cvba;";
$querylist2="select cliente from gmbtemp2 order by cliente;";
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
and pagos.fecha between d_fech and greatest(d_prom1,d_prom2)+interval 2 day
and status_aarsa not like 'PAGO TOTAL%' and confirmado=0
and not exists 
(select auto from historia h3 
where h1.c_cont=h3.c_cont and h3.auto<h1.auto and h3.n_prom>0 
and pagos.fecha between h3.d_fech and greatest(d_prom1,d_prom2)+interval 2 day
and monto>=least(h3.n_prom1,if(h3.n_prom2>0,h3.n_prom2,h3.n_prom1))
) 
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
and pagos.fecha between d_fech and greatest(d_prom1,d_prom2)+interval 2 day
and status_aarsa like 'PAGO TOTAL%' and confirmado=0
and not exists 
(select auto from historia h3 
where h1.c_cont=h3.c_cont and h3.auto<h1.auto and h3.n_prom>0 
and pagos.fecha between h3.d_fech and greatest(d_prom1,d_prom2)+interval 2 day
and monto>=least(h3.n_prom1,if(h3.n_prom2>0,h3.n_prom2,h3.n_prom1))
) 
order by h1.c_cont,pagos.fecha
;";
$queryvencido="select h1.auto,concat(h1.CUENTA,' ') as 'numero_de_cuenta',resumen.cliente,
status_de_credito as 'campa&ntilde;a',producto,subproducto,q(status_aarsa) as 'queue',status_aarsa,
nombre_deudor,n_prom as 'Imp. Neg.',n_prom1 as 'pp1',d_prom1 as 'fpp1',n_prom2 as 'pp2',d_prom2 as 'fpp2',
folio,c_cvge as 'gestor'
from historia h1 join resumen on c_cont=id_cuenta 
left join folios on c_cont=id and not exists (select folio from folios f2 where folios.id=f2.id and folios.folio<f2.folio)
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) 
and d_prom<curdate()
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
and d_prom>=curdate()
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>last_day(curdate()-interval 1 month)".$adjust." );";
$querydrop3="DROP TABLE IF EXISTS `cobra`.`gmbtemp3`;";
$querymake3="CREATE TABLE `cobra`.`gmbtemp3` (
  `cliente` varchar(50)  NOT NULL,
  `sdc` varchar(50)  NOT NULL,
  `pagando` decimal(10,2) ,
  `liquidado` decimal(10,2) ,
  `vigente` decimal(10,2) ,
  `vencido` decimal(10,2) ,
  `meta` decimal(10,2)  DEFAULT '0.01',
  `metap` decimal(10,2) ,
  `negociado` decimal(10,2)  DEFAULT '0.01',
  `cumplimentop` decimal(10,2) ,
  `pronostico` decimal(10,2) ,
  `pronosticop` decimal(10,2) ,
  PRIMARY KEY (`cliente`,`sdc`)
)
CHARACTER SET utf8 COLLATE utf8_spanish_ci;
";
$querynames3="insert into gmbtemp3 (cliente,sdc) 
select distinct c_cvba,who(status_de_credito) from historia,resumen 
where d_fech>last_day(curdate()-interval 1 month)".$adjust." 
and c_cont=id_cuenta
order by c_cvba,status_de_credito;";
$querylist3="select cliente,sdc from gmbtemp3 order by cliente,sdc;";
$querydrop4="DROP TABLE IF EXISTS `cobra`.`gmbtemp4`;";
$querymake4="CREATE TABLE `cobra`.`gmbtemp4` (
  `cliente` varchar(50)  NOT NULL,
  `sdc` varchar(50)  NOT NULL,
  `producto` varchar(50)  NOT NULL,
  `subproducto` varchar(50)  NOT NULL,
  `pagando` decimal(10,2) ,
  `liquidado` decimal(10,2) ,
  `vigente` decimal(10,2) ,
  `vencido` decimal(10,2) ,
  `meta` decimal(10,2)  DEFAULT '0.01',
  `metap` decimal(10,2) ,
  `negociado` decimal(10,2)  DEFAULT '0.01',
  `cumplimentop` decimal(10,2) ,
  `pronostico` decimal(10,2) ,
  `pronosticop` decimal(10,2) ,
  PRIMARY KEY (`cliente`,`sdc`,`producto`,`subproducto`)
)
CHARACTER SET utf8 COLLATE utf8_spanish_ci;
";
$querynames4="insert into gmbtemp4 (cliente,sdc,producto,subproducto) 
select distinct c_cvba,who(status_de_credito),producto,subproducto from historia,resumen 
where d_fech>last_day(curdate()-interval 1 month)".$adjust." 
and c_cont=id_cuenta
order by c_cvba,status_de_credito,producto,subproducto;";
$querylist4="select cliente,sdc,producto,subproducto 
from gmbtemp4
order by cliente,sdc,producto,subproducto;";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Promesas y Pagos</title>

<style type="text/css">
       body {font-family: verdana,arial, helvetica, sans-serif;
        font-size: 10pt; background-color: white;color:black;}
       .hidebox {display:none}
       div {clear:both}
       table {border: 1pt solid black;background-color: white;
       border-collapse: collapse;}
 	tr:hover {background-color: yellow0;}
       th,td {border: 1pt solid black;background-color: white;}
       th,.heavy {font-weight:bold;}
	   a:link {color:blue;}   
	   a:visited {color:green;}   
	   a:hover {color:red;}   
	   a:active {color:yellow;}   
       div {border: 1pt black solid;background-color:white;}
  td {border: 1pt solid black;background-color: white;}
       .visitable td {border:0; background-color: transparent;width:auto;}
    .deudor {color: red;}
    .visit {color: green;}
       #ahora td {font-size: 85%}
ul.tabs 
	{ list-style-type: none; padding: 0; margin: 0;} 
ul.tabs li 
	{ float: left; padding: 0; margin: 0; padding-top: 0; 
	background: url(tab_right.png) no-repeat right top; margin-right: 1px; } 
ul.tabs li a 
	{ display: block; padding: 0px 10px; 
	color: white; text-decoration: none; background: 
	url(tab_left.png) no-repeat left top; } 
ul.tabs li a:hover 
	{ color: yellow;}		
       th,.heavy {font-weight:bold;font-size:10pt;}
       .light {text-align:right;}
       .rightnow {
		   background-color:orange;
       }
       .callcenter {
		   background-color:white;
		   }
       .admin {
		   background-color:gray;
		   }
       .late {
		   background-color:yellow; font-weight:bold; 
		   text-decoration:blink;}
       .verylate,.lazy {
		   background-color:red; font-weight:bold; 
		   text-decoration:blink;}
</style>
<script type="text/javascript" src="dom-drag.js"></script>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/JavaScript">
function paging(pageid) {
	pageida=pageid+"a";
document.getElementById("gestores").style.display="none";
document.getElementById("gestoresa").style.fontWeight="normal";
document.getElementById("clientes").style.display="none";
document.getElementById("clientesa").style.fontWeight="normal";
document.getElementById("productos").style.display="none";
document.getElementById("productosa").style.fontWeight="normal";
document.getElementById("pagos").style.display="none";
document.getElementById("pagosa").style.fontWeight="normal";
document.getElementById("liquidados").style.display="none";
document.getElementById("liquidadosa").style.fontWeight="normal";
document.getElementById("vigentes").style.display="none";
document.getElementById("vigentesa").style.fontWeight="normal";
document.getElementById("vencidos").style.display="none";
document.getElementById("vencidosa").style.fontWeight="normal";
document.getElementById(pageid).style.display="block";
document.getElementById(pageida).style.fontWeight="bold";
}
</SCRIPT>
</head>
<body onLoad="paging('pagos');">
<div class="clearbox">
	<UL class='tabs'>
<!--		<LI><A id='gestoresa' onClick="paging('gestores')">GESTORES</A></LI>
		<LI><A id='clientesa' onClick="paging('clientes')">CLIENTES</A></LI>
		<LI><A id='productosa' onClick="paging('productos')">PRODUCTOS</A></LI>
-->		<LI><A id='pagosa' onClick="paging('pagos')">PAGOS</A></LI>
		<LI><A id='liquidadosa' onClick="paging('liquidados')">LIQUIDADOS</A></LI>
		<LI><A id='vigentesa' onClick="paging('vigentes')">VIGENTES</A></LI>
		<LI><A id='vencidosa' onClick="paging('vencidos')">VENCIDOS</A></LI>
	</UL>
</div>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<div id='productos'>
<?php
mysql_query($querydrop4);
mysql_query($querymake4);
$error='';
mysql_query($querynames4) or die(mysql_error());
//while (stripos($error,'deadlock')) {mysql_query($querynames4);$error=mysql_error();}
$queryprepa="update gmbtemp4 set pagando=0,liquidado=0,vencido=0,vigente=0;";
mysql_query($queryprepa) or die(mysql_error());	
$i=0;
$result=mysql_query($querylist4);
while ($answer=mysql_fetch_row($result)) 
{
$cliente[$i]=$answer[0];	
$sdc[$i]=$answer[1];	
$producto[$i]=$answer[2];	
$subproducto[$i]=$answer[3];
$i++;	
	}
for ($j=0;$j<$i;$j++) {
	$cli=$cliente[$j];	
	$sd=$sdc[$j];	
	$pro=$producto[$j];	
	$sub=$subproducto[$j];	
$querypup1a="update gmbtemp4 set pagando=
(select ifnull(sum(monto),0)
from pagos,resumen
where pagos.id_cuenta=resumen.id_cuenta
and pagos.fecha>last_day(curdate()-interval 1 month)".$adjust." 
and status_aarsa not like 'PAGO TOTAL%' and confirmado=0
and resumen.cliente='".$cli."' and who(status_de_credito)='".$sd."'
and producto='".$pro."' and subproducto='".$sub."')
where cliente='".$cli."' and sdc='".$sd."'
and producto='".$pro."' and subproducto='".$sub."'
";	
mysql_query($querypup1a) or die(mysql_error());
$querypup2a="update gmbtemp4 set vencido=
(select ifnull(sum(greatest((n_prom1*(d_prom1<curdate()))+(n_prom2*(d_prom2<curdate()))-monto,0)),0) as vencido
from historia h1,pagos,resumen
where c_cont=pagos.id_cuenta and c_cont=resumen.id_cuenta
and n_prom>0 and greatest(d_prom1,d_prom2)>last_day(curdate()-interval 1 month)".$adjust." 
and d_fech<=fecha
and pagos.fecha>last_day(curdate()-interval 1 month)".$adjust."
and status_aarsa not like 'PAGO TOTAL%' and confirmado=0
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0  and h2.d_fech<=fecha) 
and c_cvba='".$cli."' and who(status_de_credito)='".$sd."'
and producto='".$pro."' and subproducto='".$sub."')
where cliente='".$cli."' and sdc='".$sd."'
and producto='".$pro."' and subproducto='".$sub."'
";	
mysql_query($querypup2a) or die(mysql_error());
$querypup3a="update gmbtemp4 set vigente=
(select ifnull(sum(ifnull(n_prom1*(d_prom1>=curdate()),0)+ifnull(n_prom2*(d_prom2>=curdate()),0)-greatest(ifnull(monto,0)-ifnull(n_prom1*(d_prom1<curdate()),0)-ifnull(n_prom2*(d_prom2<curdate()),0),0)),0)
from historia h1,pagos,resumen
where c_cont=pagos.id_cuenta and c_cont=resumen.id_cuenta
and n_prom>0 and greatest(d_prom1,d_prom2)>last_day(curdate()-interval 1 month)".$adjust." 
and d_fech<=fecha
and pagos.fecha>last_day(curdate()-interval 1 month)".$adjust."
and status_aarsa not like 'PAGO TOTAL%' and confirmado=0
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0  and h2.d_fech<=fecha) 
and c_cvba='".$cli."' and who(status_de_credito)='".$sd."'
and producto='".$pro."' and subproducto='".$sub."')
where cliente='".$cli."' and sdc='".$sd."'
and producto='".$pro."' and subproducto='".$sub."'
";	
mysql_query($querypup3a) or die(mysql_error());
$querylupa="update gmbtemp4 set liquidado=
(select ifnull(sum(monto),0)
from pagos,resumen
where pagos.id_cuenta=resumen.id_cuenta
and pagos.fecha>last_day(curdate()-interval 1 month)".$adjust." 
and status_aarsa like 'PAGO TOTAL%' and confirmado=0
and resumen.cliente='".$cli."' and who(status_de_credito)='".$sd."'
and producto='".$pro."' and subproducto='".$sub."')
where cliente='".$cli."' and sdc='".$sd."'
and producto='".$pro."' and subproducto='".$sub."'
";	
mysql_query($querylupa) or die(mysql_error());
$queryveup1a="update gmbtemp4 set vencido=vencido+
(select ifnull(sum(n_prom1),0)
from historia h1,resumen
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) and d_prom1<curdate()
and c_cont=id_cuenta
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>last_day(curdate()-interval 1 month)".$adjust.") 
and c_cvba='".$cli."' and who(status_de_credito)='".$sd."'
and producto='".$pro."' and subproducto='".$sub."')
where cliente='".$cli."' and sdc='".$sd."'
and producto='".$pro."' and subproducto='".$sub."'
";	
mysql_query($queryveup1a) or die(mysql_error());
$queryveup2a="update gmbtemp4 set vencido=vencido+
(select ifnull(sum(n_prom2),0)
from historia h1,resumen
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) and d_prom2<curdate()
and c_cont=id_cuenta
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>last_day(curdate()-interval 1 month)".$adjust.") 
and c_cvba='".$cli."' and who(status_de_credito)='".$sd."'
and producto='".$pro."' and subproducto='".$sub."')
where cliente='".$cli."' and sdc='".$sd."'
and producto='".$pro."' and subproducto='".$sub."'
";	
mysql_query($queryveup2a) or die(mysql_error());
$queryviupa="update gmbtemp4 set vigente=vigente+
(select ifnull(sum(ifnull(n_prom2*(d_prom2>=curdate()),0)+ifnull(n_prom1*(d_prom1>=curdate()),0)),0)
from historia h1, resumen
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) 
and c_cont=id_cuenta
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>last_day(curdate()-interval 1 month)".$adjust.") 
and c_cvba='".$cli."' and who(status_de_credito)='".$sd."'
and producto='".$pro."' and subproducto='".$sub."')
where cliente='".$cli."' and sdc='".$sd."'
and producto='".$pro."' and subproducto='".$sub."'
";	
mysql_query($queryviupa) or die(mysql_error());
}
$querycalca="update gmbtemp4 g,clientes c
set g.meta=c.meta,metap=(pagando+liquidado)/c.meta,
negociado=(vigente+vencido+pagando+liquidado),
cumplimentop=(pagando+liquidado)/(vigente+vencido+pagando+liquidado),
pronostico=((pagando+liquidado)+(vigente*(pagando+liquidado)/(vigente+vencido+pagando+liquidado))),
pronosticop=((pagando+liquidado)+(vigente*(pagando+liquidado)/(vigente+vencido+pagando+liquidado)))/c.meta
where g.cliente=c.cliente
";
mysql_query($querycalca) or die(mysql_error());
$result2=mysql_query("select * from gmbtemp4 order by cliente;");
$ii=0;
$numberfields = mysql_num_fields($result2);
echo "<table>";
echo "<tr>";
   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result2, $i);
echo "<th>".$var."</th>";
   }
echo "</tr>";
while ($row = mysql_fetch_row($result2)) 
    {
echo "<tr>";
    for ($j=0;$j<$numberfields; $j++) {
	if ($j<4) {echo "<th>".$row[$j]."</th>";}
	else {echo "<td style='text-align:right'>".number_format($row[$j],2)."</td>";}
    }
echo "</tr>";
    }
$result=mysql_query("select '', sum(pagando), sum(liquidado), sum(vigente),
sum(vencido), '', '', sum(negociado)
from gmbtemp3;");
$ii=0;
$numberfields = mysql_num_fields($result);
while ($row = mysql_fetch_row($result)) 
    {
echo "<tr>";
    for ($j=0;$j<$numberfields; $j++) {
	echo "<th style='text-align:right'>".number_format($row[$j],2)."</th>";
    }
echo "</tr>";
    }
?>
</table>
</div>
<div id='clientes'>
<?php
mysql_query($querydrop2);
mysql_query($querymake2);
mysql_query($querynames2) or die(mysql_error());
$result2=mysql_query($querylist2);
while($answer=mysql_fetch_row($result2))
{
$queryprepa="update gmbtemp2 set pagando=0,liquidado=0,vencido=0,vigente=0
where cliente='".$answer[0]."';";
mysql_query($queryprepa) or die(mysql_error());	
$querypup1a="update gmbtemp2 set pagando=
(select ifnull(sum(monto),0)
from historia h1,pagos,resumen
where c_cont=pagos.id_cuenta and c_cont=resumen.id_cuenta
and n_prom>0 and greatest(d_prom1,d_prom2)>last_day(curdate()-interval 1 month)".$adjust." 
and d_fech<=fecha
and status_aarsa not like 'PAGO TOTAL%' and confirmado=0
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0  and h2.d_fech<=fecha) 
and c_cvba='".$answer[0]."')
where cliente='".$answer[0]."'
";	
mysql_query($querypup1a) or die(mysql_error());
$querypup2a="update gmbtemp2 set vencido=
(select ifnull(sum(greatest((n_prom1*(d_prom1<curdate()))+(n_prom2*(d_prom2<curdate()))-monto,0)),0) as vencido
from historia h1,pagos,resumen
where c_cont=pagos.id_cuenta and c_cont=resumen.id_cuenta
and n_prom>0 and greatest(d_prom1,d_prom2)>last_day(curdate()-interval 1 month)".$adjust." 
and d_fech<=fecha
and pagos.fecha>last_day(curdate()-interval 1 month)".$adjust."
and status_aarsa not like 'PAGO TOTAL%' and confirmado=0
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0  and h2.d_fech<=fecha) 
and c_cvba='".$answer[0]."')
where cliente='".$answer[0]."'
";	
mysql_query($querypup2a) or die(mysql_error());
$querypup3a="update gmbtemp2 set vigente=
(select ifnull(sum(ifnull(n_prom1*(d_prom1>=curdate()),0)+ifnull(n_prom2*(d_prom2>=curdate()),0)-greatest(ifnull(monto,0)-ifnull(n_prom1*(d_prom1<curdate()),0)-ifnull(n_prom2*(d_prom2<curdate()),0),0)),0)
from historia h1,pagos,resumen
where c_cont=pagos.id_cuenta and c_cont=resumen.id_cuenta
and n_prom>0 and greatest(d_prom1,d_prom2)>last_day(curdate()-interval 1 month)".$adjust." 
and d_fech<=fecha
and pagos.fecha>last_day(curdate()-interval 1 month)".$adjust."
and status_aarsa not like 'PAGO TOTAL%' and confirmado=0
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0  and h2.d_fech<=fecha) 
and c_cvba='".$answer[0]."')
where cliente='".$answer[0]."'
";	
mysql_query($querypup3a) or die(mysql_error());
$querylupa="update gmbtemp2 set liquidado=
(select ifnull(sum(monto),0)
from historia h1,pagos,resumen
where c_cont=pagos.id_cuenta and c_cont=resumen.id_cuenta
and n_prom>0 and greatest(d_prom1,d_prom2)>last_day(curdate()-interval 1 month)".$adjust." 
and d_fech<=fecha
and pagos.fecha>last_day(curdate()-interval 1 month)".$adjust."
and status_aarsa like 'PAGO TOTAL%'  and confirmado=0
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0  and h2.d_fech<=fecha) 
and c_cvba='".$answer[0]."')
where cliente='".$answer[0]."'
";	
mysql_query($querylupa) or die(mysql_error());
$queryveup1a="update gmbtemp2 set vencido=vencido+
(select ifnull(sum(n_prom1),0)
from historia h1
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month)".$adjust." 
and d_prom1<curdate()
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>last_day(curdate()-interval 1 month)".$adjust.") 
and c_cvba='".$answer[0]."')
where cliente='".$answer[0]."'
";	
mysql_query($queryveup1a) or die(mysql_error());
$queryveup2a="update gmbtemp2 set vencido=vencido+
(select ifnull(sum(n_prom2),0)
from historia h1
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) and d_prom2<curdate()
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>last_day(curdate()-interval 1 month)".$adjust.") 
and c_cvba='".$answer[0]."')
where cliente='".$answer[0]."'
";	
mysql_query($queryveup2a) or die(mysql_error());
$queryviupa="update gmbtemp2 set vigente=vigente+
(select ifnull(sum(ifnull(n_prom2*(d_prom2>=curdate()),0)+ifnull(n_prom1*(d_prom1>=curdate()),0)),0)
from historia h1
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) 
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>last_day(curdate()-interval 1 month)".$adjust.") 
and c_cvba='".$answer[0]."')
where cliente='".$answer[0]."'
";	
mysql_query($queryviupa) or die(mysql_error());
}
$querycalca="update gmbtemp2 g,clientes c
set g.meta=c.meta,metap=(pagando+liquidado)/c.meta,
negociado=(vigente+vencido+pagando+liquidado),
cumplimentop=(pagando+liquidado)/(vigente+vencido+pagando+liquidado),
pronostico=((pagando+liquidado)+(vigente*(pagando+liquidado)/(vigente+vencido+pagando+liquidado))),
pronosticop=((pagando+liquidado)+(vigente*(pagando+liquidado)/(vigente+vencido+pagando+liquidado)))/c.meta
where g.cliente=c.cliente
";
mysql_query($querycalca) or die(mysql_error());
$result2=mysql_query("select * from gmbtemp2 order by cliente;");
$ii=0;
$numberfields = mysql_num_fields($result2);
echo "<table>";
echo "<tr>";
   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result2, $i);
echo "<th>".$var."</th>";
   }
echo "</tr>";
while ($row = mysql_fetch_row($result2)) 
    {
echo "<tr>";
    for ($j=0;$j<$numberfields; $j++) {
	if ($j==0) {echo "<th>".$row[$j]."</th>";}
	else {echo "<td style='text-align:right'>".number_format($row[$j],2)."</td>";}
    }
echo "</tr>";
    }
$result=mysql_query("select '', sum(pagando), sum(liquidado), sum(vigente),
sum(vencido), '', '', sum(negociado)
from gmbtemp2;");
$ii=0;
$numberfields = mysql_num_fields($result);
while ($row = mysql_fetch_row($result)) 
    {
echo "<tr>";
    for ($j=0;$j<$numberfields; $j++) {
	echo "<th style='text-align:right'>".number_format($row[$j],2)."</th>";
    }
echo "</tr>";
    }
?>
</table>
</div>
<div id='gestores'>
<?php
mysql_query($querydrop);
mysql_query($querymake);
mysql_query($querynames);
$result=mysql_query($querylist);
while($answer=mysql_fetch_row($result))
{
$queryprep="update gmbtemp set pagando=0,liquidado=0,vencido=0,vigente=0
where gestor='".$answer[0]."';";
mysql_query($queryprep) or die(mysql_error());	
$querypup1="update gmbtemp set pagando=
(select ifnull(sum(monto),0)
from historia h1,pagos,resumen
where c_cont=pagos.id_cuenta and c_cont=resumen.id_cuenta
and n_prom>0 
and pagos.fecha>last_day(curdate()-interval 1 month)".$adjust."
and pagos.fecha between d_fech and greatest(d_prom1,d_prom2)+interval 2 day
and status_aarsa not like 'PAGO TOTAL%' and confirmado=0
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0 
and pagos.fecha between h2.d_fech and greatest(h2.d_prom1,h2.d_prom2)+interval 2 day) 
and c_cvge='".$answer[0]."')
where gestor='".$answer[0]."'
";	
mysql_query($querypup1) or die(mysql_error());
$querypup2="update gmbtemp set vencido=
(select ifnull(sum(greatest((n_prom1*(d_prom1<curdate()))+(n_prom2*(d_prom2<curdate()))-monto,0)),0) as vencido
from historia h1,pagos,resumen
where c_cont=pagos.id_cuenta and c_cont=resumen.id_cuenta
and n_prom>0 and d_fech>last_day(curdate()-interval 1 month) and d_fech<=fecha
and pagos.fecha>last_day(curdate()-interval 1 month)".$adjust."
and status_aarsa not like 'PAGO TOTAL%' and confirmado=0
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0  and h2.d_fech<=fecha) 
and c_cvge='".$answer[0]."')
where gestor='".$answer[0]."'
";	
mysql_query($querypup2) or die(mysql_error());
$querypup3="update gmbtemp set vigente=
(select ifnull(sum(ifnull(n_prom1*(d_prom1>=curdate()),0)+ifnull(n_prom2*(d_prom2>=curdate()),0)-greatest(ifnull(monto,0)-ifnull(n_prom1*(d_prom1<curdate()),0)-ifnull(n_prom2*(d_prom2<curdate()),0),0)),0)
from historia h1,pagos,resumen
where c_cont=pagos.id_cuenta and c_cont=resumen.id_cuenta
and n_prom>0 and d_fech>last_day(curdate()-interval 1 month) and d_fech<=fecha
and pagos.fecha>last_day(curdate()-interval 1 month)".$adjust."
and status_aarsa not like 'PAGO TOTAL%' and confirmado=0
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0  and h2.d_fech<=fecha) 
and c_cvge='".$answer[0]."')
where gestor='".$answer[0]."'
";	
mysql_query($querypup3) or die(mysql_error());
$querylup="update gmbtemp set liquidado=
(select ifnull(sum(monto),0)
from historia h1,pagos,resumen
where c_cont=pagos.id_cuenta and c_cont=resumen.id_cuenta
and n_prom>0 and greatest(d_prom1,d_prom2)>last_day(curdate()-interval 1 month)".$adjust." 
and d_fech<=fecha
and status_aarsa like 'PAGO TOTAL%'  and confirmado=0
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0  and h2.d_fech<=fecha) 
and c_cvge='".$answer[0]."')
where gestor='".$answer[0]."'
";	
mysql_query($querylup) or die(mysql_error());
$queryveup1="update gmbtemp set vencido=vencido+
(select ifnull(sum(n_prom1),0)
from historia h1
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) and d_prom1<curdate()
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>last_day(curdate()-interval 1 month)".$adjust.") 
and c_cvge='".$answer[0]."')
where gestor='".$answer[0]."'
";	
mysql_query($queryveup1) or die(mysql_error());
$queryveup2="update gmbtemp set vencido=vencido+
(select ifnull(sum(n_prom2),0)
from historia h1
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) and d_prom2<curdate()
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>last_day(curdate()-interval 1 month)".$adjust.") 
and c_cvge='".$answer[0]."')
where gestor='".$answer[0]."'
";	
mysql_query($queryveup2) or die(mysql_error());
$queryviup="update gmbtemp set vigente=vigente+
(select ifnull(sum(ifnull(n_prom2*(d_prom2>=curdate()),0)+ifnull(n_prom1*(d_prom1>=curdate()),0)),0)
from historia h1
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) 
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>last_day(curdate()-interval 1 month)".$adjust.") 
and c_cvge='".$answer[0]."') 
where gestor='".$answer[0]."'
";	
mysql_query($queryviup) or die(mysql_error());
}
$querycalc="update gmbtemp g,nombres n
set g.meta=n.meta,metap=(pagando+liquidado)/n.meta,
negociado=(vigente+vencido+pagando+liquidado),
cumplimentop=(pagando+liquidado)/(vigente+vencido+pagando+liquidado),
pronostico=((pagando+liquidado)+(vigente*(pagando+liquidado)/(vigente+vencido+pagando+liquidado))),
pronosticop=((pagando+liquidado)+(vigente*(pagando+liquidado)/(vigente+vencido+pagando+liquidado)))/n.meta
where gestor=iniciales and n.meta>0;
";
mysql_query($querycalc) or die(mysql_error());
$result=mysql_query("select * from gmbtemp order by gestor;");
$ii=0;
$numberfields = mysql_num_fields($result);
echo "<table>";
echo "<tr>";
   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
echo "<th>".$var."</th>";
   }
echo "</tr>";
while ($row = mysql_fetch_row($result)) 
    {
echo "<tr>";
    for ($j=0;$j<$numberfields; $j++) {
	if ($j==0) {echo "<th>".$row[$j]."</th>";}
	else {echo "<td style='text-align:right'>".number_format($row[$j],2)."</td>";}
    }
echo "</tr>";
    }
$result=mysql_query("select '', sum(pagando), sum(liquidado), sum(vigente),
sum(vencido), '', '', sum(negociado)
from gmbtemp;");
$ii=0;
$numberfields = mysql_num_fields($result);
while ($row = mysql_fetch_row($result)) 
    {
echo "<tr>";
    for ($j=0;$j<$numberfields; $j++) {
	echo "<th style='text-align:right'>".number_format($row[$j],2)."</th>";
    }
echo "</tr>";
    }
?>
</table>
</div>
<div id='pagos'>
<?php
// pagos
$id=0;
$result=mysql_query($queryparcial);
$ii=0;
$numberfields = mysql_num_fields($result);
echo "<table>";
echo "<tr>";
   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
echo "<th>".$var."</th>";
   }
?>   
<th>pmt2</th>
<th>fpmt2</th>
<th>pmt3</th>
<th>fpmt3</th>
<th>suma vig.</th>
<th>suma venc.</th>
<th>suma pag.</th>
</tr>
<?php
$j=0;
$k=0;
$sp=0;
$npr=0;
$npve=0;
while ($row = mysql_fetch_array($result)) 
    { 
		if ($row[0]<>$id) {
for ($kk=$k;$kk<$j+4;$kk=$kk+1) {echo "<td></td>";}
if ($k>0) {
	$leftover=max($npve-$sp,0);
	echo "<td>".($npr-$sp-$leftover)."</td>";
//	echo "<td>test1</td>";
	echo "<td>".$leftover."</td>";
	echo "<td>".$sp."</td>";
	}			
			$sp=$row['pmt1'];
			$npr=$row['Imp. Neg.'];
			$npve=$row['pp1'];
if ($row['fpp2']<$now) {$npve=$npr;}
if ($row['fpp1']>=$now) {$npve=0;}

echo "<tr>";
			$id=$row[0];
    for ($j=0;$j<$numberfields; $j++) {
	echo "<td>".$row[$j]."</td>";
    }
	$k=$j;
	}
	else {
	echo "<td>".$row['pmt1']."</td>";
	$sp=$sp+$row['pmt1'];
	echo "<td>".$row['fpmt1']."</td>";
			$k=$k+2;
	}
    }
while ($k<$j+4) {
	$k=$k+2;
	echo "<td></td>";
	}
for ($kk=$k;$kk<$j+6;$kk=$kk+1) {echo "<td></td>";}
if ($k>0) {
	$leftover=max($npve-$sp,0);
	echo "<td>".($npr-$sp-$leftover)."</td>";
//	echo "<td>test1</td>";
	echo "<td>".$leftover."</td>";
	echo "<td>".$sp."</td>";
	}			
?>
</table>
</div>
<div id='liquidados'>
<?php
// liquidados

$result=mysql_query($queryliquid);
$ii=0;
$numberfields = mysql_num_fields($result);
echo "<table>";
echo "<tr>";
   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
echo "<th>".$var."</th>";
   }
?>   
<th>pmt2</th>
<th>fpmt2</th>
<th>pmt3</th>
<th>fpmt3</th>
<th>suma vig.</th>
<th>suma venc.</th>
<th>suma pag.</th>
</tr>
<?php
$j=0;
$k=0;
$sp=0;
while ($row = mysql_fetch_array($result)) 
    { 
		if ($row[0]<>$id) {
for ($kk=$k;$kk<$j+4;$kk=$kk+1) {echo "<td></td>";}
if ($k>0) {
	echo "<td></td>";
	echo "<td></td>";
	echo "<td>".$sp."</td>";
	}			
			$sp=$row['pmt1'];
echo "<tr>";
			$id=$row[0];
    for ($j=0;$j<$numberfields; $j++) {
	echo "<td>".$row[$j]."</td>";
    }
	$k=$j;
	}
	else {
	echo "<td>".$row['pmt1']."</td>";
	$sp=$sp+$row['pmt1'];
	echo "<td>".$row['fpmt1']."</td>";
			$k=$k+2;
	}
}
for ($kk=$k;$kk<$j+4;$kk=$kk+1) {echo "<td></td>";}
	echo "<td></td>";
	echo "<td></td>";
	echo "<td>".$sp."</td>";
?>
</table>
</div>
<div id='vencidos'>
<?php

// vencidos

$result=mysql_query($queryvencido);
$ii=0;
$numberfields = mysql_num_fields($result);
echo "<table>";
echo "<tr>";
   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
echo "<th>".$var."</th>";
}
?>   
<th>pmt1</th>
<th>fpmt1</th>
<th>pmt2</th>
<th>fpmt2</th>
<th>pmt3</th>
<th>fpmt3</th>
<th>suma vig.</th>
<th>suma venc.</th>
<th>suma pag.</th>
</tr>
<?php
while ($row = mysql_fetch_row($result)) 
    {
		if ($row[0]<>$id) {
			$id=$row[0];
    for ($j=0;$j<$numberfields; $j++) {
	echo "<td>".$row[$j]."</td>";
    }
	$k=$j;
	}
	else {
	echo "<td>".$row[$j-2]."</td>";
	echo "<td>".$row[$j-1]."</td>";
			$k+$k+2;
	}
?>   
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<?php
$queryplus="select if(d_prom2<curdate(),n_prom,n_prom1),
if(d_prom2>=curdate(),n_prom2,0) from historia 
where auto=".$id;
$resultplus=mysql_query($queryplus);
while ($answerplus=mysql_fetch_row($resultplus)) {
	echo "<td>".$answerplus[1]."</td>";
	echo "<td>".$answerplus[0]."</td>";
echo "<td></td>";
echo "</tr>";
    }
}
?>
</table>
</div>
<div id='vigentes'>
<?php
// vigentes
$result=mysql_query($queryvigente);
$ii=0;
$numberfields = mysql_num_fields($result);
echo "<table>";
echo "<tr>";
   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
echo "<th>".$var."</th>";
   }
?>   
<th>pmt1</th>
<th>fpmt1</th>
<th>pmt2</th>
<th>fpmt2</th>
<th>pmt3</th>
<th>fpmt3</th>
<th>suma vig.</th>
<th>suma venc.</th>
<th>suma pag.</th>
</tr>
<?php
while ($row = mysql_fetch_row($result)) 
    {
		if ($row[0]<>$id) {
echo "<tr>";
			$id=$row[0];
    for ($j=0;$j<$numberfields; $j++) {
	echo "<td>".$row[$j]."</td>";
    }
	$k=$j;
	}
	else {
	echo "<td>".$row[$j-2]."</td>";
	echo "<td>".$row[$j-1]."</td>";
			$k+$k+2;
	}
?>   
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<?php
$queryplus="select n_prom,0 from historia 
where auto=".$id;
$resultplus=mysql_query($queryplus);
while ($answerplus=mysql_fetch_row($resultplus)) {
	echo "<td>".$answerplus[0]."</td>";
	echo "<td>".$answerplus[1]."</td>";
echo "<td></td>";
echo "</tr>";
    }
    }
echo "</table></body></html>";
}
}
mysql_close();
?>
