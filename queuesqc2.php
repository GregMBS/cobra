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
<title>Reporte de los queues por cliente</title>

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
<h2>Queues Normales</>
<table summary="Clientes">
<thead>
<tr>
<th>Cliente</a></th>
<th>Campa&ntilde;a</a></th>
<th>Asignados</a></th>
<th>Queue</a></th>
<th>#/$ cuentas</a></th>
<th>% campa&ntilde;a</a></th>
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
$querymain = "select distinct cliente, 
queue,status_de_credito
from resumen join dictamenes on status_aarsa=dictamen
where status_de_credito not regexp '[dv]o$'
order by cliente,status_de_credito,queue limit 1000
";       
$result=mysql_query($querymain) or die(mysql_error());
while ($answer=mysql_fetch_row($result)) {
$CLIENTE=$answer[0];
$QUEUE=$answer[1];
$SDC=$answer[2];
$queryc = "SELECT count(1),sum(saldo_total) FROM resumen 
WHERE status_de_credito not regexp '[dv]o$'
and cliente='".$CLIENTE."';";
if ($SDC<>'') {
$queryc = "SELECT count(1),sum(saldo_total) FROM resumen 
WHERE status_de_credito = '".$SDC."'
and cliente='".$CLIENTE."';";}
$resultc=mysql_query($queryc) or die(mysql_error());
while ($answerc=mysql_fetch_row($resultc)) {$ASIGNADOS=$answerc[0];$DINERO=$answerc[1];}
$querysub="select count(1),
sum(fecha_ultima_gestion>curdate()), 
sum(fecha_ultima_gestion>curdate() - interval 6 day),
sum(fecha_ultima_gestion > last_day(curdate() - interval 1 month - interval 1 day)),
sum(saldo_total),
sum(saldo_total*(fecha_ultima_gestion>curdate())), 
sum(saldo_total*(fecha_ultima_gestion>curdate() - interval 6 day)),
sum(saldo_total*(fecha_ultima_gestion > last_day(curdate() - interval 1 month - interval 1 day)))
from resumen 
join dictamenes on status_aarsa=dictamen
where cliente='".$CLIENTE."'
and status_de_credito not regexp '[dv]o$'
and queue='".$QUEUE."'
";
if ($SDC<>'') {
$querysub="select count(1),
sum(fecha_ultima_gestion>curdate()), 
sum(fecha_ultima_gestion>curdate() - interval 6 day),
sum(fecha_ultima_gestion > last_day(curdate() - interval 1 month - interval 1 day)),
sum(saldo_total),
sum(saldo_total*(fecha_ultima_gestion>curdate())), 
sum(saldo_total*(fecha_ultima_gestion>curdate() - interval 6 day)),
sum(saldo_total*(fecha_ultima_gestion > last_day(curdate() - interval 1 month - interval 1 day)))
from resumen 
join dictamenes on status_aarsa=dictamen
where cliente='".$CLIENTE."'
and status_de_credito='".$SDC."'
and queue='".$QUEUE."'
";}
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
$pcc=number_format($count/($ASIGNADOS+0.001)*100,0);
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
$pcmc=number_format($monto/($DINERO+0.001)*100,0);
$pcmd=number_format($montod/($monto+0.001)*100,0);
$pcms=number_format($montos/($monto+0.001)*100,0);
$pcmm=number_format($montom/($monto+0.001)*100,0);
?>
<tr>
<td>
<?php echo $CLIENTE;?>
</td>
<td>
<?php echo $SDC;?>
</td>
<td>
<?php echo $ASIGNADOS;?><br>
<?php echo number_format($DINERO,0);?>
</td>
<td>
<?php echo $QUEUE;?>
</td>
<td class='legibility'><a href="speclistqc.php?capt=<?php echo $capt ?>
			&cliente=<?php echo $CLIENTE ?>
			&queue=<?php echo $QUEUE ?>
			&status_de_credito=<?php echo $SDC ?>
			&rato=total
			"><?php echo $count.'<br>'.number_format($monto,0); ?></a>
</td>
<td><?php echo $pcc.'%<br>'.number_format($pcmc,0)."%"; ?>
</td>
<td <?php echo $empd?>><a href="speclistqc.php?capt=<?php echo $capt ?>
			&cliente=<?php echo $CLIENTE ?>
			&queue=<?php echo $QUEUE ?>
			&status_de_credito=<?php echo $SDC ?>
			&rato=diario
			"><?php echo $countd.'<br>'.number_format($montod,0); ?></a>
</td>
<td <?php echo $empd?>><?php echo $pcd.'%<br>'.number_format($pcmd,0)."%"; ?>
</td>
<td <?php echo $emps?>><a href="speclistqc.php?capt=<?php echo $capt ?>
			&cliente=<?php echo $CLIENTE ?>
			&queue=<?php echo $QUEUE ?>
			&status_de_credito=<?php echo $SDC ?>
			&rato=semanal
			"><?php echo $counts.'<br>'.number_format($montos,0); ?></a>
</td>
<td <?php echo $emps?>><?php echo $pcs.'%<br>'.number_format($pcms,0)."%"; ?>
</td>
<td <?php echo $empm?>><a href="speclistqc.php?capt=<?php echo $capt ?>
			&cliente=<?php echo $CLIENTE ?>
			&queue=<?php echo $QUEUE ?>
			&status_de_credito=<?php echo $SDC ?>
			&rato=mensual
			"><?php echo $countm.'<br>'.number_format($montom,0); ?></a>
</td>
<td <?php echo $empm?>><?php echo $pcm.'%<br>'.number_format($pcmm,0)."%"; ?>
</td>
</tr>
<?php }?>
</tbody>
</table>
<h2>Queus Especiales</h2>
<table summary="Clientes">
<thead>
<tr>
<th>Cliente</a></th>
<th>Campa&ntilde;a</a></th>
<th>Asignados</a></th>
<th>#/$ cuentas</a></th>
<th>% campa&ntilde;a</a></th>
</tr>
</thead>
<tbody>
<?php
$querymain = "select cliente, 
status_de_credito,count(1),sum(saldo_total),
sum(fecha_ultima_gestion<=last_day(curdate()-interval 1 month)) as ecount,
sum((fecha_ultima_gestion<=last_day(curdate()-interval 1 month))*saldo_total) as emount
from resumen 
where status_de_credito not regexp '[dv]o$'
group by cliente,status_de_credito  
";       
$result=mysql_query($querymain) or die(mysql_error());
while ($answer=mysql_fetch_row($result)) {
$CLIENTE=$answer[0];
$SDC=$answer[1];
$COUNT=$answer[2];
$MOUNT=$answer[3];
$ECOUNT=$answer[4];
$EMOUNT=$answer[5];
$PCOUNT=round($ECOUNT/$COUNT*100);
$PMOUNT=round($EMOUNT/$MOUNT*100);
?>
<tr>
<td>
<?php echo $CLIENTE;?>
</td>
<td>
<?php echo $SDC;?>
</td>
<td>
<?php echo $COUNT;?><br>
<?php echo number_format($MOUNT,0);?>
</td>
<td>
<?php echo $ECOUNT;?><br>
<?php echo number_format($EMOUNT,0);?>
</td>
<td>
<?php echo $PCOUNT;?><br>
<?php echo number_format($PMOUNT,0);?>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</body>
</html> 
<?php
}
}
mysql_close($con);
?>
