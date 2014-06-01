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
$querymain = "SELECT numero_de_cuenta, nombre_deudor, saldo_total, queue,
ejecutivo_asignado_call_center, pagos_vencidos, status_de_credito, 
saldo_descuento_1, producto, estado_deudor, ciudad_deudor, cliente, id_cuenta,
(tel_1_verif is not null), saldo_vencido 
FROM resumen JOIN dictamenes ON dictamen=status_aarsa 
JOIN nombres ON ejecutivo_asignado_call_center=usuaria
WHERE queue IS NOT NULL
ORDER BY saldo_total desc";
if (!empty($_REQUEST['go'])) {
if (!empty($_REQUEST['reorden'])) {
$querymain = "SELECT numero_de_cuenta,nombre_deudor,saldo_total,queue,
ejecutivo_asignado_call_center,pagos_vencidos,status_de_credito,
saldo_descuento_1,producto,estado_deudor,ciudad_deudor,cliente,id_cuenta,
(tel_1_verif is not null),saldo_vencido 
FROM resumen JOIN dictamenes ON dictamen=status_aarsa 
JOIN nombres ON ejecutivo_asignado_call_center=usuaria
WHERE queue IS NOT NULL
ORDER BY ".mysql_real_escape_string($_REQUEST['go'])." ".mysql_real_escape_string($_REQUEST['updown']);
}
if ($go=='queue') {
$querymain = "SELECT numero_de_cuenta,nombre_deudor,saldo_total,queue,
ejecutivo_asignado_call_center,pagos_vencidos,status_de_credito,
saldo_descuento_1,producto,estado_deudor,ciudad_deudor,cliente,id_cuenta,
(tel_1_verif is not null),saldo_vencido 
FROM resumen JOIN dictamenes ON dictamen=status_aarsa 
JOIN nombres ON ejecutivo_asignado_call_center=usuaria
WHERE queue IS NOT NULL
GROUP BY id_cuenta 
ORDER BY (ejecutivo_asignado_call_center<>'".$mynombre."'),queue ".mysql_real_escape_string($_REQUEST['updown']).";";
}if ($go=='actualizado') {
$querymain = "SELECT numero_de_cuenta,nombre_deudor,saldo_total,queue,
ejecutivo_asignado_call_center,pagos_vencidos,status_de_credito,
saldo_descuento_1,producto,estado_deudor,ciudad_deudor,cliente,id_cuenta,
(tel_1_verif is not null),saldo_vencido 
FROM resumen JOIN dictamenes ON dictamen=status_aarsa 
JOIN nombres ON ejecutivo_asignado_call_center=usuaria
WHERE queue IS NOT NULL
GROUP BY id_cuenta 
ORDER BY (ejecutivo_asignado_call_center<>'".$mynombre."'),(tel_1_verif is not null) ".mysql_real_escape_string($_REQUEST['updown']).", queue,ejecutivo_asignado_call_center;";
}
}
$result = mysql_query($querymain) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Cuentas Migo</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#000000;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;}
     tr:hover {background-color: #ff0000;}
       th {border: 1pt solid #000000;background-color: #c0c0c0;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
 </style>
</head>
<body>
<table summary="Cuentas">
<thead>
<tr>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get" name="migoorden">
<?php if (empty($_REQUEST['updown'])) {$updown='desc';} else {$updown='';} ?>
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<input type="hidden" name="reorden" value="yes">
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $updown ?>&capt=<?php echo $capt ?>&reorden=yes&go=numero_de_cuenta'>CUENTA</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $updown ?>&capt=<?php echo $capt ?>&reorden=yes&go=nombre_deudor'>NOMBRE</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $updown ?>&capt=<?php echo $capt ?>&reorden=yes&go=cliente'>CLIENTE</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $updown ?>&capt=<?php echo $capt ?>&reorden=yes&go=pagos_vencidos'>PAGOS VENCIDOS</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $updown ?>&capt=<?php echo $capt ?>&reorden=yes&go=saldo_total'>SALDO TOTAL</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $updown ?>&capt=<?php echo $capt ?>&reorden=yes&go=saldo_vencido'>SALDO VENCIDO</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $updown ?>&capt=<?php echo $capt ?>&reorden=yes&go=queue'>QUEUE</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $updown ?>&capt=<?php echo $capt ?>&reorden=yes&go=ejecutivo_asignado_call_center'>GESTOR</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $updown ?>&capt=<?php echo $capt ?>&reorden=yes&go=actualizado'>ACTUALIZADO</a></th>
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
$ACTUALIZADO=$row[13];
$SALDO_VENCIDO=$row[14];
$NOMBRE=$row[1];
$GESTOR=$row[4];
$PV=$row[5];
$STATUS=$row[3];
$MONTODESC=$row[7];
$PRODUCTO=$row[8];
$CIUDAD=$row[10];
$MONTOTOTAL=$row[2];
?>
<tr>
<form class="migochange" name="gestorchange<?php echo $j ?>" method="get" action=
"<?php echo $_SERVER['PHP_SELF'] ?>" id="gestorchange<?php echo $j ?>">
<input type="hidden" name="capt" value="<?php echo $capt ?>"> 
<input type="hidden" name="id_cuenta" value="<?php echo $ID_CUENTA ?>"> 
<input type="hidden" name="j" value="<?php echo $j ?>"> 
<td><a href='resumen.php?go=FROMMIGO&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA;?>&capt=<?php echo $capt;?>'><?php echo $CUENTA;?></a></td>
<td><?php echo utf8_decode($NOMBRE);?></td>
<td><?php echo $CLIENTE;?></td>
<td><?php echo $PV;?></td>
<td class='num'><?php echo number_format($MONTOTOTAL,2);?></td>
<td class='num'><?php echo number_format($SALDO_VENCIDO,2);?></td>
<td><?php echo $STATUS;?></td>
<td>
<select name="GESTOR">
<option value=""></option>
<?php 
$queryge = "SELECT usuaria FROM nombres where tipo <> 'visitador'";
$resultge = mysql_query($queryge);
while ($answerge = mysql_fetch_array($resultge)) {?>
  <option value="<?php if (isset($answerge[0])) {echo $answerge[0];}?>" style="font-size:120%;" <?php if (strtolower($answerge[0])==strtolower($GESTOR)) {echo "selected='selected'";}?>>
	<?php if (isset($answerge[0])) {echo $answerge[0];}?></option>
<?php } ?>
<option value="no gestion">no gestion</option>
</select></td>
<td>
<?php if ($ACTUALIZADO==1) {echo '*';}?>
</td>
<td><input type="submit" name="go" value="GUARDAR">
</td>
</form>
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
