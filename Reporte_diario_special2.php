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
$querya="create temporary table rrotas
select numero_de_cuenta,resumen.cliente,status_de_credito,status_aarsa,producto,subproducto,
nombre_deudor,pagos.auto as pauto,monto,fecha,historia.auto as hauto,
n_prom1,d_prom1,n_prom2,d_prom2,c_cvge,'pagos' as semaforo,resumen.id_cuenta 
from pagos
join resumen using (id_cuenta)
left join historia on c_cont=pagos.id_cuenta 
and fecha between d_fech and d_prom and c_cvst like 'promesa de%'
where fecha>last_day(curdate()-interval 1 month)
and confirmado=0
;";
mysql_query($querya) or die("ERROR PRMa - ".mysql_error());
$queryb="create temporary table rotad select pauto from rrotas
group by pauto having count(1)>1;";
mysql_query($queryb) or die("ERROR PRMb - ".mysql_error());
$queryc="select pauto from rotad;";
$resultc=mysql_query($queryc) or die("ERROR PRMc - ".mysql_error());
while ($answerc=mysql_fetch_row($resultc)) {
	$pauto=$answerc[0];
	$queryd="delete from rrotas where pauto = $pauto order by fecha limit 1;";
	mysql_query($queryd) or die("ERROR PRMd - ".mysql_error());
}
$queryp="create temporary table xrotas 
select * from rrotas where hauto>0;";
mysql_query($queryp) or die("ERROR PRMp - ".mysql_error());
$queryu="update rrotas r,xrotas as x
set r.hauto=x.hauto,r.c_cvge=x.c_cvge,
r.n_prom1=x.n_prom1,r.d_prom1=x.d_prom1,
r.n_prom2=x.n_prom2,r.d_prom2=x.d_prom2
where r.id_cuenta=x.id_cuenta and r.hauto is null;";
mysql_query($queryu) or die("ERROR PRMu - ".mysql_error());
$queryparcial="select hauto,numero_de_cuenta,rrotas.cliente,
status_de_credito,producto,subproducto,q(status_aarsa),status_aarsa,
nombre_deudor,n_prom1+n_prom2,n_prom1,d_prom1,n_prom2,d_prom2,
max(folio),c_cvge,monto,rrotas.fecha from rrotas
left join folios on rrotas.cliente like 'credito%' and cuenta=numero_de_cuenta
group by hauto,rrotas.cliente,numero_de_cuenta,monto,rrotas.fecha
order by rrotas.cliente,status_de_credito,numero_de_cuenta";
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
echo "<thead>";
echo "<tr>";
   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
echo "<th>".$var."</th>";
   }
?>   
<th>monto2</th>
<th>fecha2</th>
<th>monto3</th>
<th>fecha3</th>
<th>suma vig.</th>
<th>suma venc.</th>
<th>suma pag.</th>
</tr>
</thead>
<tbody>
<?php
$sp=0;
$npr=0;
$npve=0;
$temprow=array(0);
$temprow[22]=0;
$temprow[23]=0;
$temprow[24]=0;
while ($row = mysql_fetch_row($result)) 
    { 
$qi="insert into gmbtemp (gestor,cliente,sdc,producto,subproducto,vigente,vencido,pago)
values ('".$row[15]."','".$row[2]."','".$row[3].
"','".$row[4]."','".$row[5].
"',0,0,".$row[16].")";
mysql_query($qi) or die (mysql_error());
if ($row[0]!=$temprow[0]){
if ($temprow[0]>0) {
echo '<tr>';
   for ($i=0; $i<25 ; $i++ ) {
echo "<td>".$temprow[$i]."</td>";}
echo '</tr>';
}
$temprow = $row;
$temprow[24]=$row[16];
if ($temprow[24]>=$temprow[9]) {$temprow[22]=0;$temprow[23]=0;}
else {	
	$leftover=max($temprow[10]-$temprow[24],0);
	$temprow[22]=$temprow[9]-$temprow[24]-$leftover;
	$temprow[23]=$leftover;
}
   }
else {
	$temprow[24]=$temprow[24]+$row[16];
	if (empty($temprow[18])) {
	$temprow[18]=$row[16];$temprow[19]=$row[17];}
	else {
			if (empty($temprow[20])) {
			$temprow[20]=$row[16];$temprow[21]=$row[17];}
		}
	}
}
if ($temprow[0]>0) {
echo '<tr>';
   for ($i=0; $i<25 ; $i++ ) {
echo "<td>".$temprow[$i]."</td>";}
echo '</tr>';
}
?>
</tbody>
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
<th>monto1</th>
<th>fecha1</th>
<th>monto2</th>
<th>fecha2</th>
<th>monto3</th>
<th>fecha3</th>
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
$querya="select cliente,substring_index(sdc,'-',1),sum(pago),sum(vigente),sum(vencido)
from gmbtemp group by cliente,substring_index(sdc,'-',1);";
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
$querya="select cliente,substring_index(sdc,'-',1),producto,subproducto,sum(pago),sum(vigente),sum(vencido)
from gmbtemp group by cliente,substring_index(sdc,'-',1),producto,subproducto;";
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
