<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra4";
$uri = rtrim(dirname($_SERVER['PHP_SELF']) , '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die("Could not connect to MySQL");
mysql_query("USE $db") or die("Could not select $db database");
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt = mysql_real_escape_string($_GET['capt']);
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."' AND tipo='admin';";
$resultcheck=mysql_query($querycheck);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
    $querymain="select numero_de_cuenta,cliente,status_de_credito,saldo_total, 
    saldo_vencido,saldo_descuento_1,saldo_descuento_2,ejecutivo_asignado_call_center 
    from resumen where status_de_credito<>'Inactivo' 
    order by cliente,status_de_credito,numero_de_cuenta";
    $result = mysql_query($querymain) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Reporte de las asignaciones</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#000000;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;}
     tr:hover {background-color: #ff0000;}
       th {border: 1pt solid #000000;background-color: #c0c0c0;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
 </style>
</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<table summary="Gestores">
<thead>
<tr>
<th>Cuenta</a></th>
<th>Cliente</a></th>
<th>Status de Credito</a></th>
<th>Saldo Total</a></th>
<th>Saldo Vencido</a></th>
<th>Saldo Descuento 1</a></th>
<th>Saldo Descuento 2</a></th>
<th>Gestor</a></th>
</tr>
</thead>
<tbody>
<?php
    while ($row = mysql_fetch_row($result)) 
    {
        $cuenta = $row[0];
        $cliente = $row[1];
        $status = $row[2];
        $st = $row[3];
        $sv = $row[4];
        $sd1 = $row[5];
        $sd2 = $row[6];
        $gestor = $row[7];
?>
<tr>
<td><?php echo $cuenta; ?></td>
<td><?php echo $cliente; ?></td>
<td><?php echo $status; ?></td>
<td>$<?php echo number_format($st,0); ?></td>
<td>$<?php echo number_format($sv,0); ?></td>
<td>$<?php echo number_format($sd1,0); ?></td>
<td>$<?php echo number_format($sd2,0); ?></td>
<td><?php echo $gestor; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</body>
</html> 
<?php
}
}
mysql_close($con);
?>
