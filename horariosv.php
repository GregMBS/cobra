<?php
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");
include('admin_hdr.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$queryld="select year(max(d_fech)),month(max(d_fech)),day(max(d_fech)) from historia 
where d_fech>last_day(curdate()-interval 1 month)
and d_fech<=last_day(curdate())
";
$resultld = mysql_query($queryld) or die(mysql_error());
while ($answerld = mysql_fetch_row($resultld)) { 
$yr=$answerld[0];
$mes=$answerld[1];
$dhoy=$answerld[2];
}
$querywd="select sum(fs),sum(ss) from 
(select distinct d_fech,dayofweek(d_fech)>1 and day(d_fech)<16 as fs,
dayofweek(d_fech)>1 and day(d_fech)>15 as ss from historia 
where d_fech>last_day(curdate()-interval 1 month)
and d_fech<=last_day(curdate())) as tmp";
$resultwd = mysql_query($querywd) or die(mysql_error());
while ($answerwd = mysql_fetch_row($resultwd)) { 
$nosun1=$answerwd[0];
$nosun2=$answerwd[1];
$expw1=$answerwd[0]*15;
$expw2=$answerwd[1]*15;
}
$querysum="select year(d_fech),month(d_fech),day(d_fech) from historia 
where d_fech>last_day(curdate()-interval 1 month)
and d_fech<=last_day(curdate())";
$resultld = mysql_query($queryld) or die(mysql_error());
while ($answerld = mysql_fetch_row($resultld)) { 
$yr=$answerld[0];
$mes=$answerld[1];
$dhoy=$answerld[2];
}
$dst='';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Visitas del Mes Actual</title>
<meta http-equiv="refresh" content="900"/>
<style type="text/css">
body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color: #000000;}
        table {border-collapse: collapse;}
       tr:hover {background-color: #ffff00;}
       th {border: 2pt solid #000000;border-collapse: collapse;background-color: #efefef;}
       td {border: 1pt solid #000000;border-collapse: collapse;background-color: #efefef;}
       th,.heavy {font-weight:bold;font-size:10pt;}
       .heavytot {font-weight:bold;font-size:10pt;text-align:right;}
       .light {text-align:right;}
       .zeros {color:red;}
       a {color:black;font-weight:bold;}
       h2 {color:black}
</style>
</head>
<body>
<h2>VISITAS DEL MES ACTUAL</h2>
<table summary="LpH">
<?php 
for ($i=1;$i<=$dhoy;$i++) {
	$tsumt[$i]=0;
	$tsumb[$i]=0;
	$tsumg[$i]=0;
	$tsumgt[$i]=0;
	$tsumpp[$i]=0;
	$tsump[$i]=0;
	$tsumw[$i]=0;
	}
$querynom='select distinct usuaria,iniciales 
from nombres join historia on iniciales=c_visit
where d_fech>last_day(curdate()-interval 1 month)
and d_fech<=last_day(curdate())
order by usuaria';
$resultnom = mysql_query($querynom) or die(mysql_error());
while ($answernom = mysql_fetch_row($resultnom)) {
$visitador=$answernom[0];
$c_visit=$answernom[1];
?>
<thead>
<tr>
<th><?php echo $visitador;?></th>
<?php
for ($i=1;$i<=$dhoy;$i++) {
$lla[$i]=0;
$tlla[$i]=0;
$prom[$i]=0;
$pag[$i]=0;
$lph[$i]=0;
$queryss="select 0,0, 
0,
sum(distinct c_carg<>''),sum(c_cvst like 'PRO% DE%'),count(1)
from historia where c_visit='$c_visit' 
and c_msge is null and c_cont<>'0'
and c_cniv is not null and year(D_FECH)=year(curdate()-interval 1 month) 
and d_fech>last_day(curdate()-interval 1 month)
and d_fech<=last_day(curdate()) 
and day(D_FECH)=$i  group by D_FECH";
$resultss = mysql_query($queryss) or die(mysql_error());
while ($answerss = mysql_fetch_row($resultss)) {
$lla[$i]=$answerss[3];
$tlla[$i]=$answerss[5];
$prom[$i]=$answerss[4];
$lph[$i]=$lla[$i]/($diff[$i]+1/3600);
$sumg=0;
$sumgt=0;
$sumgt1=0;
$sumgt2=0;
$sumt=0;
$sumb=0;
$sumpp=0;
$sump=0;
$sumw=0;
$queryp="select count(1) from pagos join historia using (cuenta) 
where c_visit='$c_visit' 
and fecha>last_day(curdate()-interval 1 month)
and fecha<=last_day(curdate())
and day(fecha)=".$i;
$resultp = mysql_query($queryp) or die(mysql_error());
while ($answerp = mysql_fetch_row($resultp)) {
$pag[$i]=$answerp[0];
}}
$queryco="select count(fechaout) 
from vasign 
where gestor='$c_visit' 
and fechaout>last_day(curdate()-interval 1 month)
and fechaout<last_day(curdate())+interval 1 day
and day(fechaout)=".$i;
$resultco = mysql_query($queryco) or die(mysql_error());
while ($answerco = mysql_fetch_row($resultco)) {
$co[$i]=$answerco[0];
}
$queryci="select count(fechain) 
from vasign 
where gestor='$c_visit' 
and fechain>last_day(curdate()-interval 1 month)
and fechain<last_day(curdate())+interval 1 day
and day(fechain)=".$i;
$resultci = mysql_query($queryci) or die(mysql_error());
while ($answerci = mysql_fetch_row($resultci)) {
$ci[$i]=$answerci[0];
}
$dow=date("w",strtotime($yr."-".$mes."-".$i));
?>
<th><?php echo $day_esp[$dow]." ".$i;?></th>
<?php } ?>
<th>TOTAL</th>
<th>QUIN.1</th>
<th>QUIN.2</th>
</tr>
<tr><td class="heavy">SALIDOS</td>
<?php 
$sumco=0;
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light"><?php if($co[$i]!=0) echo $co[$i];?></td>
<?php
$sumco=$sumco+$co[$i];
$tsumco[$i]=$tsumco[$i]+$co[$i];
?>
<?php } 
?>
<td class="heavy"><?php echo $sumco;?></td>
<tr><td class="heavy">RECIBIDOS</td>
<?php 
$sumci=0;
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light"><?php if($ci[$i]!=0) echo $ci[$i];?></td>
<?php
$sumci=$sumci+$ci[$i];
$tsumci[$i]=$tsumci[$i]+$ci[$i];
?>
<?php } 
?>
<td class="heavy"><?php echo $sumci;?></td>
</tr>
<tr><td class="heavy">VISITAS</td>
<?php 
$sumg=0;
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light<?php if($tlla[$i]==0) {echo ' zeros';};?>">
<?php echo $tlla[$i];?></td>
<?php
$sumgt=$sumgt+$tlla[$i];
$tsumgt[$i]=$tsumgt[$i]+$tlla[$i];
if ($i<16) {
$sumgt1=$sumgt1+$tlla[$i];
$tsumgt1[$i]=$tsumgt1[$i]+$tlla[$i];
}
if ($i>15) {
$sumgt2=$sumgt2+$tlla[$i];
$tsumgt2[$i]=$tsumgt2[$i]+$tlla[$i];
}
?>
<?php } 
?>
<td class="heavy"><?php echo $sumgt;?></td>
<td class="heavy"><?php echo $sumgt1;?></td>
<td class="heavy"><?php echo $sumgt2;?></td>
</tr>
<tr><td class="heavy">CONTACTOS</td>
<?php 
$sumg=0;
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light<?php if($lla[$i]==0) {echo ' zeros';};?>">
<?php echo $lla[$i];?></td>
<?php
$sumg=$sumg+$lla[$i];
$tsumg[$i]=$tsumg[$i]+$lla[$i];
?>
<?php } 
?>
<td class="heavy"><?php echo $sumg;?></td>
</tr>
<tr><td class="heavy">PROMESAS</td>
<?php 
$sumpp=0;
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light<?php if($prom[$i]==0) {echo ' zeros';};?>">
<a href='<?php echo strtolower('pdh.php?capt='.$capt.'&i='.$prom[$i].'&gestor='.$gestor.'&fecha='.$yr.'-'.$mes.'-'.$i);?>'>
<?php echo $prom[$i];?></a></td>
<?php
$sumpp=$sumpp+$prom[$i];
$tsumpp[$i]=$tsumpp[$i]+$prom[$i];
?>
<?php } 
?>
<td class="heavy"><?php echo $sumpp;?></td>
</tr>
<tr><td class="heavy">PAGOS</td>
<?php 
$sump=0;
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light<?php if($pag[$i]==0) {echo ' zeros';};?>"><?php echo $pag[$i];?></td>
<?php
$sump=$sump+$pag[$i];
$tsump[$i]=$tsump[$i]+$pag[$i];
?>
<?php } 
?>
<td class="heavy"><?php echo $sumw;?></td>
</tr>
<tr><td class="heavy">D&Iacute;AS LABORADOS</td>
<?php 
$sumw=0;
for ($i=1;$i<=$dhoy;$i++) {
$work=0;
if ($tlla[$i]>5) {$work=0.5;}
if ($tlla[$i]>9) {$work=1;}
?>
<td class="light"><?php echo $work;?></td>
<?php
$sumw=$sumw+$work;
$tsumw[$i]=$tsumw[$i]+$work;
?>
<?php } 
?>
<td class="heavy"><?php echo $sumw;?></td>
<td class="heavy"><?php echo number_format($sumgt1/($expw1+0.0001)*100,0).'%';?></td>
<td class="heavy"><?php echo number_format($sumgt2/($expw2+0.0001)*100,0).'%';?></td>
</tr>
<tr style="height:2em"></tr>
<?php }
?>
<tr>
<th>TOTAL</th>
<?php
$ttsumt=0;
$ttsumb=0;
$ttsumg=0;
$ttsumco=0;
$ttsumci=0;
$ttsumgt=0;
$ttsumpp=0;
$ttsump=0;
$ttsumw=0;
for ($i=1;$i<=$dhoy;$i++) {
$dow=date("w",strtotime($yr."-".$mes."-".$i));
?>
<th><?php echo $day_esp[$dow]." ".$i;?></th>
<?php } ?>
<th>TOTAL</th>
</tr>
<tr><td class="heavy">ENVIADOS</td>
<?php 
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light"><?php echo $tsumco[$i];?></td>
<?php
$ttsumco=$ttsumco+$tsumco[$i];
?>
<?php } 
?>
<td class="heavy"><?php echo $ttsumco;?></td>
</tr>
<tr><td class="heavy">RECIBIDOS</td>
<?php 
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light"><?php echo $tsumci[$i];?></td>
<?php
$ttsumci=$ttsumci+$tsumci[$i];
?>
<?php } 
?>
<td class="heavy"><?php echo $ttsumci;?></td>
</tr>
<tr><td class="heavy">VISITAS</td>
<?php 
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light"><?php echo $tsumgt[$i];?></td>
<?php
$ttsumgt=$ttsumgt+$tsumgt[$i];
?>
<?php } 
?>
<td class="heavy"><?php echo $ttsumgt;?></td>
</tr>
<tr><td class="heavy">CONTACTOS</td>
<?php 
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light"><?php echo $tsumg[$i];?></td>
<?php
$ttsumg=$ttsumg+$tsumg[$i];
?>
<?php } 
?>
<td class="heavy"><?php echo $ttsumg;?></td>
</tr>
<tr><td class="heavy">PROMESAS</td>
<?php 
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light"><?php echo $tsumpp[$i];?></td>
<?php
$ttsumpp=$ttsumpp+$tsumpp[$i];
?>
<?php } 
?>
<td class="heavy"><?php echo $ttsumpp;?></td>
</tr>
<tr><td class="heavy">PAGOS</td>
<?php 
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light"><?php echo $tsump[$i];?></td>
<?php
$ttsump=$ttsump+$tsump[$i];
?>
<?php } 
?>
<td class="heavy"><?php echo $ttsump;?></td>
</tr>
<tr><td class="heavy">D&Iacute;AS TRABAJADOS</td>
<?php 
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light"><?php echo $tsumw[$i];?></td>
<?php
$ttsumw=$ttsumw+$tsumw[$i];
?>
<?php } 
?>
<td class="heavy"><?php echo $ttsumw;?></td>
</tr>
</table>
</body>
</html>
<?php
} 
}
mysql_close($con);
?>
