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
and pagos.fecha between d_fech and greatest(d_prom1,d_prom2)+interval 2 day
and status_aarsa not like 'PAGO TOTAL%' and confirmado=0
and not exists 
(select auto from historia h3 
where h1.c_cont=h3.c_cont and h3.auto<h1.auto and h3.n_prom>0 
and pagos.fecha between h3.d_fech and greatest(d_prom1,d_prom2)+interval 2 day
and monto>=least(h3.n_prom1,if(h3.n_prom2>0,h3.n_prom2,h3.n_prom1))
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
and pagos.fecha between d_fech and greatest(d_prom1,d_prom2)+interval 2 day
and status_aarsa like 'PAGO TOTAL%' and confirmado=0
and not exists 
(select auto from historia h3 
where h1.c_cont=h3.c_cont and h3.auto<h1.auto and h3.n_prom>0 
and pagos.fecha between h3.d_fech and greatest(d_prom1,d_prom2)+interval 2 day
and monto>=least(h3.n_prom1,if(h3.n_prom2>0,h3.n_prom2,h3.n_prom1))
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
document.getElementById("pagos").style.display="none";
document.getElementById("pagosa").style.fontWeight="normal";
document.getElementById("liquidados").style.display="none";
document.getElementById("liquidadosa").style.fontWeight="normal";
document.getElementById("vigentes").style.display="none";
document.getElementById("vigentesa").style.fontWeight="normal";
document.getElementById("vencidos").style.display="none";
document.getElementById("vencidosa").style.fontWeight="normal";
document.getElementById("analytica").style.display="none";
document.getElementById("analyticaa").style.fontWeight="normal";
document.getElementById(pageid).style.display="block";
document.getElementById(pageida).style.fontWeight="bold";
}
</SCRIPT>
</head>
<body onLoad="paging('pagos');">
<div class="clearbox">
	<UL class='tabs'>
		<LI><A id='pagosa' onClick="paging('pagos')">PAGOS</A></LI>
		<LI><A id='liquidadosa' onClick="paging('liquidados')">LIQUIDADOS</A></LI>
		<LI><A id='vigentesa' onClick="paging('vigentes')">VIGENTES</A></LI>
		<LI><A id='vencidosa' onClick="paging('vencidos')">VENCIDOS</A></LI>
		<LI><A id='analyticaa' onClick="paging('analytica')">ANALYTICA</A></LI>
	</UL>
</div>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
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
$qi="insert into gmbtemp (gestor,cliente,sdc,producto,subproducto,vigente,vencido,pago)
values ('".$row[15]."','".$row[2]."','".$row[3].
"','".$row[4]."','".$row[5].
"',0,0,".$row[16].")";
mysql_query($qi) or die (mysql_error());

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
$qi="insert into gmbtemp (gestor,cliente,sdc,producto,subproducto,vigente,vencido,pago)
values ('".$row[15]."','".$row[2]."','".$row[3].
"','".$row[4]."','".$row[5].
"',0,0,".$row[16].")";
mysql_query($qi) or die (mysql_error());

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
$queryplus="select if(d_prom2<(curdate()),n_prom,n_prom1),
if(d_prom2>=(curdate()),n_prom2,0) from historia 
where auto=".$id;
$resultplus=mysql_query($queryplus);
while ($answerplus=mysql_fetch_row($resultplus)) {
	echo "<td>".$answerplus[1]."</td>";
	echo "<td>".$answerplus[0]."</td>";
echo "<td></td>";
echo "</tr>";
$qi="insert into gmbtemp (gestor,cliente,sdc,producto,subproducto,vigente,vencido,pago)
values ('".$row[15]."','".$row[2]."','".$row[3].
"','".$row[4]."','".$row[5].
"',".$answerplus[1].",".$answerplus[0].",0)";
mysql_query($qi) or die (mysql_error());
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
$qi="insert into gmbtemp (gestor,cliente,sdc,producto,subproducto,vigente,vencido,pago)
values ('".$row[15]."','".$row[2]."','".$row[3].
"','".$row[4]."','".$row[5].
"',".$answerplus[0].",".$answerplus[1].",0)";
mysql_query($qi) or die (mysql_error());
    }
    }
?>    
</table>
</div>
<div id='analytica'>
<?php
// analytica
mysql_query($querycalc) or die (mysql_error());
echo "<p>Por Cliente</p>";
$querya="select cliente,sum(pago),sum(vigente),sum(vencido)
from gmbtemp group by cliente;";
$result=mysql_query($querya);
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
	echo "<td>".$row[$j]."</td>";}
    }
echo "</tr>";
echo "</table>";
echo "<p>Por Gestor</p>"; 
$querya="select gestor,sum(pago),sum(vigente),sum(vencido)
from gmbtemp group by gestor;";
$result=mysql_query($querya);
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
	echo "<td>".$row[$j]."</td>";}
    }
echo "</tr>";
echo "</table>";
echo "<p>Por Segmento</p>"; 
$querya="select cliente,sdc,sum(pago),sum(vigente),sum(vencido)
from gmbtemp group by cliente,sdc;";
$result=mysql_query($querya);
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
	echo "<td>".$row[$j]."</td>";}
    }
echo "</tr>";
echo "</table>";
echo "<p>Por Producto</p>";
$querya="select cliente,sdc,producto,subproducto,sum(pago),sum(vigente),sum(vencido)
from gmbtemp group by cliente,sdc,producto,subproducto;";
$result=mysql_query($querya);
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
	echo "<td>".$row[$j]."</td>";}
    }
echo "</tr>";
echo "</table>";
echo"</body></html>";
}
}
mysql_close();
?>
