<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$attack=(!empty($_REQUEST['auto']))||(!empty($_REQUEST['auto']));
if ($attack) {die('ATTACK!');}
if (empty($_REQUEST['capt']))
{
$redirector = "Location: index.php";
header($redirector);
}
$capt=mysql_real_escape_string($_REQUEST['capt']);
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$queryck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."';";
$resultck=mysql_query($queryck);
while ($answerck=mysql_fetch_row($resultck)) {
if ($answerck[0]!=1) {}
else {
$vst=mysql_real_escape_string($_REQUEST['visitador']);
$queryn="SELECT completo FROM nombres 
where iniciales='".$vst."'
limit 1;";
$resultn=mysql_query($queryn) or die(mysql_error());
while ($answern=mysql_fetch_row($resultn)) {$visitador=$answern[0];}
$querymain="SELECT cuenta,saldo_total,cliente,q(status_aarsa),nombre_deudor 
FROM vasign,resumen 
where (c_cont=id_cuenta)
and fechaout>curdate()
and gestor='".$vst."'
order by cuenta+0
;";
$result=mysql_query($querymain) or die(mysql_error());
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>COBRA Visitador Checklist</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type='text/css'>
	body {font-family: verdana,arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0;color:#000000;}
	span.formcap {display: block; width: 12em; float: left;}
	th {width: 12em;}
	td {border: 1pt solid #c0c0c0;background-color: #ffffff; width:12em;color:black;}
	#tableContainer {height: 3cm; overflow: scroll;}
 </style>
</head>
<body>
<div id="vtable">
<p>Visitador: <?php echo $visitador;?><br>
Autorizó por: <?php echo $capt;?></p>
Fecha: <?php echo date('d/m/Y');?></p>
<table>
<tr>
<th>CUENTA</th>
<th>SALDO TOTAL</th>
<th>CLIENTE</th>
<th>QUEUE</th>
<th>NOMBRE</th>
</tr>
<?php
$sc=0;
$SM=0;
while ($answer=mysql_fetch_row($result)) {
$CUENTA=$answer[0];
$ST=$answer[1];
$CLIENTE=$answer[2];
$QUEUE=$answer[3];
$NOMBRE=$answer[4];
$sc=$sc+1;
$sm=$sm+$ST;
?>
<tr>
<td><?php echo $CUENTA; ?></td>
<td><?php echo number_format($ST,0); ?></td>
<td><?php echo $CLIENTE; ?></td>
<td><?php echo $QUEUE; ?></td>
<td><?php echo $NOMBRE; ?></td>
</tr>
<?php } ?>
<tr>
<td><?php echo $sc; ?> cuentas</td>
<td><?php echo number_format($sm,0); ?></td>
<td colspan=3>&nbsp;</td>
</tr>
</table>
</div>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<?php  
} 
mysql_close($con);
?>
</body>
</html> 
