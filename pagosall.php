<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysqli_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysqli_query($con,"USE $db") or die ("Could not select $db database");
$ticket=mysqli_real_escape_string($con,$_COOKIE['auth']);
$capt=mysqli_real_escape_string($con,$_REQUEST['capt']);
$updown='';
	 set_time_limit(300);
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."' AND tipo='admin';";
$resultcheck=mysqli_query($con,$querycheck);
while ($answercheck=mysqli_fetch_row($resultcheck)) {
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
       table {border: 1pt solid #000000;background-color: #c0c0c0;}
     tr:hover {background-color: #ff0000;}
       th {border: 1pt solid #000000;background-color: #c0c0c0;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
 </style>

</head>
<body>
<table summary="Por cliente">
<thead>
<tr>
<th>Cuenta</th>
<th>Fecha</th>
<th>Monto Pago</th>
<th>Cliente</th>
</tr>
</thead>
<tbody>
<?php
$query="select cuenta,fecha,monto,cliente from pagos order by cliente,fecha";
$result=mysqli_query($con,$query) or die(mysqli_error());
while($row = mysqli_fetch_row($result)) {
$CUENTA=$row[0];
$FECHA=$row[1];
$MONTO=number_format($row[2],2);
$CLIENTE=$row[3];
?>
<tr>
<td><?php echo $CUENTA;?></td>
<td><?php echo $FECHA;?></td>
<td class="num"><?php echo $MONTO;?></td>
<td><?php echo $CLIENTE;?></td>
</tr>
<?php } ?>
</tbody>
</table>
<table summary="Por dia">
<thead>
<tr>
<th>Cuenta</th>
<th>Fecha</th>
<th>Monto Pago</th>
</tr>
</thead>
<tbody>
<?php
$query="select cuenta,fecha,monto,cliente from pagos order by fecha";
$result=mysqli_query($con,$query) or die(mysqli_error());
while($row = mysqli_fetch_row($result)) {
$CUENTA=$row[0];
$FECHA=$row[1];
$MONTO=number_format($row[2],2);
?>
<tr>
<td><?php echo $CUENTA;?></td>
<td><?php echo $FECHA;?></td>
<td class="num"><?php echo $MONTO;?></td>
</tr>
<?php } ?>
</tbody>
</table>
<?php   
}
}
mysqli_close($con);
?>
</body>
</html> 
