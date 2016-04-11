<?php
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");
include('admin_hdr.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$yr=date('Y');
$mes=date('m');
$dhoy=date('d');
$hoy=date('Y-m-d');
	
$dst='';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Horarios</title>
<meta http-equiv="refresh" content="900"/>
<style type="text/css">
body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color: #000000;}
        table {border-collapse: collapse;}
       tr:hover {background-color: #ffff00;}
       th,td {border: 1pt solid #000000;border-collapse: collapse;background-color: #efefef;}
       th,.heavy {font-weight:bold;font-size:10pt;}
       .heavytot {font-weight:bold;font-size:10pt;text-align:right;}
       .light {text-align:right;}
       .zeros {color:red;}
       a {color:black;font-weight:bold;}
       h2 {color:black}
</style>
</head>
<body>
<h2>HORARIOS</h2>
<table summary="LpH">
<?php 
for ($i=1;$i<=$dhoy;$i++) {
	$tsumt[$i]=0;
	$tsumb[$i]=0;
	$tsumbn[$i]=0;
	$tsumg[$i]=0;
	$tsumgt[$i]=0;
	$tsumct[$i]=0;
	$tsumnct[$i]=0;
	$tsumpp[$i]=0;
	$tsump[$i]=0;
	}
$querynom='select distinct c_cvge,c_cvge from historia
 where d_fech>last_day(curdate() - interval 1 month) 
order by c_cvge limit 100;';
$resultnom = mysql_query($querynom) or die(mysql_error());
while ($answernom = mysql_fetch_row($resultnom)) {
$gestor=$answernom[0];
$c_cvge=$answernom[1];
?>
<thead>
<tr>
<th><a href='<?php echo strtolower('gestor.php?capt='.$capt.'&gestor='.$gestor.'&c_cvge='.$c_cvge);?>'><?php echo $gestor;?></a></th>
<?php
for ($i=1;$i<=$dhoy;$i++) {
$start[$i]=' ';
$stop[$i]=' ';
$diff[$i]=0;
$break[$i]=0;
$bano[$i]=0;
$lla[$i]=0;
$tlla[$i]=0;
$prom[$i]=0;
$pag[$i]=0;
$lph[$i]=0;
$ct[$i]=0;
$nct[$i]=0;
$queryss0="select min(C_HRIN),max(C_HRFI), 
time_to_sec(timediff(max(C_HRFI),min(C_HRIN))) as horas
from historia where c_cvge='".$c_cvge."' 
and c_cniv is null and D_FECH=last_day(curdate() - interval 1 month) + interval $i day
and (c_cont>0 or c_cvst='login')
group by D_FECH";
$resultss0 = mysql_query($queryss0) or die(mysql_error());
while ($answerss0 = mysql_fetch_row($resultss0)) {
$start[$i]=substr($answerss0[0],0,5);
$stop[$i]=substr($answerss0[1],0,5);
$diff[$i]=$answerss0[2];
}
$queryss="select 0,0,0,count(distinct c_cont),sum(c_cvst like 'PRO% DE%'),count(1),
count(1)-sum(queue='SIN CONTACTOS'),sum(queue='SIN CONTACTOS')
from historia 
left join dictamenes on c_cvst=dictamen
where c_cvge='".$c_cvge."' and c_cont>0 
and c_cniv is null and D_FECH=last_day(curdate() - interval 1 month) + interval ".$i." day
group by D_FECH";
$resultss = mysql_query($queryss) or die(mysql_error());
while ($answerss = mysql_fetch_row($resultss)) {
$break[$i]=0;
$queryp = "select c_hrin,time_to_sec(now())-time_to_sec(concat_ws(' ',d_fech,c_hrin)) 
from historia where c_cont=0 and c_cvge='".$c_cvge."'
and d_fech=last_day(curdate() - interval 1 month) + interval $i day 
and c_cvst='braek' order by c_cvge,c_cvst,c_hrin";
$resultp = mysql_query($queryp) or die(mysql_error());
while ($answerp = mysql_fetch_row($resultp)) {
$TIEMPO=$answerp[0];
$DIFF=$answerp[1];
$queryq = "select time_to_sec(min(c_hrin))-time_to_sec('".$TIEMPO."'),min(c_hrin) from historia 
where c_cvge='".$c_cvge."' and d_fech=last_day(curdate() - interval 1 month) + interval $i day
and c_hrin>'".$TIEMPO."';";
$resultq = mysql_query($queryq) or die(mysql_error());
while ($answerq = mysql_fetch_row($resultq)) {
if (!empty($answerq[0])) {
$DIFF=$answerq[0];$NTP=$answerq[1];$break[$i]+=$DIFF;
}
}
}
$bano[$i]=0;
$queryp = "select c_hrin,time_to_sec(now())-time_to_sec(concat_ws(' ',d_fech,c_hrin)) 

from historia where c_cont=0 and c_cvge='".$c_cvge."'
and d_fech=last_day(curdate() - interval 1 month) + interval $i day 
and c_cvst='bano' order by c_cvge,c_cvst,c_hrin";
$resultp = mysql_query($queryp) or die(mysql_error());
while ($answerp = mysql_fetch_row($resultp)) {
$TIEMPO=$answerp[0];
$DIFF=$answerp[1];
$queryq = "select time_to_sec(min(c_hrin))-time_to_sec('".$TIEMPO."'),min(c_hrin) from historia 

where c_cvge='".$c_cvge."' and d_fech=last_day(curdate() - interval 1 month) + interval $i day

and c_hrin>'".$TIEMPO."';";
$resultq = mysql_query($queryq) or die(mysql_error());
while ($answerq = mysql_fetch_row($resultq)) {
if (!empty($answerq[0])) {
$DIFF=$answerq[0];$NTP=$answerq[1];$bano[$i]+=$DIFF;
}
}
}
$lla[$i]=$answerss[3];
$tlla[$i]=$answerss[5];
$ct[$i]=$answerss[6];
$nct[$i]=$answerss[7];
$prom[$i]=$answerss[4];
$lph[$i]=$lla[$i]/($diff[$i]+1/3600);
$sumg=0;
$sumgt=0;
$sumt=0;
$sumb=0;
$sumbn=0;
$sumct=0;
$sumnct=0;
$sumpp=0;
$sump=0;
$queryp="select count(1) from pagos  
where gestor='$gestor' 
and fecha=last_day(curdate() - interval 1 month) + interval $i day";
$resultp = mysql_query($queryp) or die(mysql_error());
while ($answerp = mysql_fetch_row($resultp)) {
$pag[$i]=$answerp[0];
}
}
$dow=date("w",strtotime($yr."-".$mes."-".$i));
?>
<th><?php echo $day_esp[$dow]." ".$i;?></th>
<?php } ?>
<th>TOTAL</th>
</tr>

<tr><td class="heavy">LOGIN</td>
<?php 
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light<?php if($start[$i]=='00:00') {echo ' zeros';};?>"><?php echo $start[$i];?></td>
<?php } ?>
</tr>
<tr><td class="heavy">LOGOUT</td>
<?php 
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light<?php if($stop[$i]=='00:00') {echo ' zeros';};?>"><?php echo $stop[$i];?></td>
<?php
}
?>
</tr>
<tr><td class="heavy">TOTA HORAS</td>
<?php 
$sumt=0;
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light<?php if($diff[$i]==0) {echo ' zeros';};?>"><?php 
$hrs=floor($diff[$i]/3600);
$mins=round(($diff[$i]-$hrs*3600)/60);
echo $hrs.':'.sprintf("%02s",$mins);?></td>
<?php
$sumt=$sumt+$diff[$i];
$tsumt[$i]=$tsumt[$i]+$diff[$i];
}
?>
<td class="heavy"><?php 
$hrs=floor($sumt/3600);
$mins=round(($sumt-$hrs*3600)/60);
echo $hrs.':'.sprintf("%02s",$mins);?></td>
</tr>
<tr><td class="heavy">TIEMPO BREAK</td>
<?php 
$sumb=0;
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light<?php if($break[$i]==0) {echo ' zeros';};?>"><?php 
$hrs=floor($break[$i]/3600);
$mins=round(($break[$i]-$hrs*3600)/60);
echo $hrs.':'.sprintf("%02s",$mins);?></td>
<?php
$sumb=$sumb+$break[$i];
$tsumb[$i]=$tsumb[$i]+$break[$i];
}
?>
<td class="heavy"><?php 
$hrs=floor($sumb/3600);
$mins=round(($sumb-$hrs*3600)/60);
echo $hrs.':'.sprintf("%02s",$mins);?></td>
</tr>
<tr><td class="heavy">TIEMPO BAÑO</td>
<?php 
$sumbn=0;
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light<?php if($bano[$i]==0) {echo ' zeros';};?>"><?php 
$hrs=floor($bano[$i]/3600);
$mins=round(($bano[$i]-$hrs*3600)/60);
echo $hrs.':'.sprintf("%02s",$mins);?></td>
<?php
$sumbn=$sumbn+$bano[$i];
$tsumbn[$i]=$tsumbn[$i]+$bano[$i];
}
?>
<td class="heavy"><?php 
$hrs=floor($sumbn/3600);
$mins=round(($sumbn-$hrs*3600)/60);
echo $hrs.':'.sprintf("%02s",$mins);?></td>
</tr>
<tr><td class="heavy">TOTAL GESTIONES</td>
<?php 
$sumgt=0;
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light<?php if($tlla[$i]==0) {echo ' zeros';};?>">
<a href='<?php echo strtolower('ddh.php?capt='.$capt.'&i='.$tlla[$i].'&gestor='.$gestor.'&fecha='.$yr.'-'.$mes.'-'.$i);?>'>
<?php echo $tlla[$i];?></a></td>
<?php
$sumgt=$sumgt+$tlla[$i];
$tsumgt[$i]=$tsumgt[$i]+$tlla[$i];
?>
<?php } 
?>
<td class="heavy"><?php echo $sumgt;?></td>
</tr>
<tr><td class="heavy">TOTAL CUENTAS</td>
<?php 
$sumg=0;
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light<?php if($lla[$i]==0) {echo ' zeros';};?>">
<a href='<?php echo strtolower('ddh.php?capt='.$capt.'&i='.$lla[$i].'&gestor='.$gestor.'&fecha='.$yr.'-'.$mes.'-'.$i);?>'>
<?php echo $lla[$i];?></a></td>
<?php
}
$querysumg="select count(distinct c_cont)
from historia where c_cvge='$c_cvge' 
 and c_cont>0
and c_cniv is null  
and D_FECH>last_day(curdate() - interval 1 month)";
$resultsumg = mysql_query($querysumg) or die(mysql_error());
while ($answersumg = mysql_fetch_row($resultsumg)) {$sumg=$answersumg[0];}
?>
<td class="heavy"><?php echo $sumg;?></td>
</tr>
<tr><td class="heavy">CONTACTOS</td>
<?php 
$sumct=0;
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light<?php if($ct[$i]==0) {echo ' zeros';};?>"><?php echo $ct[$i];?></td>
<?php
$sumct=$sumct+$ct[$i];
$tsumct[$i]=$tsumct[$i]+$ct[$i];
?>
<?php } 
?>
<td class="heavy"><?php echo $sumct;?></td>
</tr>
<tr><td class="heavy">NO CONTACTOS</td>
<?php 
$sumnct=0;
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light<?php if($nct[$i]==0) {echo ' zeros';};?>"><?php echo $nct[$i];?></td>
<?php
$sumnct=$sumnct+$nct[$i];
$tsumnct[$i]=$tsumnct[$i]+$nct[$i];
?>
<?php } 
?>
<td class="heavy"><?php echo $sumnct;?></td>
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
<td class="heavy"><?php echo $sump;?></td>
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
$ttsumgt=0;
$ttsumct=0;
$ttsumnct=0;
$ttsumpp=0;
$ttsump=0;
for ($i=1;$i<=$dhoy;$i++) {
$dow=date("w",strtotime($yr."-".$mes."-".$i));
?>
<th><?php echo $day_esp[$dow]." ".$i;?></th>
<?php } ?>
<th>TOTAL</th>
</tr>
<tr><td class="heavy">TOTA HORAS</td>
<?php 
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light"><?php echo number_format($tsumt[$i]/3600,0);?></td>
<?php
$ttsumt=$ttsumt+$tsumt[$i]/3600;
}
?>
<td class="heavy"><?php echo number_format($ttsumt,0);?></td>
</tr>
<tr><td class="heavy">TIEMPO MUERTO</td>
<?php 
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light"><?php echo number_format($tsumb[$i]/3600,0);?></td>
<?php
$ttsumb=$ttsumb+$tsumb[$i];
}
?>
<td class="heavy"><?php echo number_format($ttsumb/3600,0);?></td>
</tr>
<tr><td class="heavy">TOTAL GESTIONES</td>
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
<tr><td class="heavy">TOTAL CUENTAS</td>
<?php 
for ($i=1;$i<=$dhoy;$i++) {
$querytsumg="select count(distinct c_cont)
from historia where  c_cvge<>'Milt' and c_cont>0 
and c_cniv is null and D_FECH=last_day(curdate() - interval 1 month) + interval $i day";
$resulttsumg = mysql_query($querytsumg) or die(mysql_error());
while ($answertsumg = mysql_fetch_row($resulttsumg)) {$tsumg=$answertsumg[0];}
?>
<td class="light"><?php echo $tsumg;?></td>
<?php
} 
$queryttsumg="select count(distinct c_cont)
from historia where  c_cvge<>'Milt' and c_cont>0 
and c_cniv is null and D_FECH>last_day(curdate() - interval 1 month)";
$resultttsumg = mysql_query($queryttsumg) or die(mysql_error());
while ($answerttsumg = mysql_fetch_row($resultttsumg)) {$ttsumg=$answerttsumg[0];}
?>
<td class="heavy"><?php echo $ttsumg;?></td>
</tr>
<tr><td class="heavy">CONTACTOS</td>
<?php 
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light"><?php echo $tsumct[$i];?></td>
<?php
$ttsumct=$ttsumct+$tsumct[$i];
?>
<?php } 
?>
<td class="heavy"><?php echo $ttsumct;?></td>
</tr>
<tr><td class="heavy">NO CONTACTOS</td>
<?php 
for ($i=1;$i<=$dhoy;$i++) {
?>
<td class="light"><?php echo $tsumnct[$i];?></td>
<?php
$ttsumnct=$ttsumnct+$tsumnct[$i];
?>
<?php } 
?>
<td class="heavy"><?php echo $ttsumnct;?></td>
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
</table>
</body>
</html>
<?php
} 
}
mysql_close($con);
?>
