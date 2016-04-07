<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_REQUEST['capt']);
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."';";
$resultcheck=mysql_query($querycheck);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
if (empty($_REQUEST['page'])||($_REQUEST['page']+0==0)) {$page=0;} else {$page=mysql_real_escape_string($_REQUEST['page']);}
$tcapt=$capt;
if (substr($capt,0,8)=="practica") {$tcapt="practica";}
$updown='';
	 set_time_limit(300);
$go='';
$reorden='';
if (!empty($_REQUEST['reorden'])) {$reorden=mysql_real_escape_string($_REQUEST['reorden']);}
if (!empty($_REQUEST['go'])) {$go=mysql_real_escape_string($_REQUEST['go']);} else {$reorden='';}
if ($go=='CUENTAS') {
        $go='';
}
$cliente='';
$clientestr='WHERE ';
if (!empty($_REQUEST['cliente'])) {
	 $cliente=mysql_real_escape_string($_REQUEST['cliente']);
	 if (strlen($cliente)>1) {$clientestr="WHERE cliente='".$cliente."' AND ";}
	 }
$queryupd="update historia, resumen set status_aarsa=c_cvst where id_cuenta=c_cont
and auto in (select max(auto) from historia group by c_cont)";
//mysql_query($queryupd) or die(mysql_error());
$count=0;
$querycount = "SELECT count(1) FROM resumen ".$clientestr." 
status_de_credito not regexp 'nactivo' AND status_de_credito not regexp 'iquidado';";
$resultcount=mysql_query($querycount) or die(mysql_error());
while ($answercount=mysql_fetch_row($resultcount)) {$count=$answercount{0};}
$nextpage=min($count-20,$page+20);
$prevpage=max($page-20,0);
$querymain = "SELECT numero_de_cuenta, nombre_deudor, saldo_total, 
status_de_credito, ejecutivo_asignado_call_center, pagos_vencidos, status_aarsa,
saldo_descuento_1, producto ,estado_deudor, ciudad_deudor, cliente, id_cuenta, 
saldo_vencido, fecha_ultima_gestion, vcc(status_aarsa) 
FROM resumen  
 ".$clientestr." 
 status_de_credito not regexp 'nactivo' AND status_de_credito not regexp 'iquidado'
GROUP BY id_cuenta 
ORDER BY 
(ejecutivo_asignado_call_center<>'".$tcapt."'),  
saldo_total desc, pagos_vencidos 
LIMIT ".$page.",20";
//$querymain = "SELECT numero_de_cuenta,nombre_deudor,saldo_total,status_de_credito,ejecutivo_asignado_call_center,pagos_vencidos,status_aarsa,saldo_descuento_1,producto,estado_deudor,ciudad_deudor,cliente,id_cuenta,saldo_vencido,'n/a' AS fecha_ultima_gestion FROM resumen ".$clientestr." ORDER BY (ejecutivo_asignado_call_center<>'".$tcapt."'), ejecutivo_asignado_call_center, saldo_total desc, pagos_vencidos";
if ($reorden!='') {
$updown=mysql_real_escape_string($_REQUEST['updown']);
$querymain = "SELECT numero_de_cuenta,nombre_deudor,saldo_total,
status_de_credito,ejecutivo_asignado_call_center,pagos_vencidos,status_aarsa,
saldo_descuento_1,producto,estado_deudor,ciudad_deudor,cliente,id_cuenta,
saldo_vencido,fecha_ultima_gestion,vcc(status_aarsa) 
FROM resumen  
 ".$clientestr." 
 status_de_credito not regexp 'nactivo' AND status_de_credito not regexp 'iquidado'
GROUP BY id_cuenta 
ORDER BY (ejecutivo_asignado_call_center<>'".$tcapt."'),".$go." ".$updown." limit ".$page.",20";
//$querymain = "SELECT numero_de_cuenta,nombre_deudor,saldo_total,status_de_credito,ejecutivo_asignado_call_center,pagos_vencidos,status_aarsa,saldo_descuento_1,producto,estado_deudor,ciudad_deudor,cliente,id_cuenta,saldo_vencido,'n/a' AS fecha_ultima_gestion FROM resumen ".$clientestr." ORDER BY (ejecutivo_asignado_call_center<>'".$tcapt."'),".$go." ".$updown;
}
if ($go=='status_aarsa') {
$querymain = "SELECT numero_de_cuenta,nombre_deudor,saldo_total,
status_de_credito,ejecutivo_asignado_call_center,pagos_vencidos,status_aarsa,
saldo_descuento_1,producto,estado_deudor,ciudad_deudor,cliente,id_cuenta,
saldo_vencido,max(D_FECH) AS fecha_ultima_gestion,vcc(status_aarsa) 
FROM resumen  
left join historia on c_cont=id_cuenta ".$clientestr."
 status_de_credito not regexp 'nactivo' AND status_de_credito not regexp 'iquidado'
group BY id_cuenta
order by (ejecutivo_asignado_call_center<>'".$tcapt."'),vcc(status_aarsa) ".mysql_real_escape_string($_REQUEST['updown']).", status_aarsa,ejecutivo_asignado_call_center  limit ".$page.",20;";
}
$result = mysql_query($querymain) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Cuentas Migo</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #ffffff; color:#000000;}
       table {border: 1pt solid #000000;background-color: #ffffff;table-layout:fixed;}
     tr:hover {background-color: #ff0000;}
       th {border: 1pt solid #000000;background-color: #ffffff;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
	div,p {clear:both}
	#next,#prev {float:left;clear:none;}
	#paging {font-weight:bold; font-size:110%}
 </style>

</head>
<body>
<table summary="Cuentas">
<thead>
<tr>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $updown ?>&capt=<?php echo $capt ?>&reorden=yes&go=numero_de_cuenta'>CUENTA</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $updown ?>&capt=<?php echo $capt ?>&reorden=yes&go=nombre_deudor'>NOMBRE</a></th>
<th>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<select name="cliente" onChange="this.form.submit()">
<option value="" <?php if ($cliente=='') {?> selected='selected'<?php } ?>>todos</option>
<?php 
$querycl = "SELECT cliente FROM clientes ORDER BY cliente;";
$resultcl = mysql_query($querycl);
while ($answercl = mysql_fetch_array($resultcl)) {?>
<option value="<?php echo $answercl[0];?>" <?php if ($cliente==$answercl[0]) {?> selected='selected'<?php } ?>><?php echo $answercl[0];?>
</option>
<?php  } ?>
</select>
</form>
<br>
<?php if ($updown=='') {$downup='desc';} else {$downup='';}?>
<a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $downup ?>&capt=<?php echo $capt ?>&reorden=yes&go=cliente&cliente=<?php echo $cliente ?>'>CLIENTE</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $downup ?>&capt=<?php echo $capt ?>&reorden=yes&go=ejecutivo_asignado_call_center&cliente=<?php echo $cliente ?>'>GESTOR</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $downup ?>&capt=<?php echo $capt ?>&reorden=yes&go=pagos_vencidos&cliente=<?php echo $cliente ?>'>PAGOS VENCIDOS</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $downup ?>&capt=<?php echo $capt ?>&reorden=yes&go=saldo_total&cliente=<?php echo $cliente ?>'>SALDO TOTAL</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $downup ?>&capt=<?php echo $capt ?>&reorden=yes&go=saldo_vencido&cliente=<?php echo $cliente ?>'>SALDO VENCIDO</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $downup ?>&capt=<?php echo $capt ?>&reorden=yes&go=status_aarsa&cliente=<?php echo $cliente ?>'>RESULTADOS</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $downup ?>&capt=<?php echo $capt ?>&reorden=yes&go=fecha_ultima_gestion&cliente=<?php echo $cliente ?>'>ULT. GESTION</a></th>
</tr>
</thead>
<tbody>
<?php
$j=0;
while($row = mysql_fetch_row($result)) {
$j=$j+1;
$CUENTA=$row[0];
$CLIENTE=$row[11];
$GESTOR=$row[4];
$ID_CUENTA=$row[12];

$STATUS_AARSA=$row[6];
$VALOR=99;
$VALOR=$row[15];
$SALDO_VENCIDO=$row[13];
$FECHA_ULT_GESTION=$row[14];
if ($FECHA_ULT_GESTION=='2008-01-01') {$FECHA_ULT_GESTION='';}
$NOMBRE=$row[1];
$PV=$row[5];
$STATUS_DE_CREDITO=$row[3];
$MONTODESC=$row[7];
$PRODUCTO=$row[8];
$CIUDAD=$row[10];
$MONTOTOTAL=$row[2];
?>
<tr>
<td><a href='resumen.php?go=FROMMIGO&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA;?>&capt=<?php echo $capt;?>'><?php echo $CUENTA;?></a></td>
<td><?php echo htmlentities($NOMBRE);?></td>
<td><?php echo $CLIENTE;?></td>
<td><?php echo $GESTOR;?></td>
<td><?php echo $PV;?></td>
<td class='num'><?php echo number_format($MONTOTOTAL,2);?></td>
<td class='num'><?php echo number_format($SALDO_VENCIDO,2);?></td>
<td><?php echo $STATUS_AARSA;?></td>
<td><?php echo $FECHA_ULT_GESTION;?></td>
</tr>
<?php } ?>
</tbody>
</table>
<div>
<form class="buttons" name="prev" method="get" action=
"<?php echo $_SERVER['PHP_SELF']; ?>" id="prev"><input type="hidden"
name="updown" value="<?php echo $updown ?>"> <input type="hidden"
name="cliente" value="<?php echo $cliente ?>"> <input type="hidden"
name="capt" value="<?php echo $capt ?>"> <input type="hidden"
name="reorden" value="<?php echo $reorden ?>"> <input type="hidden"
name="page" value="<?php echo $prevpage ?>"> <input type="hidden"
name="go" value="<?php echo $go ?>"><input type="submit"
name="from" value="ANTE"></form>
<form class="buttons" name="next" method="get" action=
"<?php echo $_SERVER['PHP_SELF']; ?>" id="next"><input type="hidden"
name="updown" value="<?php echo $updown ?>"> <input type="hidden"
name="cliente" value="<?php echo $cliente ?>"> <input type="hidden"
name="capt" value="<?php echo $capt ?>"> <input type="hidden"
name="reorden" value="<?php echo $reorden ?>"> <input type="hidden"
name="page" value="<?php echo $nextpage ?>"> <input type="hidden"
name="go" value="<?php echo $go ?>"><input type="submit"
name="from" value="SEG"></form>
</div>
<p id='paging'>
Resultados <?php echo $page+1 ?> a <?php echo $page+20 ?> de <?php echo $count ?>
</p>
<div id="searchbox">
<h2>Buscar</h2>
<form name="search" method="get" action=
"buscar.php" id="search">Buscar a: <input type=
"text" name="find"> en <select name="field">
<option value="nombre_deudor">Nombre</option>
<option value="numero_de_cuenta">Cuenta</option>
<option value="TELS">Telefonos</option>
<option value="REFS">Referencias</option>
<option value="id_cuenta">Expediente</option>
</select><br>
Client = <select name="cliente">
<option value=" ">Todos</option>
<?php 
$querycl = "SELECT cliente FROM clientes;";
$resultcl = mysql_query($querycl);
while ($answercl = mysql_fetch_array($resultcl)) {?>
<option value="<?php echo $answercl[0];?>"><?php echo $answercl[0];?>
</option>
<?php  } ?>
</select><br>
<input type="hidden" name="i" value="0">
<input type="hidden" name="capt" value="<?php if (isset($capt)) {echo $capt;} ?>">
<input type="hidden" name="go" value="BUSCAR">
<input type="hidden" name="from" value="resumen.php">
<input type="submit" name="go1" value="BUSCAR">
<input type="button" name="cancel" onclick="cancelbox('searchbox')"
value="Cancel"> 
</form>
</div>
<?php
}   
}
mysql_close($con);
?>
</body>
</html> 
