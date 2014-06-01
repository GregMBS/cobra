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
<title>Reporte de los queues</title>

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
<table summary="Queues por gestor">
<thead>
<tr>
<th>Gestor</th>
<th>Cliente</th>
<th>Campa&ntilde;a</th>
<th>Queue</th>
<th>Menos Recien</th>
<th>Mas Recien</th>
<th>Cuentas</th>
</tr>
</thead>
<tbody>
<?php
$OG='';
$query="select ejecutivo_asignado_call_center as 'gestor',status_de_credito,queue,
date(min(fecha_ultima_gestion)) as 'menos recien',
date(max(fecha_ultima_gestion)) as 'mas recien',count(1) as 'cuentas', 
cliente
from resumen
join dictamenes on dictamen=status_aarsa
where (fecha_de_actualizacion>last_day(curdate()-interval 1 month-interval 1 week) 
or fecha_ultima_gestion>last_day(curdate()-interval 1 month-interval 1 week))
and status_de_credito not regexp '[dv]o$'
group by ejecutivo_asignado_call_center,cliente,status_de_credito,queue";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$GESTOR=$row[0];
$SDC=$row[1];
$QUEUE=$row[2];
$CUENTAS=$row[3];
$MENOS=$row[4];
$MAS=$row[5];
$CLIENTE=$row[6];
if ($OG<>$GESTOR) {
$OG=$GESTOR;
?>
<tr>
<td colspan=5>&nbsp;</td>
</tr>
<?php
}
?>
<tr>
<td><?php echo $GESTOR;?></td>
<td><?php echo $CLIENTE;?></td>
<td><?php echo $SDC;?></td>
<td><?php echo $QUEUE;?></td>
<td class="num"><?php echo $CUENTAS;?></td>
<td><?php echo $MENOS;?></td>
<td><?php echo $MAS;?></td>
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
