<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$gestor=mysql_real_escape_string($_REQUEST['gestor']);
$fecha=mysql_real_escape_string($_REQUEST['fecha']);
$i=mysql_real_escape_string($_REQUEST['i']);
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
$queryupd="update historia, resumen set status_aarsa=c_cvst where id_cuenta=c_cont
and auto in (select max(auto) from historia group by c_cont)";
//mysql_query($queryupd) or die(mysql_error());
$count=0;
$nextpage=min($count-$i,$page+$i);
$prevpage=max($page-$i,0);
$querymain = "select numero_de_cuenta,nombre_deudor,saldo_total,
status_de_credito,ejecutivo_asignado_call_center,
pagos_vencidos,c_cvst,
saldo_descuento_1,producto,estado_deudor,ciudad_deudor,cliente,id_cuenta,
n_prom,d_prom,vcc(status_aarsa) from resumen 
join historia on id_cuenta=c_cont
where c_cvge='".$gestor."' and d_fech='".$fecha."'
ORDER BY 
saldo_total desc, pagos_vencidos,d_fech,c_hrin 
LIMIT ".$page.",".$i;
//$querymain = "SELECT numero_de_cuenta,nombre_deudor,saldo_total,status_de_credito,ejecutivo_asignado_call_center,pagos_vencidos,status_aarsa,saldo_descuento_1,producto,estado_deudor,ciudad_deudor,cliente,id_cuenta,saldo_vencido,'n/a' AS fecha_ultima_gestion FROM resumen ".$clientestr." ORDER BY (ejecutivo_asignado_call_center<>'".$tcapt."'), ejecutivo_asignado_call_center, saldo_total desc, pagos_vencidos";
if ($reorden!='') {
$updown=mysql_real_escape_string($_REQUEST['updown']);
$querymain = "select numero_de_cuenta,nombre_deudor,saldo_total,
status_de_credito,ejecutivo_asignado_call_center,
pagos_vencidos,status_aarsa,
saldo_descuento_1,producto,estado_deudor,ciudad_deudor,cliente,id_cuenta,
max(n_prom) as monto_promesa,max(d_prom) as fecha_promesa,vcc(status_aarsa) from resumen 
join historia on id_cuenta=c_cont
where c_cvge='".$gestor."' and d_fech='".$fecha."'
group by id_cuenta 
ORDER BY ".$go." ".$updown." limit ".$page.",".$i;
//$querymain = "SELECT numero_de_cuenta,nombre_deudor,saldo_total,status_de_credito,ejecutivo_asignado_call_center,pagos_vencidos,status_aarsa,saldo_descuento_1,producto,estado_deudor,ciudad_deudor,cliente,id_cuenta,saldo_vencido,'n/a' AS fecha_ultima_gestion FROM resumen ".$clientestr." ORDER BY (ejecutivo_asignado_call_center<>'".$tcapt."'),".$go." ".$updown;
}
if ($go=='status_aarsa') {
$querymain = "select numero_de_cuenta,nombre_deudor,saldo_total,
status_de_credito,ejecutivo_asignado_call_center,
pagos_vencidos,status_aarsa,
saldo_descuento_1,producto,estado_deudor,ciudad_deudor,cliente,id_cuenta,
max(n_prom) as monto_promesa,max(d_prom) as fecha_promesa,vcc(status_aarsa) as vccs from resumen 
join historia on id_cuenta=c_cont
where c_cvge='".$gestor."' and d_fech='".$fecha."'
group by id_cuenta 
order by vccs ".mysql_real_escape_string($_REQUEST['updown']).", status_aarsa,ejecutivo_asignado_call_center;";
}
$result = mysql_query($querymain) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Cuentas gestionado por <?php echo $gestor; ?> en <?php echo $fecha; ?></title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#000000;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;table-layout:fixed;}
     tr:hover {background-color: #ff0000;}
       th {border: 1pt solid #000000;background-color: #c0c0c0;}
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
<?php if ($updown=='') {$downup='desc';} else {$downup='';}?>
<a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $downup ?>&capt=<?php echo $capt ?>&reorden=yes&go=cliente&cliente=<?php echo $cliente ?>'>CLIENTE</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $downup ?>&capt=<?php echo $capt ?>&reorden=yes&go=pagos_vencidos&gestor=<?php echo $gestor ?>&fecha=<?php echo $fecha ?>&cliente=<?php echo $cliente ?>'>GESTOR</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $downup ?>&capt=<?php echo $capt ?>&reorden=yes&go=pagos_vencidos&gestor=<?php echo $gestor ?>&fecha=<?php echo $fecha ?>&cliente=<?php echo $cliente ?>'>PAGOS VENCIDOS</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $downup ?>&capt=<?php echo $capt ?>&reorden=yes&go=saldo_total&gestor=<?php echo $gestor ?>&fecha=<?php echo $fecha ?>&cliente=<?php echo $cliente ?>'>SALDO TOTAL</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $downup ?>&capt=<?php echo $capt ?>&reorden=yes&go=status_aarsa&gestor=<?php echo $gestor ?>&fecha=<?php echo $fecha ?>&cliente=<?php echo $cliente ?>'>RESULTADOS</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $downup ?>&capt=<?php echo $capt ?>&reorden=yes&go=fecha_promesa&gestor=<?php echo $gestor ?>&fecha=<?php echo $fecha ?>&cliente=<?php echo $cliente ?>'>FECHA PROMESSA</a></th>
<th><a href='<?php echo $_SERVER['PHP_SELF'] ?>?updown=<?php echo $downup ?>&capt=<?php echo $capt ?>&reorden=yes&go=monto_promesa&gestor=<?php echo $gestor ?>&fecha=<?php echo $fecha ?>&cliente=<?php echo $cliente ?>'>MONTO PROMESSA</a></th>
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
$FECHA_PROMESA=$row[14];
$MONTO_PROMESA=$row[13];
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
<td class='num'><?php echo number_format($MONTOTOTAL,0);?></td>
<td><?php echo $STATUS_AARSA;?></td>
<td><?php echo $FECHA_PROMESA;?></td>
<td><?php echo number_format($MONTO_PROMESA,0);?></td>
</tr>
<?php 
$count++;
} 
$nextpage=min($count-$i,$page+$i);
$prevpage=max($page-$i,0);
?>
</tbody>
</table>
<p id='paging'>
Resultados <?php echo $page+1 ?> a <?php echo $page+$i ?> de <?php echo $count ?>
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
