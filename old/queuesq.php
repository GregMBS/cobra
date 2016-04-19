<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$oldgestor='';
$querylist = "SELECT queuelist.*,tipo FROM queuelist left join nombres on gestor=usuaria ORDER BY gestor,queuelist.camp";
$resultlist = mysql_query($querylist) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Reporte de los queues por gestor</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 10pt; background-color: #00a0f0; color:#000000;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;border-collapse: collapse;}
       th, td {border: 1pt solid #000000;background-color: #c0c0c0;text-align:center;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
    .good {background-color: #00ff00;}
    .fair {background-color: #ffff00;}
    .bad {background-color: #ff0000;}
    .legibility {background-color: #ffffff;}
</style>
</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<table summary='gestores'>
<tr>
<?php 
$queryg="select distinct gestor from queuelist 
where gestor in (select ejecutivo_asignado_call_center from resumen)
order by gestor";
$resultg=mysql_query($queryg) or die(mysql_error());
while ($answerg=mysql_fetch_row($resultg)) {
?>
<td>
<a href='#<?php echo $answerg[0]; ?>'><?php echo $answerg[0]; ?></a>
</td>
<?php } ?>
</tr>
</table>
<table summary="Gestores">
<thead>
<tr>
<th>Gestor</a></th>
<th>Cliente</a></th>
<th>Campa&ntilde;a</a></th>
<th>Queue</a></th>
<th>Orden por</a></th>
<th>asc/desc</a></th>
<th>#/$ cuentas</a></th>
<th>#/$ diario</a></th>
<th>% diario</a></th>
<th>#/$ semanal</a></th>
<th>% semanal</a></th>
<th>#/$ mensual</a></th>
<th>% mensual</a></th>
</tr>
</thead>
<tbody>
<?php
$querymain = "select distinct gestor, queuelist.cliente, 
queuelist.status_aarsa, orden1, orden2, orden3, updown1, updown2, updown3,sdc,bloqueado
from queuelist
join dictamenes on queuelist.status_aarsa = queue
join resumen
on gestor=ejecutivo_asignado_call_center 
and queuelist.cliente=resumen.cliente 
and status_de_credito = sdc
and dictamen=resumen.status_aarsa
order by gestor,cliente,camp
";       
}
$gestorold='';
$result=mysql_query($querymain) or die(mysql_error());
while ($answer=mysql_fetch_row($result)) {
$GESTOR=$answer[0];
$separator='';
if ($GESTOR!=$gestorold) {
$gestorold=$GESTOR;
$separator="<tr><td colspan=13 style='background-color: #000000'><a id='".$GESTOR."' href='#' style='color:white;font-weight:bold;'>⇧</a></td></tr>";
}
$CLIENTE=$answer[1];
$SDC=$answer[9];
$BK=$answer[10];
$QUEUE=$answer[2];
$orden1=$answer[3]." ";
$orden2=$answer[4]." ";
$orden3=$answer[5]." ";
$ud1=$answer[6];
$updown1="";
if (($orden1!=" ")&&($ud1==0)) {$updown1="asc";}
if (($orden1!=" ")&&($ud1==1)) {$updown1="desc";}
$ud2=$answer[7];
$updown2="";
if (($orden2!=" ")&&($ud2==0)) {$updown2="asc";}
if (($orden2!=" ")&&($ud2==1)) {$updown2="desc";}
$ud3=$answer[8];
$updown3="";
if (($orden3!=" ")&&($ud3==0)) {$updown3="asc";}
if (($orden3!=" ")&&($ud3==1)) {$updown3="desc";}
$querysub="select count(1),
sum(fecha_ultima_gestion>curdate()), 
sum(fecha_ultima_gestion>curdate()-interval 8 day),
sum(fecha_ultima_gestion>last_day(curdate()-interval 1 month)),
sum(saldo_total),
sum(saldo_total*(fecha_ultima_gestion>curdate())), 
sum(saldo_total*(fecha_ultima_gestion>curdate()-interval 8 day)),
sum(saldo_total*(fecha_ultima_gestion>last_day(curdate()-interval 1 month)))
from resumen 
join dictamenes on status_aarsa=dictamen
where ejecutivo_asignado_call_center='".$GESTOR."'
and cliente='".$CLIENTE."'
and status_de_credito = '".$SDC."'
and queue='".$QUEUE."'
";
$resultsub=mysql_query($querysub) or die(mysql_error());
while ($answersub=mysql_fetch_row($resultsub)) {
$count=$answersub[0];
$countd=$answersub[1];
$counts=$answersub[2];
$countm=$answersub[3];
$monto=$answersub[4];
$montod=$answersub[5];
$montos=$answersub[6];
$montom=$answersub[7];
}
$pcd=number_format($countd/($count+0.001)*100,0);
$empd="class='good'";
if ($pcd<80) {$empd="class='fair'";}
if ($pcd<40) {$empd="class='bad'";}
$pcs=number_format($counts/($count+0.001)*100,0);
$emps="class='good'";
if ($pcs<80) {$emps="class='fair'";}
if ($pcs<40) {$emps="class='bad'";}
$pcm=number_format($countm/($count+0.001)*100,0);
$empm="class='good'";
if ($pcm<80) {$empm="class='fair'";}
if ($pcm<40) {$empm="class='bad'";}
$pcmd=number_format($montod/($monto+0.001)*100,0);
$pcms=number_format($montos/($monto+0.001)*100,0);
$pcmm=number_format($montom/($monto+0.001)*100,0);
echo $separator;
?>
<tr<?php if ($BK==1) {echo " style='color:white'";}?>>
<td>
<?php echo $GESTOR;?>
</td>
<td>
<?php echo $CLIENTE;?>
</td>
<td>
<?php echo $SDC;?>
</td>
<td>
<?php echo $QUEUE;?>
</td>
<td>
<?php echo $orden1;?><br>
<?php echo $orden2;?><br>
<?php echo $orden3;?>
</td>
<td>
<?php echo $updown1;?><br>
<?php echo $updown2;?><br>
<?php echo $updown3;?>
</td>
<td class='legibility'><a href="speclistq.php?capt=<?php echo $capt ?>
			&ejecutivo_asignado_call_center=<?php echo $GESTOR ?>
			&queue=<?php echo $QUEUE ?>
			&sdc=<?php echo $SDC ?>
			&rato=total
			"><?php echo $count.'<br>'.number_format($monto,0); ?></a>
</td>
<td <?php echo $empd?>><a href="speclistq.php?capt=<?php echo $capt ?>
			&ejecutivo_asignado_call_center=<?php echo $GESTOR ?>
			&queue=<?php echo $QUEUE ?>
			&sdc=<?php echo $SDC ?>
			&rato=diario
			"><?php echo $countd.'<br>'.number_format($montod,0); ?></a>
</td>
<td <?php echo $empd?>><?php echo $pcd.'%<br>'.number_format($pcmd,0)."%"; ?>
</td>
<td <?php echo $emps?>><a href="speclistq.php?capt=<?php echo $capt ?>
			&ejecutivo_asignado_call_center=<?php echo $GESTOR ?>
			&queue=<?php echo $QUEUE ?>
			&sdc=<?php echo $SDC ?>
			&rato=semanal
			"><?php echo $counts.'<br>'.number_format($montos,0); ?></a>
</td>
<td <?php echo $emps?>><?php echo $pcs.'%<br>'.number_format($pcms,0)."%"; ?>
</td>
<td <?php echo $empm?>><a href="speclistq.php?capt=<?php echo $capt ?>
			&ejecutivo_asignado_call_center=<?php echo $GESTOR ?>
			&queue=<?php echo $QUEUE ?>
			&sdc=<?php echo $SDC ?>
			&rato=mensual
			"><?php echo $countm.'<br>'.number_format($montom,0); ?></a>
</td>
<td <?php echo $empm?>><?php echo $pcm.'%<br>'.number_format($pcmm,0)."%"; ?>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</body>
</html> 
<?php
}
mysql_close($con);
?>
