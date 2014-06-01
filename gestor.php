<?php
include('admin_hdr.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$gestor=mysql_real_escape_string($_REQUEST['gestor']);
$query="select D_PROM, CUENTA, N_PROM, C_CVGE, ejecutivo_asignado_call_center, STATUS_AARSA, saldo_vencido,cliente,id_cuenta,saldo_descuento_1 from historia join resumen on C_CONT=ID_CUENTA where N_PROM>0  and c_cvge =lcase('".$gestor."') group by CUENTA order by C_CVGE,D_PROM,CLIENTE,CUENTA";
$result = mysql_query($query) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo strtoupper($gestor);?></title>
<meta http-equiv="refresh" content="900"/>
<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #000000; color:#ffffff}
       table {border: 1pt solid #000000;background-color: #7f7f7f;}
 	tr:hover {background-color: #00ff00;}
       th,td {border: 1pt solid #000000;background-color: #7f7f7f;}
       th,.heavy {font-weight:bold;font-size:10pt;}
       .heavytot {font-weight:bold;font-size:10pt;text-align:right;}
       .light {text-align:right;}
</style>
</head>
<body>
<h2>PROMESAS Y PAGOS PARA <?php echo strtoupper($gestor);?></h2>
<table summary="LpH">
<thead>
<tr>
<th>Fecha Prom.</th>
<th>Cuenta</th>
<th>Cliente</th>
<th>Monto Prom.</th>
<th>Monto Venc.</th>
<th>Saldo Desc.</th>
<th>Gestor de Prom.</th>
<th>Gestor Asig.</th>
<th>Monto Pago</th>
<th>Fecha Pago</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<?php
$sumpr=0;
$sump=0; 
while ($answerstart = mysql_fetch_row($result)) {
$D_PROM=$answerstart[0];
$CUENTA=$answerstart[1];
$N_PROM=$answerstart[2];
$sumpr+=$N_PROM;
$C_CVGE=$answerstart[3];
$GESTOR=$answerstart[4];
$STATUS=$answerstart[5];
$MSGC=$answerstart[6];
$CLIENTE=$answerstart[7];
$ID_CUENTA=$answerstart[8];
$S_D=$answerstart[9];
$querypag="select sum(monto) as sm, max(fecha) as mf from pagos where CUENTA='".$CUENTA."' and CLIENTE='".$CLIENTE."';";
$resultp = mysql_query($querypag) or die(mysql_error());
$MONTO=0;
$FECHA='';
while ($answerp = mysql_fetch_row($resultp)) {
$MONTO=$answerp[0];
$sump+=$MONTO;
if ($MONTO>0) {$FECHA=$answerp[1];}
}
?>
<tr>
<td><?php echo $D_PROM;?></td>
<td><a href='resumen.php?go=FROMPROM&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA;?>&capt=<?php echo $capt;?>'><?php echo $CUENTA;?></a></td>
<td><?php echo $CLIENTE;?></td>
<td align="right"><?php echo number_format($N_PROM,2);?></td>
<td align="right"><?php echo number_format($MSGC,2);?></td>
<td align="right"><?php echo number_format($S_D,2);?></td>
<td><?php echo $C_CVGE;?></td>
<td><?php echo $GESTOR;?></td>
<td align="right"><?php echo number_format($MONTO,2);?></td>
<td><?php echo $FECHA;?></td>
<td><?php echo $STATUS;?></td>
</tr>
<?php 
}
?>
<tr>
<td>SUM</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<th align="right"><?php echo number_format($sumpr,2);?></th>
<td align="right">&nbsp;</td>
<td align="right">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<th align="right"><?php echo number_format($sump,2);?></th>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<?php
}
}
mysql_close($con);
?>
</body>
</html>
