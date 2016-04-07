<?php
setlocale(LC_ALL, 'es_MX');
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra4";
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
<title>Pagos</title>

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
<h2>Mes actual (<?php echo strftime("%h",strtotime("last week"));?>)</h2>
<table summary="Por gestor por cliente este mes">
<thead>
<tr>
<th>Gestor</th>
<th>Cliente</th>
<th>Camp</th>
<th>Monto Pago</th>
<th>Monto Confirmado</th>
</tr>
</thead>
<tbody>
<?php
$SM=0;
$SMC=0;
$query="select gestor,pagos.cliente,sum(monto),sum(monto*confirmado),who(status_de_credito) 
from pagos join resumen using (id_cuenta) 
where fecha>last_day(curdate()-interval 1 month-interval 1 week)
and fecha<=last_day(curdate()-interval 1 week)
group by gestor,cliente,who(status_de_credito)";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$GESTOR=$row[0];
$CLIENTE=$row[1];
$SDC=$row[4];
$MONTO=number_format($row[2],2);
$MONTOC=number_format($row[3],2);
$SM=$SM+$row[2];
$SMC=$SMC+$row[3];
?>
<tr>
<td><?php echo $GESTOR;?></td>
<td><?php echo $CLIENTE;?></td>
<td><?php echo $SDC;?></td>
<td class="num"><?php echo $MONTO;?></td>
<td class="num"><?php echo $MONTOC;?></td>
</tr>
<?php } ?>
<tr>
<th colspan=3>SUM</th>
<th class="num"><?php echo number_format($SM,2);?></th>
<th class="num"><?php echo number_format($SMC,2);?></th>
</tr>
</tbody>
</table>
<h2>Mes anterior (<?php echo strftime("%h",strtotime("5 weeks ago"));?>)</h2>
<table summary="Por gestor por cliente mes anterior">
<thead>
<tr>
<th>Gestor</th>
<th>Cliente</th>
<th>Monto Pago</th>
<th>Monto Confirmado</th>
</tr>
</thead>
<tbody>
<?php
$SM=0;
$SMC=0;
$query="select gestor,cliente,sum(monto),sum(monto*confirmado) 
from pagos 
where fecha>last_day(curdate()-interval 2 month-interval 1 week)
and fecha<=last_day(curdate()-interval 1 month-interval 1 week)
group by gestor,cliente";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$GESTOR=$row[0];
$CLIENTE=$row[1];
$MONTO=number_format($row[2],2);
$MONTOC=number_format($row[3],2);
$SM=$SM+$row[2];
$SMC=$SMC+$row[3];
?>
<tr>
<td><?php echo $GESTOR;?></td>
<td><?php echo $CLIENTE;?></td>
<td class="num"><?php echo $MONTO;?></td>
<td class="num"><?php echo $MONTOC;?></td>
</tr>
<?php } ?>
<tr>
<th colspan=2>SUM</th>
<th class="num"><?php echo number_format($SM,2);?></th>
<th class="num"><?php echo number_format($SMC,2);?></th>
</tr>
</tbody>
</table>
<h2>Detalles del mes actual (<?php echo date("M",strtotime("last week"));?>)</h2>
<table summary="Los detalles actuales">
<thead>
<tr>
<th>Gestor</th>
<th>Cliente</th>
<th>Campa&ntilde;a</th>
<th>Queue</th>
<th>Cuenta</th>
<th>Status</th>
<th>Fecha Pag&oacute;</th>
<th>Monto Pag&oacute;</th>
<th>Monto Confirmado</th>
<th>Titular</th>
</tr>
</thead>
<tbody>
<?php
$query="select gestor, pagos.cliente, status_de_credito, 
q(status_aarsa) as queue, cuenta, status_aarsa, fecha, monto, monto*confirmado,
nombre_deudor 
from pagos join resumen on cuenta=numero_de_cuenta 
and pagos.cliente=resumen.cliente 
where fecha>last_day(curdate()-interval 1 month-interval 1 week)
and fecha<last_day(curdate()-interval 1 week)
order by gestor,confirmado,fecha";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$GESTOR=$row[0];
$CLIENTE=$row[1];
$CAMP=$row[2];
$QUEUE=$row[3];
$CUENTA=$row[4];
$STATUS=$row[5];
$FECHA=$row[6];
$MONTO=number_format($row[7],2);
$MONTOC=number_format($row[8],2);
$NOMBRE=$row[9];
?>
<tr>
<td><?php echo $GESTOR;?></td>
<td><?php echo $CLIENTE;?></td>
<td><?php echo $CAMP;?></td>
<td><?php echo $QUEUE;?></td>
<td><?php echo $CUENTA;?></td>
<td><?php echo $STATUS;?></td>
<td><?php echo $FECHA;?></td>
<td class="num"><?php echo $MONTO;?></td>
<td class="num"><?php echo $MONTOC;?></td>
<td><?php echo $NOMBRE;?></td>
</tr>
<?php } ?>
</tbody>
</table>
<h2>Detalles del mes anterior (<?php echo date("M",strtotime("5 weeks ago"));?>)</h2>
<table summary="Los detalles anteriores">
<thead>
<tr>
<th>Gestor</th>
<th>Cliente</th>
<th>Campa&ntilde;a</th>
<th>Queue</th>
<th>Cuenta</th>
<th>Status</th>
<th>Fecha Pag&oacute;</th>
<th>Monto Pag&oacute;</th>
<th>Monto Confirmado</th>
<th>Titular</th>
</tr>
</thead>
<tbody>
<?php
$query="select gestor, pagos.cliente, status_de_credito, 
q(status_aarsa) as queue, cuenta, status_aarsa, fecha, monto, monto*confirmado,
nombre_deudor 
from pagos join resumen on cuenta=numero_de_cuenta 
and pagos.cliente=resumen.cliente 
where fecha between last_day(curdate()-interval 2 month-interval 1 week)+interval 1 day
and last_day(curdate()-interval 1 month-interval 1 week)
order by gestor,confirmado,fecha";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$GESTOR=$row[0];
$CLIENTE=$row[1];
$CAMP=$row[2];
$QUEUE=$row[3];
$CUENTA=$row[4];
$STATUS=$row[5];
$FECHA=$row[6];
$MONTO=number_format($row[7],2);
$MONTOC=number_format($row[8],2);
$NOMBRE=$row[9];
?>
<tr>
<td><?php echo $GESTOR;?></td>
<td><?php echo $CLIENTE;?></td>
<td><?php echo $CAMP;?></td>
<td><?php echo $QUEUE;?></td>
<td><?php echo $CUENTA;?></td>
<td><?php echo $STATUS;?></td>
<td><?php echo $FECHA;?></td>
<td class="num"><?php echo $MONTO;?></td>
<td class="num"><?php echo $MONTOC;?></td>
<td><?php echo $NOMBRE;?></td>
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
