<?php  
$host = "localhost";
$user = "root";
$pwd = "DeathSta1";
$db = "cobrajdlr";
$con = mysql_connect($host,$user,$pwd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$fromresume = (empty($_GET['C_RCON']));
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_GET['capt']);
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."' AND tipo='admin';";
$resultcheck=mysql_query($querycheck);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$query1 = "select D_PROM, historia.CUENTA, N_PROM, C_CVGE, ejecutivo_asignado_call_center, STATUS_DE_CREDITO, saldo_vencido from historia join resumen on C_CONT=ID_CUENTA where N_PROM>0 and month(D_PROM)=month(curdate() - interval 5 day) and to_days(D_PROM)<=to_days(curdate()) and status_de_credito regexp ' inc' group by CUENTA order by D_PROM,ejecutivo_asignado_call_center,CUENTA";
$result1 = mysql_query($query1) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Promesas de esta mes a hoy</title>
<style type="text/css">
	body {font-family: arial, helvetica, sans-serif; font-size: 10pt; background-color: #c0c0a0;}
	table {background-color: #ffffff;}
	td.breaker{border-top: medium black solid;}
     tr:hover {background-color: #ffff00;}
</style>
</head>
<body>
<table summary="Promesas Table">
<tr>
<th>Fecha Prom.</th>
<th>Cuenta</th>
<th>Monto Prom.</th>
<th>Monto Venc. sin GC</th>
<th>Capturista</th>
<th>Gestor</th>
<th>Monto Pago</th>
<th>Fecha Pago</th>
<th>Status</th>
</tr>
<?php 
while ($answerstart = mysql_fetch_row($result1)) {
$D_PROM=$answerstart[0];
$CUENTA=$answerstart[1];
$N_PROM=$answerstart[2];
$C_CVGE=$answerstart[3];
$GESTOR=$answerstart[4];
$STATUS=$answerstart[5];
$MSGC=$answerstart[6];
$querypag="select sum(monto) as sm, max(fecha) as mf from pagos where CUENTA=".$CUENTA;
$resultp = mysql_query($querypag) or die(mysql_error());
$MONTO=0;
$FECHA='';
while ($answerp = mysql_fetch_row($resultp)) {
$MONTO=$answerp[0];
if ($MONTO>0) {$FECHA=$answerp[1];}
}
?>
<tr>
<td><?php echo $D_PROM;?></td>
<td><a href='resumen.php?go=FROMMIGO&i=0&field=CUENTA&find=<?php echo $CUENTA;?>&capt=<?php echo $capt;?>'><?php echo $CUENTA;?></a></td>
<td align="right"><?php echo number_format($N_PROM,2);?></td>
<td align="right"><?php echo number_format($MSGC,2);?></td>
<td><?php echo $C_CVGE;?></td>
<td><?php echo $GESTOR;?></td>
<td align="right"><?php echo number_format($MONTO,2);?></td>
<td><?php echo $FECHA;?></td>
<td><?php echo $STATUS;?></td>
</tr>
<?php 
}
?>
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
