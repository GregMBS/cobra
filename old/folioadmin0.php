<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
set_time_limit(300);
$go='';
if (!empty($_GET['go'])) {
$go=mysql_real_escape_string($_GET['go']);
$getname='FOLIO'.mysql_real_escape_string($_GET['client']).mysql_real_escape_string($_GET['j']);
	}
if ($go=="ENVIADO") {
	$querye="UPDATE folios 
	SET enviado=1
	WHERE folio=".mysql_real_escape_string($_GET[$getname]);
	$resulte = mysql_query($querye) or die(mysql_error());
	}
if ($go=="UPDATE") {
	$queryu="UPDATE folios,resumen 
	SET fecha=now(),enviado=0,mora=dias_vencidos
	WHERE id=id_cuenta and folio=".mysql_real_escape_string($_GET[$getname]);
	$resultu = mysql_query($queryu) or die(mysql_error());
	}
$querymaina = "create temporary table foliolist 
select folios.cliente,folio,enviado,
ifnull(numero_de_credito,numero_de_cuenta),
nombre_deudor,capital,saldo_can,
mora,h1.n_prom,h1.d_prom1,h1.n_prom1,h1.d_prom2,h1.n_prom2,
cuenta_concentradora_1,h1.d_fech,resumen.id_cuenta,
if(creditosi,h1.c_cvst,h1.c_cnp),folios.auto,ciudad_deudor,estado_deudor,
folios.gestor,who(status_de_credito),h2.auto as upd,h1.c_prom,h1.c_freq,
to_days(h1.d_prom2)-to_days(h1.d_prom1)
from resumen 
join folios on id=id_cuenta
join historia h1 on h1.c_cont=id and folios.fecha>=h1.d_fech and h1.n_prom>0
join dictamenes on h1.c_cvst=dictamenes.dictamen
left join historia h2 on h2.c_cont=id and h2.n_prom>0 
and folios.fecha<concat(h2.d_fech,' ',h2.c_hrin) and h2.c_cvst like 'PRO%DE%'
left join pagos on resumen.id_cuenta=pagos.id_cuenta 
and pagos.fecha>last_day(curdate()-interval 1 month) 
and pagos.fecha<h1.d_fech
and confirmado=0
where folios.fecha>last_day(curdate()-interval 1 month)+interval 1 day
and h1.d_prom>last_day(curdate()-interval 1 month)
and saldo_can=saldo_total and monto is null
and folios.cliente regexp 'Credito Si'
";
mysql_query($querymaina) or die(mysql_error());
$querymainb = "insert into foliolist 
select folios.cliente,folio,enviado,
ifnull(numero_de_credito,numero_de_cuenta),
nombre_deudor,capital,saldo_can,
mora,sum(pagos.monto),max(pagos.fecha),sum(pagos.monto),h1.d_prom1,h1.n_prom1,
cuenta_concentradora_1,h1.d_fech,resumen.id_cuenta,
if(creditosi,h1.c_cvst,h1.c_cnp),folios.auto,ciudad_deudor,estado_deudor,
folios.gestor,who(status_de_credito),h2.auto as upd,h1.c_prom,h1.c_freq,
to_days(h1.d_prom1)-to_days(max(pagos.fecha))
from resumen 
join folios on id=id_cuenta
join historia h1 on h1.c_cont=id and folios.fecha>=h1.d_fech and h1.n_prom>0
join dictamenes on h1.c_cvst=dictamenes.dictamen
left join historia h2 on h2.c_cont=id and h2.n_prom>0 
and h2.d_fech > h1.d_fech and folios.fecha>h2.d_fech 
and h2.c_cvst like 'PRO%DE%'
join pagos on resumen.id_cuenta=pagos.id_cuenta 
and pagos.fecha>last_day(curdate()-interval 1 month) 
and pagos.fecha<h1.d_fech
and confirmado=0
where folios.fecha>last_day(curdate()-interval 1 month)+interval 1 day
and h1.d_prom>last_day(curdate()-interval 1 month)
and saldo_can=saldo_total and h2.auto is null
and folios.cliente regexp 'Credito Si' group by folio
";
mysql_query($querymainb) or die(mysql_error());
$querymainc="select * from foliolist 
order by enviado,upd desc,
folio desc,d_fech desc,d_prom1 desc;";
$resultc=mysql_query($querymainc) or die(mysql_error());
$k=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Listado de los Folios</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; 
       background-color: white; color: black;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;}
     tr:hover {background-color: #ffff00;}
       th {border: 1pt solid #000000;background-color: #c0c0c0;}
    td.copypaste {background-color: #ffffff;font-family:'Calibri'; font-size:8pt;}
    td.copypaste2 {background-color: #ffffdd;font-family:'Calibri'; font-size:8pt;}
    th.copypaste {background-color: #00ccff;font-family:'Calibri'; font-size:8pt;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
 </style>
</head>
<body>
<div><a name='top'></div>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la Pagina Administrativa</button><br>
<p>
<button onclick="window.location='foliocreatepend.php?capt=<?php echo $capt;?>'">CREAR PENDIENTES</button></td>
<button onclick="window.location='foliocreateall.php?capt=<?php echo $capt;?>'">CREAR REPORTE</button></td>
</p>
<table summary="Folioa">
<thead>
<tr>
<form action="#here0" method="get" name="folios">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<input type="hidden" name="reorden" value="yes">
<th>Cliente</th>
<th>Folio</th>
<!--<th>Crear archivo</th>-->
<th>Enviado?</th>
<th>Update?</th>
<th>Crear</th>
<th class='copypaste'>N&deg; Credito</th>
<th class='copypaste'>Nombre del Cliente</th>
<th class='copypaste'>Capital</th>
<th class='copypaste'>Saldo Cancellaci&oacute;n</th>
<th class='copypaste'>D&iacute;as de Mora</th>
<th class='copypaste'>Importe Negociado</th>
<th class='copypaste'>Fecha de pago 1</th>
<th class='copypaste'>Monto de pago 1</th>
<th class='copypaste'>Fecha de pago 2</th>
<th class='copypaste'>Monto de pago 2</th>
<th class='copypaste'>Folio Conv</th>
<th class='copypaste'>Motivo de atraso</th>
<th class='copypaste'>Medio de pago</th>
<th class='copypaste'>Asignaci&oacute;n</th>
<th class='copypaste'>Frecuencia de pago</th>
<th>Fecha de Firma</th>
<th>Gestor</th>
<th>Campaña</th>
</tr>
</thead>
<tbody>
<?php
$j=0;
$of=0;
while($row = mysql_fetch_row($resultc)) {
$FOLIO=$row[1];
if ($of!=$FOLIO) {
$of=$FOLIO;
$j=$j+1;
$CLIENTE=$row[0];
$ENVIADO=$row[2];
$CUENTA=$row[3];
$NOMBRE=$row[4];
$SD=$row[5];
$ST=$row[6];
$DV=$row[7];
$NP=$row[8];
$d1 = date_create($row[9]);$DP1=date_format($d1, 'd/m/Y');
$NP1=$row[10];
$d2 = date_create($row[11]);$DP2=date_format($d2, 'd/m/Y');
$NP2=$row[12];
if ($NP2==0) {$DP2='';$NP2='';}
$COBRADOR=$row[13];
$DFECH=$row[14];
$ID_CUENTA=$row[15];
$CNP=trim($row[16]);
$auto=$row[17];
$ciudad=$row[18];
$estado=$row[19];
$GESTOR=$row[20];
$CAMP=$row[21];
$UPD=$row[22];
$MDP=$row[23];
$FREQ='quincenal';
$DIFF=$row[25];
if ($DIFF<14) {$FREQ='semanal';}
if ($DIFF>20) {$FREQ='mensual';}
if (empty($DIFF)) {$FREQ='mensual';}
$CNPA='MD';
$querycnp="select csi_cr from csidict where dictamen sounds like '".$CNP."';";
$resultcnp = mysql_query($querycnp) or die(mysql_error());
while($rowcnp = mysql_fetch_row($resultcnp)) {$CNPA=$rowcnp[0];}
?>
<tr>
<form name="foliolinea<?php echo $auto ?>" method="get" action=
"#here0" id="foliolinea<?php echo $auto ?>">
<input type="hidden" name="client" value="a">
<input type="hidden" name="capt" value="<?php echo $capt ?>"> 
<input type="hidden" name="j" value="<?php echo $auto ?>"> 
<input type="hidden" name="CLIENTEa<?php echo $auto;?>" value="<?php echo $CLIENTE ?>"> 
<input type="hidden" name="FOLIOa<?php echo $auto;?>" value="<?php echo $FOLIO ?>"> 
<td class='num'>
<?php if ($ENVIADO==0) {?>
<a name='here<?php echo $k; ?>'></a>
<?php 
$k++;
} ?>
<?php echo $CLIENTE;?></td>
<td><?php echo $FOLIO;?></td>
<td><?php if ($ENVIADO==0) {?>
<input type="submit" name="go" value="ENVIADO">
<?php } else {?>
<input type="checkbox" name="ENVIADO" value="1" checked="checked" class="copypaste"/>
<?php } ?>
</td>
<?php if ($UPD>0) { ?>
<td><input type="submit" name="go" value="UPDATE"></td>
<?php } else { ?>
<td>NO</td>
<?php } ?>
<td><a href='foliocreate.php?capt=<?php echo $capt;?>&&folio=<?php echo $FOLIO;?>'>CREAR</a></td>
<td class='copypaste'><a href='resumen.php?go=FROMMIGO&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA;?>&capt=<?php echo $capt;?>'><?php echo $CUENTA;?></a></td>
<td class='copypaste'><?php echo utf8_decode($NOMBRE);?></td>
<td class='num copypaste'><?php echo $SD;?></td>
<td class='num copypaste'><?php echo $ST;?></td>
<td class='num copypaste'><?php echo $DV;?></td>
<td class='num copypaste'><?php echo $NP;?></td>
<td class='num copypaste'><?php echo $DP1;?></td>
<td class='num copypaste'><?php echo $NP1;?></td>
<td class='num copypaste'><?php echo $DP2;?></td>
<td class='num copypaste'><?php echo $NP2;?></td>
<td class='copypaste'><?php echo $FOLIO;?></td>
<td class='num copypaste'><?php echo $CNPA;?></td>
<td class='num copypaste'><?php echo $MDP;?></td>
<td class='num copypaste'><?php echo $COBRADOR;?></td>
<td class='num copypaste'><?php echo $FREQ;?></td>
<td class='num'><?php echo $DFECH;?></td>
<td><?php echo $GESTOR;?></td>
<td><?php echo $CAMP;?></td>
</form>
</tr>
<?php }} ?>
</tbody>
</table>
</body>
</html> 
<?php
}  
} 
mysql_close($con);
?>
