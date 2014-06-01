<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_REQUEST['capt']);
$updown='';
	 set_time_limit(300);
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."' AND tipo='admin';";
$resultcheck=mysql_query($querycheck);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$go='';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Pagos del mes actual</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#000000;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;border-collapse: collapse;}
     tr:hover {background-color: #ff0000;}
       th {border: 2pt solid #000000;background-color: #c0c0c0;}
       td {border: 1pt solid #000000;background-color: #c0c0c0;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
 </style>

</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<h2>Mes Actual</h2>
<table summary="Por cliente este mes">
<thead>
<tr>
<th>Cliente</th>
<th>Campaña</th>
<th>Monto Pago Capturado</th>
<th>Monto Pago Confirmado</th>
</tr>
</thead>
<tbody>
<?php
$query="select pagos.cliente,status_de_credito,sum(monto),sum(monto*confirmado) 
from pagos join resumen using (id_cuenta)
where fecha>last_day(curdate()-interval 1 month)
group by cliente,status_de_credito with rollup";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$CLIENTE=$row[0];
$SDC=$row[1];
if (empty($SDC)) {$SDC='total';}
$PAGO=number_format($row[2],2);
$CONF=number_format($row[3],2);
?>
<tr>
<td><?php echo $CLIENTE;?></td>
<td><?php echo $SDC;?></td>
<td class="num"><?php echo $PAGO;?></td>
<td class="num"><?php echo $CONF;?></td>
</tr>
<?php } ?>
</tbody>
</table>
<table summary="Por gestor por cliente este mes">
<thead>
<tr>
<th>Gestor</th>
<th>Cliente</th>
<th>Monto Pago Capturado</th>
<th>Monto Pago Confirmado</th>
</tr>
</thead>
<tbody>
<?php
$query="select gestor,cliente,
sum(monto),sum(monto*confirmado) 
from pagos  
where fecha>last_day(curdate()-interval 1 month)
group by gestor,cliente";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$GESTOR=$row[0];
$CLIENTE=$row[1];
$PAGO=number_format($row[2],2);
$CONF=number_format($row[3],2);
?>
<tr>
<td><?php echo $GESTOR;?></td>
<td><?php echo $CLIENTE;?></td>
<td class="num"><?php echo $PAGO;?></td>
<td class="num"><?php echo $CONF;?></td>
</tr>
<?php } ?>
</tbody>
</table>
<table summary="Detalles">
<thead>
<tr>
<th>Cuenta</th>
<th>Fecha</th>
<th>Monto</th>
<th>Cliente</th>
<th>Gestor</th>
<th>Confirmado</th>
</tr>
</thead>
<tbody>
<?php
$query="select cuenta, fecha, monto, cliente, gestor, confirmado 
from pagos 
where fecha>last_day(curdate()-interval 1 month)
order by cliente,gestor,fecha";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$CUENTA=$row[0];
$FECHA=$row[1];
$MONTO=number_format($row[2],2);
$CLIENTE=$row[3];
$GESTOR=$row[4];
$CONF=$row[5];
?>
<tr>
<td><?php echo $CUENTA;?></td>
<td><?php echo $FECHA;?></td>
<td class="num"><?php echo $MONTO;?></td>
<td><?php echo $CLIENTE;?></td>
<td><?php echo $GESTOR;?></td>
<td><?php echo $CONF;?></td>
</tr>
<?php } ?>
</tbody>
</table>
<h2>Mes Anterior</h2>
<table summary="Por cliente mes anterior">
<thead>
<tr>
<th>Cliente</th>
<th>Campaña</th>
<th>Monto Pago Capturado</th>
<th>Monto Pago Confirmado</th>
</tr>
</thead>
<tbody>
<?php
$query="select pagos.cliente,status_de_credito,sum(monto),sum(monto*confirmado) 
from pagos join resumen using (id_cuenta)
where fecha<=last_day(curdate()-interval 1 month)
and fecha>last_day(curdate()-interval 2 month)
group by cliente,status_de_credito with rollup";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$CLIENTE=$row[0];
$SDC=$row[1];
if (empty($SDC)) {$SDC='total';}
$PAGO=number_format($row[2],2);
$CONF=number_format($row[3],2);
?>
<tr>
<td><?php echo $CLIENTE;?></td>
<td><?php echo $SDC;?></td>
<td class="num"><?php echo $PAGO;?></td>
<td class="num"><?php echo $CONF;?></td>
</tr>
<?php } ?>
</tbody>
</table>
<table summary="Por gestor por cliente este mes">
<thead>
<tr>
<th>Gestor</th>
<th>Cliente</th>
<th>Monto Pago Capturado</th>
<th>Monto Pago Confirmado</th>
</tr>
</thead>
<tbody>
<?php
$query="select gestor,cliente,
sum(monto),sum(monto*confirmado) 
from pagos  
where fecha<=last_day(curdate()-interval 1 month)
and fecha>last_day(curdate()-interval 2 month)
group by gestor,cliente";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$GESTOR=$row[0];
$CLIENTE=$row[1];
$PAGO=number_format($row[2],2);
$CONF=number_format($row[3],2);
?>
<tr>
<td><?php echo $GESTOR;?></td>
<td><?php echo $CLIENTE;?></td>
<td class="num"><?php echo $PAGO;?></td>
<td class="num"><?php echo $CONF;?></td>
</tr>
<?php } ?>
</tbody>
</table>
<table summary="Detalles">
<thead>
<tr>
<th>Cuenta</th>
<th>Fecha</th>
<th>Monto</th>
<th>Cliente</th>
<th>Gestor</th>
<th>Confirmado</th>
</tr>
</thead>
<tbody>
<?php
$query="select cuenta, fecha, monto, cliente, gestor, confirmado 
from pagos 
where fecha<=last_day(curdate()-interval 1 month)
and fecha>last_day(curdate()-interval 2 month)
order by cliente,gestor,fecha";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$CUENTA=$row[0];
$FECHA=$row[1];
$MONTO=number_format($row[2],2);
$CLIENTE=$row[3];
$GESTOR=$row[4];
$CONF=$row[5];
?>
<tr>
<td><?php echo $CUENTA;?></td>
<td><?php echo $FECHA;?></td>
<td class="num"><?php echo $MONTO;?></td>
<td><?php echo $CLIENTE;?></td>
<td><?php echo $GESTOR;?></td>
<td><?php echo $CONF;?></td>
</tr>
<?php } ?>
</tbody>
</table>
<?php   
}
}
mysql_close($con);
?>
</body>
</html> 
