<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {
	header('Location: index.php');
}
}
function last_business_day($year,$month) 
{ 
  $lbd = cal_days_in_month(CAL_GREGORIAN, $month, $year); 
  $wday = date("N",strtotime("$year-$month-$lbd")); 
  if ($wday == 7) $lbd -= 2; 
  if ($wday == 6) $lbd--; 
  $lbd = date("Y-m-d",strtotime("$year-$month-$lbd")); 
  return $lbd; 
}
$lm=strtotime("-31 day");
$lbd0=last_business_day(date("Y",$lm),date("n",$lm));
$lbd1=last_business_day(date("Y"),date("n"));
$adjust='';
//last day sunday	
$adjust='-interval 2 day';
//last day saturday	
//$adjust='-interval 1 day';
mysql_query('DROP TABLE IF EXISTS rrotas;');
$querya="create table rrotas
select numero_de_cuenta,resumen.cliente,status_de_credito,status_aarsa,producto,subproducto,
nombre_deudor,pagos.auto as pauto,monto,fecha,historia.auto as hauto,
n_prom1,d_prom1,n_prom2,d_prom2,c_cvge,'pagos' as semaforo,resumen.id_cuenta 
from pagos
join resumen using (id_cuenta)
left join historia on c_cont=pagos.id_cuenta 
and fecha between d_fech and (d_prom+interval 2 day) and c_cvst like 'promesa de%'
where fecha>'$lbd0'
and status_de_credito not regexp '-'
;";
mysql_query($querya) or die("ERROR PRMa - ".mysql_error());
//die('check rrotas');
mysql_query('DROP TABLE IF EXISTS rotad;');
$queryb="create table rotad select pauto from rrotas
group by pauto having count(1)>1;";
mysql_query($queryb) or die("ERROR PRMb - ".mysql_error());
$queryc="select pauto from rotad;";
$resultc=mysql_query($queryc) or die("ERROR PRMc - ".mysql_error());
while ($answerc=mysql_fetch_row($resultc)) {
	$pauto=$answerc[0];
	$queryd="delete from rrotas where pauto = $pauto order by fecha limit 1;";
	mysql_query($queryd) or die("ERROR PRMd - ".mysql_error());
}
mysql_query('DROP TABLE IF EXISTS xrotas;');
$queryp="create table xrotas 
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
where n_prom>0 and d_fech>'".$lbd0."' and status_de_credito not like '%inactivo'
and d_prom<curdate() and c_cvst like 'PROMESA DE%'
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>'".$lbd0."') 
;";
$queryvigente="select h1.auto,concat(h1.CUENTA,' ') as 'numero_de_cuenta',resumen.cliente,
status_de_credito as 'campa&ntilde;a',producto,subproducto,q(status_aarsa) as 'queue',status_aarsa,
nombre_deudor,n_prom as 'Imp. Neg.',n_prom1 as 'pp1',d_prom1 as 'fpp1',n_prom2 as 'pp2',d_prom2 as 'fpp2',
folio,c_cvge as 'gestor'
from historia h1 join resumen on c_cont=id_cuenta 
left join folios on c_cont=id and not exists (select folio from folios f2 where folios.id=f2.id and folios.folio<f2.folio)
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) and status_de_credito not like '%inactivo'
and d_prom>=curdate() and c_cvst like 'PROMESA DE%'
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>'".$lbd0."');";
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
	<link rel="Stylesheet" href="css/redmond/jquery-ui.css" />
        <script type="text/javascript" charset="utf8" src="js/jquery-1.5.1.min.js"></script>
        <script type="text/javascript" charset="utf8" src="js/jquery-ui-1.8.13.custom.min.js"></script>
</head>
<body>
<script>
        $(function() {
                $( "#tabs" ).tabs();
                $( "button" ).button();
                $( "button" ).css("vertical-align", "bottom")
                $( "button" ).width("4cm");
                $( "button" ).height("1.6cm");
                $( "body" ).css("font-size", "8pt")
        });
</script>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">
Regressar a la plantilla administrativa
</button><br>
<div id="tabs"> 
        <ul> 
                <li><a href="#pagos">PAGOS</a></li>
                <li><a href="#vigentes">VIGENTES</a></li>
                <li><a href="#vencidos">VENCIDOS</a></li>
                <li><a href="#analytica">ANALÍTICA</a></li>
        </ul> 
<div id='pagos'>
<?php 
// pagos
$id=0;
$result=mysql_query($queryparcial) or die(mysql_error());
$ii=0;
$numberfields = mysql_num_fields($result);
?>
<table class="ui-widget">
<thead class="ui-widget-header">
<tr>
<th>auto</th>
<th>numero_de_cuenta</th>
<th>cliente</th>
<th>campa&ntilde;a</th>
<th>producto</th>
<th>subproducto</th>
<th>queue</th>
<th>status_aarsa</th>
<th>nombre_deudor</th>
<th>Imp. Neg.</th>
<th>pp1</th>
<th>fpp1</th>
<th>pp2</th>
<th>fpp2</th>
<th>folio</th>
<th>gestor</th>
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
</thead>
<tbody class="ui-widget-content">
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
?>
<table class="ui-widget">
<thead class="ui-widget-header">
<tr>
<?php
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
</thead>
<tbody class="ui-widget-content>">
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
</tbody>
</table>
</div>
<div id='vigentes'>
<?php
// vigentes
$result=mysql_query($queryvigente);
$ii=0;
$numberfields = mysql_num_fields($result);
?>
<table class="ui-widget">
<thead class="ui-widget-header">
<tr>
<?php
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
</thead>
<tbody class="ui-widget-content">
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
</tbody>
</table>
</div>
<div id='analytica'>
<h2>Por Cliente</h2>
<?php
// analytica
mysql_query($querycalc) or die (mysql_error());
$querya="select cliente,sum(pago),sum(vigente),sum(vencido)
from gmbtemp group by cliente;";
$result=mysql_query($querya);
$ii=0;
$numberfields = mysql_num_fields($result);
?>
<table class="ui-widget">
<thead class="ui-widget-header">
<tr>
<?php
   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
echo "<th>".$var."</th>";
   }
?>
</tr>
</thead>
<tbody class="ui-widget-content">
<?php
while ($row = mysql_fetch_row($result)) 
    {
echo "<tr>";
    for ($j=0;$j<$numberfields; $j++) {
	echo "<td>".$row[$j]."</td>";}
    }
?>
</tr>
</tbody>
</table>
<h2>Por Gestor</h2>
<?php
$querya="select gestor,sum(pago),sum(vigente),sum(vencido)
from gmbtemp group by gestor;";
$result=mysql_query($querya);
$ii=0;
$numberfields = mysql_num_fields($result);
?>
<table class="ui-widget">
<thead class="ui-widget-header">
<tr>
<?php
   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
echo "<th>".$var."</th>";
   }
?>
</tr>
</thead>
<tbody class="ui-widget-content">
<?php
while ($row = mysql_fetch_row($result)) 
    {
echo "<tr>";
    for ($j=0;$j<$numberfields; $j++) {
	echo "<td>".$row[$j]."</td>";}
    }
?>
</tr>
</tbody>
</table>
<h2>Por Segmento</h2>
<?php
$querya="select cliente,substring_index(sdc,'-',1),sum(pago),sum(vigente),sum(vencido)
from gmbtemp group by cliente,substring_index(sdc,'-',1);";
$result=mysql_query($querya);
$ii=0;
$numberfields = mysql_num_fields($result);
?>   
<table class="ui-widget">
<thead class="ui-widget-header">
<tr>
<?php
   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
echo "<th>".$var."</th>";
   }
?>
</tr>
</thead>
<tbody class="ui-widget-content">
<?php
while ($row = mysql_fetch_row($result)) 
    {
echo "<tr>";
    for ($j=0;$j<$numberfields; $j++) {
	echo "<td>".$row[$j]."</td>";}
    }
?>
</tr>
</tbody>
</table>
</div>
</body>
</html>
