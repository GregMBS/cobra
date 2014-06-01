<?php  
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querylp="CREATE TEMPORARY TABLE lastprom SELECT c_cont,max(auto) AS lp FROM historia 
WHERE (c_cvst = 'PROPUESTA DE PAGO')
GROUP BY c_cont";
mysql_query($querylp) or die(mysql_error());
$query1 = "select D_PROM, CUENTA, N_PROM, C_CVGE, 
ejecutivo_asignado_call_center, STATUS_AARSA, saldo_total,cliente,
id_cuenta,saldo_descuento_1 
from historia join resumen on C_CONT=ID_CUENTA join lastprom on historia.auto=lp
where N_PROM>0  and c_cvge <> '' 
and c_cvst = 'PROPUESTA DE PAGO' 
and cuenta in (select cuenta from pagos where cliente='Credito Si')
and cliente='Credito Si'
order by CUENTA";
$result1 = mysql_query($query1) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Promesas activas de Credito Si</title>
<style type="text/css">
	body {font-family: arial, helvetica, sans-serif; font-size: 10pt; background-color: #c0c0a0;}
	table {background-color: #ffffff;}
	td.breaker{border-top: medium black solid;}
     tr:hover {background-color: #ffff00;}
</style>
</head>
<body>
<table summary="Propuestas Table">
<tr>
<th>Fecha Prom.</th>
<th>Cuenta</th>
<th>Cliente</th>
<th>Monto Prom.</th>
<th>Monto Total</th>
<th>Gestor de Prom.</th>
<th>Gestor Asig.</th>
<th>Monto Pago</th>
<th>Fecha Pago</th>
<th>Status</th>
</tr>
<?php 
$snp=0;
$smt=0;
$smp=0;
while ($answerstart = mysql_fetch_row($result1)) {
$D_PROM=$answerstart[0];
$CUENTA=$answerstart[1];
$N_PROM=$answerstart[2];
$snp=$snp+$N_PROM;
$C_CVGE=$answerstart[3];
$GESTOR=$answerstart[4];
$STATUS=$answerstart[5];
$MT=$answerstart[6];
$smt=$smt+$MT;
$CLIENTE=$answerstart[7];
$ID_CUENTA=$answerstart[8];
$S_D=$answerstart[9];
$querypag="select sum(monto) as sm, max(fecha) as mf from pagos where CUENTA='".$CUENTA."' and CLIENTE='".$CLIENTE."';";
$resultp = mysql_query($querypag) or die(mysql_error());
$MONTO=0;
$FECHA='';
while ($answerp = mysql_fetch_row($resultp)) {
$MONTO=$answerp[0];
$smp=$smp+$MONTO;
if ($MONTO>0) {$FECHA=$answerp[1];}
}
?>
<tr>
<td><?php echo $D_PROM;?></td>
<td><a href='resumen.php?go=FROMPROM&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA;?>&capt=<?php echo $capt;?>'><?php echo $CUENTA;?></a></td>
<td><?php echo $CLIENTE;?></td>
<td align="right"><?php echo number_format($N_PROM,2);?></td>
<td align="right"><?php echo number_format($MT,2);?></td>
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
<td>&nbsp;</td>
<td>TOTAL</td>
<td>&nbsp;</td>
<td align="right"><?php echo number_format($snp,2);?></td>
<td align="right"><?php echo number_format($smt,2);?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td align="right"><?php echo number_format($smp,2);?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>
</form>
</div>
</div>
</body>
</html>
<?php 
}
}
mysql_close($con);
?>
