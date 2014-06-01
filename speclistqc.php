<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
set_time_limit(300);
if (!empty($_REQUEST['go'])) {
$go=mysql_real_escape_string($_REQUEST['go']);
if ($go=="GUARDAR") {
	$queryu="UPDATE resumen 
	SET ejecutivo_asignado_call_center='".mysql_real_escape_string($_REQUEST['GESTOR'])."'
	WHERE id_cuenta=".mysql_real_escape_string($_REQUEST['id_cuenta']);
	$resultu = mysql_query($queryu) or die(mysql_error());
	}
	}
$cliente=mysql_real_escape_string($_REQUEST['cliente']);
$queue=mysql_real_escape_string($_REQUEST['queue']);	
$sdc=mysql_real_escape_string($_REQUEST['status_de_credito']);	
if ($sdc=='MORA4 ') {$sdc='MORA4+';}
$rato=mysql_real_escape_string($_REQUEST['rato']);	
$ratostr="";
switch ($rato) {
    case 'diario':
        $ratostr=" AND fecha_ultima_gestion>curdate() ";
        break;
    case 'semanal':
        $ratostr= "AND week(fecha_ultima_gestion)=week(curdate()) 
        AND year(fecha_ultima_gestion)=year(curdate()) ";
        break;
    case 'mensual':
        $ratostr= "AND fecha_ultima_gestion > last_day(curdate() - interval 1 month) + interval 1 day ";
        break;
}
$sdcstr='AND status_de_credito not regexp "[dv]o$" ';
if (!(empty($sdc))) {$sdcstr="AND status_de_credito='".$sdc."' ";}
$querymain = "SELECT numero_de_cuenta, nombre_deudor, saldo_total, status_aarsa,
ejecutivo_asignado_call_center, sum(monto), status_de_credito, 
0, producto, estado_deudor, ciudad_deudor, resumen.cliente, resumen.id_cuenta,
fecha_ultima_gestion, saldo_vencido 
FROM resumen 
JOIN dictamenes ON dictamen=status_aarsa
LEFT JOIN pagos using (id_cuenta)
WHERE resumen.cliente='".$cliente."' 
AND queue='".$queue."' ".$sdcstr.$ratostr.
" GROUP BY id_cuenta
ORDER BY saldo_total desc";
if (!empty($_REQUEST['go'])) {
if (!empty($_REQUEST['reorden'])) {
$querymain = "SELECT numero_de_cuenta, nombre_deudor, saldo_total, status_aarsa,
ejecutivo_asignado_call_center, sum(monto), status_de_credito, 
0, producto, estado_deudor, ciudad_deudor, resumen.cliente, resumen.id_cuenta,
fecha_ultima_gestion, saldo_vencido 
FROM resumen 
JOIN dictamenes ON dictamen=status_aarsa
LEFT JOIN pagos using (id_cuenta)
WHERE resumen.cliente='".$cliente."' 
AND queue='".$queue."' 
AND status_de_credito='".$sdc."' 
 ".$ratostr."
GROUP BY id_cuenta
ORDER BY ".mysql_real_escape_string($_REQUEST['go'])." ".mysql_real_escape_string($_REQUEST['updown']);
}
}
$result = mysql_query($querymain) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Listado por Cliente y Status</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#000000;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;border-collapse: collapse;}
     tr:hover {background-color: #ff0000;}
       th,td {border: 1pt solid #000000;background-color: #c0c0c0;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
 </style>
</head>
<body>
<button onclick="window.location='queuesqc.php?capt=<?php echo $capt;?>'">Regressar al Reporte de los Queues</button><br>
<table summary="Cuentas">
<thead>
<tr>
<?php if (empty($_REQUEST['updown'])) {$updown='desc';} else {$updown='';} ?>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?status_de_credito=<?php echo $sdc ?>&updown=<?php echo $updown ?>&cliente=<?php echo $cliente ?>&queue=<?php echo $queue ?>&rato=<?php echo $rato ?>&capt=<?php echo $capt ?>&reorden=yes&go=numero_de_cuenta'>CUENTA</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?status_de_credito=<?php echo $sdc ?>&updown=<?php echo $updown ?>&cliente=<?php echo $cliente ?>&queue=<?php echo $queue ?>&rato=<?php echo $rato ?>&capt=<?php echo $capt ?>&reorden=yes&go=nombre_deudor'>NOMBRE</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?status_de_credito=<?php echo $sdc ?>&updown=<?php echo $updown ?>&cliente=<?php echo $cliente ?>&queue=<?php echo $queue ?>&rato=<?php echo $rato ?>&capt=<?php echo $capt ?>&reorden=yes&go=cliente'>CLIENTE</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?status_de_credito=<?php echo $sdc ?>&updown=<?php echo $updown ?>&cliente=<?php echo $cliente ?>&queue=<?php echo $queue ?>&rato=<?php echo $rato ?>&capt=<?php echo $capt ?>&reorden=yes&go=monto'>MONTO PAGO</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?status_de_credito=<?php echo $sdc ?>&updown=<?php echo $updown ?>&cliente=<?php echo $cliente ?>&queue=<?php echo $queue ?>&rato=<?php echo $rato ?>&capt=<?php echo $capt ?>&reorden=yes&go=saldo_total'>SALDO TOTAL</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?status_de_credito=<?php echo $sdc ?>&updown=<?php echo $updown ?>&cliente=<?php echo $cliente ?>&queue=<?php echo $queue ?>&rato=<?php echo $rato ?>&capt=<?php echo $capt ?>&reorden=yes&go=n_prom'>MONTO PROMESA</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?status_de_credito=<?php echo $sdc ?>&updown=<?php echo $updown ?>&cliente=<?php echo $cliente ?>&queue=<?php echo $queue ?>&rato=<?php echo $rato ?>&capt=<?php echo $capt ?>&reorden=yes&go=queue'>STATUS</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?status_de_credito=<?php echo $sdc ?>&updown=<?php echo $updown ?>&cliente=<?php echo $cliente ?>&queue=<?php echo $queue ?>&rato=<?php echo $rato ?>&capt=<?php echo $capt ?>&reorden=yes&go=ejecutivo_asignado_call_center'>GESTOR</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?status_de_credito=<?php echo $sdc ?>&updown=<?php echo $updown ?>&cliente=<?php echo $cliente ?>&queue=<?php echo $queue ?>&rato=<?php echo $rato ?>&capt=<?php echo $capt ?>&reorden=yes&go=fecha_ultima_gestion'>ULT GESTION</a></th>
</tr>
</thead>
<tbody>
<?php
$j=0;
while($row = mysql_fetch_row($result)) {
$j=$j+1;
$CUENTA=$row[0];
$CLIENTE=$row[11];
$ID_CUENTA=$row[12];
$FUG=$row[13];
$NOMBRE=$row[1];
$GESTOR=$row[4];
$MONTO=$row[5];
$STATUS=$row[3];
$PRODUCTO=$row[8];
$CIUDAD=$row[10];
$MONTOTOTAL=$row[2];
$N_PROM=0;
$queryprom="select n_prom from historia where c_cont='".$ID_CUENTA."' and n_prom>0 order by d_fech desc, c_hrin desc limit 1";
$resultprom = mysql_query($queryprom) or die(mysql_error());
while ($answerprom=mysql_fetch_row($resultprom)) {
			$N_PROM=$answerprom[0];
			};
?>
<tr>
<form class="migochange" name="gestorchange<?php echo $j ?>" method="get" action=
"<?php echo $_SERVER['PHP_SELF'] ?>" id="gestorchange<?php echo $j ?>">
<input type="hidden" name="capt" value="<?php echo $capt ?>"> 
<input type="hidden" name="cliente" value="<?php echo $CLIENTE ?>"> 
<input type="hidden" name="status_aarsa" value="<?php echo $status ?>"> 
<input type="hidden" name="id_cuenta" value="<?php echo $ID_CUENTA ?>"> 
<input type="hidden" name="reorden" value="">
<input type="hidden" name="j" value="<?php echo $j ?>"> 
<td><a href='resumen.php?go=FROMMIGO&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA;?>&capt=<?php echo $capt;?>'><?php echo $CUENTA;?></a></td>
<td><?php echo utf8_decode($NOMBRE);?></td>
<td><?php echo $CLIENTE;?></td>
<td class='num'><?php echo number_format($MONTO,2);?></td>
<td class='num'><?php echo number_format($MONTOTOTAL,2);?></td>
<td class='num'><?php echo number_format($N_PROM,2);?></td>
<td><?php echo $STATUS;?></td>
<td>
<?php echo $GESTOR ?>
</td>
<td>
<?php echo $FUG ?>
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
