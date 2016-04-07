<?php
$host = "localhost";
$user = "root";
$pwd = "DeathSta1";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pwd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_GET['capt']);
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."' AND tipo='admin';";
$resultcheck=mysql_query($querycheck);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Reporte Avanzada</title>
<meta http-equiv="refresh" content="900"/>
<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #cc9900;}
       table {border: 1pt solid #000000;background-color: #ffffff;}
 	tr:hover {background-color: #ffff00;}
       th,td {border: 1pt solid #000000;background-color: #ffffff;}
       th,.heavy {font-weight:bold;font-size:10pt;}
       .heavytot {font-weight:bold;font-size:10pt;text-align:right;}
       .light {text-align:right;}
</style>
</head>
<body>
<!--
<h1>Hoy</h1>
<?php 
$querygdaily="select usuaria,
count(distinct historia.auto) as gestiones,
sum(n_prom>0) as promesas, sum(n_prom) as monto_prom, 
min(c_hrin) as primera_gestion, max(c_hrin) as ultima_gestion
 from historia join nombres on c_cvge=iniciales
 where d_fech=curdate()
 group by usuaria with rollup;";
//die($querygdaily);
$resultgdaily=mysql_query($querygdaily) or die(mysql_error());
?>
<table summary="today">
<tr>
<th>Gestor</th>
<th>Gestiones</th>
<th>Promesas</th>$id_cuenta=$answerbig[31];
<th>Monto Prom.</th>
<th>Monto Pag&oacute;</th>
<th>1er Gestion</th>
<th>Ult. Gestion</th>
</tr>
<?php while ($answergdaily=mysql_fetch_row($resultgdaily)) { 
	$gestor=$answergdaily[0];
	$gestiones=$answergdaily[1];
	$promesas=$answergdaily[2];
	$montoprom=$answergdaily[3];
	$primera=$answergdaily[4];
	$ultima=$answergdaily[5];
	$querypag="SELECT sum(monto) from pagos where fecha=curdate() and (cuenta,cliente) in (select cuenta,cliente from resumen where ejecutivo_asignado_call_center ='".$gestor."');";
	$resultpag=mysql_query($querypag) or die(mysql_error());
	$montopag=0;
	while ($answerpag=mysql_fetch_row($resultpag)) {$montopag=$answerpag[0];}
	?>
<tr>
<td><?php if (!empty($gestor)) {echo $gestor;} else {echo "TOTAL";}?></td>
<td><?php if (!empty($gestiones)) {echo $gestiones;}?></td>
<td><?php if (!empty($promesas)) {echo $promesas;}?></td>
<td><?php if (!empty($montoprom)) {echo number_format($montoprom);}?></td>
<td><?php echo number_format($montopag);?></td>
<td><?php if (!empty($primera)) {echo $primera;}?></td>
<td><?php if (!empty($ultima)) {echo $ultima;}?></td>
</tr>
<?php } ?>
</table>
<h1>Ayer</h1>
<?php 
$querygdaily="select usuaria,
count(distinct historia.auto) as gestiones,
sum(n_prom>0) as promesas, sum(n_prom) as monto_prom, 
min(c_hrin) as primera_gestion, max(c_hrin) as ultima_gestion
 from historia join nombres on c_cvge=iniciales
 where d_fech=subdate(curdate(),1)
 group by usuaria with rollup;";
//die($querygdaily);
$resultgdaily=mysql_query($querygdaily) or die(mysql_error());
?>
<table summary="yesterday">
<tr>
<th>Gestor</th>
<th>Gestiones</th>
<th>Promesas</th>
<th>Monto Prom.</th>
<th>Monto Pag&oacute;</th>
<th>1er Gestion</th>
<th>Ult. Gestion</th>
</tr>
<?php while ($answergdaily=mysql_fetch_row($resultgdaily)) { 
	$gestor=$answergdaily[0];
	$gestiones=$answergdaily[1];
	$promesas=$answergdaily[2];
	$montoprom=$answergdaily[3];
	$primera=$answergdaily[4];
	$ultima=$answergdaily[5];
	$querypag="SELECT sum(monto) from pagos where fecha=subdate(curdate(),1) and (cuenta,cliente) in (select cuenta,cliente from resumen where ejecutivo_asignado_call_center ='".$gestor."');";
	$resultpag=mysql_query($querypag) or die(mysql_error());
	$montopag=0;
	while ($answerpag=mysql_fetch_row($resultpag)) {$montopag=$answerpag[0];}
	?>
<tr>
<td><?php if (!empty($gestor)) {echo $gestor;} else {echo "TOTAL";}?></td>
<td><?php if (!empty($gestiones)) {echo $gestiones;}?></td>
<td><?php if (!empty($promesas)) {echo $promesas;}?></td>
<td><?php if (!empty($montoprom)) {echo number_format($montoprom);}?></td>
<td><?php echo number_format($montopag);?></td>
<td><?php if (!empty($primera)) {echo $primera;}?></td>
<td><?php if (!empty($ultima)) {echo $ultima;}?></td>
</tr>
<?php } ?>
</table>
<h1>Esta Semana</h1>
<?php 
$querygdaily="select usuaria,
count(distinct historia.auto) as gestiones,
sum(n_prom>0) as promesas, sum(n_prom) as monto_prom
 from historia join nombres on c_cvge=iniciales
 where week(d_fech)=week(curdate()) and year(d_fech)=year(curdate())
 group by usuaria with rollup;";
//die($querygdaily);
$resultgdaily=mysql_query($querygdaily) or die(mysql_error());
?>
<table summary="this week">
<tr>
<th>Gestor</th>
<th>Gestiones</th>
<th>Promesas</th>
<th>Monto Prom.</th>
<th>Monto Pag&oacute;</th>
</tr>
<?php while ($answergdaily=mysql_fetch_row($resultgdaily)) { 
	$gestor=$answergdaily[0];
	$gestiones=$answergdaily[1];
	$promesas=$answergdaily[2];
	$montoprom=$answergdaily[3];
	?>
<tr>
<td><?php if (!empty($gestor)) {echo $gestor;} else {echo "TOTAL";}?></td>
<td><?php if (!empty($gestiones)) {echo $gestiones;}?></td>
<td><?php if (!empty($promesas)) {echo $promesas;}?></td>
<td><?php if (!empty($montoprom)) {echo number_format($montoprom);}?></td>
<td><?php echo number_format($montopag);?></td>
</tr>
<?php } ?>
</table>
<h1>14 D&iacute;as</h1>
<?php 
$querygdaily="select usuaria,
count(distinct historia.auto) as gestiones,
sum(n_prom>0) as promesas, sum(n_prom) as monto_prom
 from historia join nombres on c_cvge=iniciales
 where d_fech>subdate(curdate(),14)
 group by usuaria with rollup;";
//die($querygdaily);
$resultgdaily=mysql_query($querygdaily) or die(mysql_error());
?>
<table summary="biweekly">
<tr>
<th>Gestor</th>
<th>Gestiones</th>
<th>Promesas</th>
<th>Monto Prom.</th>
<th>Monto Pag&oacute;</th>
</tr>
<?php while ($answergdaily=mysql_fetch_row($resultgdaily)) { 
	$gestor=$answergdaily[0];
	$gestiones=$answergdaily[1];
	$promesas=$answergdaily[2];
	$montoprom=$answergdaily[3];
	?>
<tr>
<td><?php if (!empty($gestor)) {echo $gestor;} else {echo "TOTAL";}?></td>
<td><?php if (!empty($gestiones)) {echo $gestiones;}?></td>
<td><?php if (!empty($promesas)) {echo $promesas;}?></td>
<td><?php if (!empty($montoprom)) {echo number_format($montoprom);}?></td>
<td><?php echo number_format($montopag);?></td>
</tr>
<?php } ?>
</table>
<h1>Esta mes</h1>
<?php 
$querygdaily="select usuaria,
count(distinct historia.auto) as gestiones,
sum(n_prom>0) as promesas, sum(n_prom) as monto_prom
 from historia join nombres on c_cvge=iniciales
 where month(d_fech)=month(curdate()) and year(d_fech)=year(curdate())
 group by usuaria with rollup;";
//die($querygdaily);
$resultgdaily=mysql_query($querygdaily) or die(mysql_error());
?>
<table summary="this month">
<tr>
<th>Gestor</th>
<th>Gestiones</th>
<th>Promesas</th>
<th>Monto Prom.</th>
<th>Monto Pag&oacute;</th>
</tr>
<?php while ($answergdaily=mysql_fetch_row($resultgdaily)) { 
	$gestor=$answergdaily[0];
	$gestiones=$answergdaily[1];
	$promesas=$answergdaily[2];
	$montoprom=$answergdaily[3];
	?>
<tr>
<td><?php if (!empty($gestor)) {echo $gestor;} else {echo "TOTAL";}?></td>
<td><?php if (!empty($gestiones)) {echo $gestiones;}?></td>
<td><?php if (!empty($promesas)) {echo $promesas;}?></td>
<td><?php if (!empty($montoprom)) {echo number_format($montoprom);}?></td>
<td><?php echo number_format($montopag);?></td>
</tr>
<?php } ?>
</table>
-->
<?php
$querybig="select Nombre_deudor,	Domicilio_Deudor,	Colonia_Deudor,
Ciudad_Deudor,	Estado_Deudor,	CP_deudor,	Plano_Guia_Roji,
Cuadrante_Guia_Roji,	Tel_1,	Tel_2,	Numero_de_cuenta,
Numero_de_Credito,	Contrato,	Saldo_Total,	Saldo_Vencido,
Saldo_Descuento_1,	Saldo_Descuento_2,	Fecha_Corte,
Fecha_Limite,	Fecha_de_Ultimo_Pago,	Monto_Ultimo_Pago,
Producto,	Subproducto,	Cliente,	Status_de_Credito,
Pagos_Vencidos,	pc_de_Descuento,	Fecha_de_Asignacion,
	Expediente,
ID_CUENTA,	c_cvst,	c_motiv,	c_ACCION,
c_obse1,	d_fech, c_Hrin,	c_cvge,	n_prom,	d_prom, c_cnp
from resumen join historia on id_cuenta=c_cont 
where year(d_fech)=year(curdate()) and month(d_fech)=month(curdate())
order by id_cuenta";
$resultbig=mysql_query($querybig) or die(mysql_error());
?>
<table summary="big">
<tr>
<th>Nombre deudor </th>
<th>Domicilio Deudor </th>
<th>Colonia Deudor </th>
<th>Ciudad Deudor </th>
<th>Estado Deudor </th>
<th>CP deudor</th>
<th>Plano Guia Roji</th>
<th>Cuadrante Guia Roji</th>
<th>Tel 1</th>
<th>Tel 2</th>
<th>Numero de cuenta </th>
<th>Nummero de Credito </th>
<th>Contrato</th>
<th>Saldo Total </th>
<th>Salvo Vencido </th>
<th>Saldo Descuento 1</th>
<th>Saldo Descuento 2</th>
<th>Fecha Corte </th>
<th>Fecha Limite </th>
<th>Fecha de Ultimo Pago </th>
<th>Monto Ultimo Pago </th>
<th>Producto </th>
<th>Subproducto </th>
<th>Cliente </th>
<th>Status de Credito </th>
<th>Pagos Vencidos </th>
<th>% de Descuento</th>
<th>Ciclo de Asignacion</th>
<th>Expediente </th>
<th>ID CUENTA </th>
<th>CODIGOS DE RESULTADO</th>
<th>MOTIVADORES</th>
<th>ACCION </th>
<th>LOS COMENTARIOS DE LA GESTION </th>
<th>FECHA DE LA GESTION </th>
<th>HORA DE LA GESTION</th>
<th>ID Y USUARIO</th>
<th>MONTO PP</th>
<th>FECHA PP </th>
<th>CAUSAS DE NO PAGO </th>
</tr>
<?php 
$id_cuenta=0;
	while ($answerbig=mysql_fetch_row($resultbig)) {
?>
<tr>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[0];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[1];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[2];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[3];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[4];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[5];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[6];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[7];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[8];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[9];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[10];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[11];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[12];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[13];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[14];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[15];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[16];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[17];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[18];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[19];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[20];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[21];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[22];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[23];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[24];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[25];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[26];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[27];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[28];}; ?></td>
<td><?php if ($id_cuenta != $answerbig[29]) {echo $answerbig[29];$id_cuenta=$answerbig[29];}; ?></td>
<td><?php echo $answerbig[30]; ?></td>
<td><?php echo $answerbig[31]; ?></td>
<td><?php echo $answerbig[32]; ?></td>
<td><?php echo $answerbig[33]; ?></td>
<td><?php echo $answerbig[34]; ?></td>
<td><?php echo $answerbig[35]; ?></td>
<td><?php echo $answerbig[36]; ?></td>
<td><?php echo $answerbig[37]; ?></td>
<td><?php echo $answerbig[38]; ?></td>
<td><?php echo $answerbig[39]; ?></td>
</tr>
<?php } ?>
</table>
</body>
</html>
<?php   
}
}
mysql_close($con);
?>
</body>
</html>
