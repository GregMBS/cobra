<?php
$host = "localhost";
$user = "root";
$pwd = "DeathSta1";
$db = "cobrajdlr";
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
$querymain = "select c_cvba,c_cvge,cuenta,c_cvst,(c_visit is null) as cc,(c_visit is null and (c_carg <>'')) as ccc, (c_visit is not null) as vi, (c_visit is not null and c_carg <>'') as vic, n_prom,c_visit from historia where n_prom>0 or cuenta in (select cuenta from pagos) order by c_cvba,cuenta+0,d_fech";
$result = mysql_query($querymain) or die(mysql_error());?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Efectividad de Modas</title>

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
<table summary="Efectividad">
<thead>
<tr>
<th>Cliente</th>
<th>Gestor</th>
<th>Cuenta</th>
<th>Resultado</th>
<th>Ges4374tion Tel&eacute;fonica</th>
<th>Contacto Tel&eacute;fonica</th>
<th>Vista Intentado</th>
<th>Contacto por Visit</th>
<th>Monto Promesa</th>
<th>Monto Pag&oacute;</th>
<th>EFECTIVIDAD</th>
</tr>
</thead>
<tbody>
<?php
$oldcuenta=0;
while($row = mysql_fetch_row($result)) {
$CLIENTE=$row[0];
$GESTOR=$row[1];
if ($row[6]==1) {$GESTOR=$row[9];};
$CUENTA=$row[2];
$RESULTADO=$row[3];
if ($row[4]==1) {$GT='Si';} else {$GT='No';};
if ($row[5]==1) {$CT='Si';} else {$CT='No';};
if ($row[6]==1) {$VI='Si';} else {$VI='No';};
if ($row[7]==1) {$CV='Si';} else {$CV='No';};
$MONTOPAG=0;
$querypag="select sum(monto) from pagos where cliente='".$CLIENTE."' and cuenta='".$CUENTA."';";
$resultpag=mysql_query($querypag) or die(mysql_error());
while ($answerpag=mysql_fetch_row($resultpag)) {$MONTOPAG=$answerpag[0];}
$MONTOPROM=$row[8];
$EFECT='';
if ($MONTOPROM>0) {
$EFECT=number_format($MONTOPAG/($MONTOPROM)*100,0)."%";
}
?>
<tr>
<td<?php if ($CUENTA!=$oldcuenta) {echo " style='border-top:black solid 1pt'";}?>><?php echo $CLIENTE;?></td>
<td<?php if ($CUENTA!=$oldcuenta) {echo " style='border-top:black solid 1pt'";}?>><?php echo $CUENTA;?></td>
<td<?php if ($CUENTA!=$oldcuenta) {echo " style='border-top:black solid 1pt'";}?>><?php echo $GESTOR;?></td>
<td<?php if ($CUENTA!=$oldcuenta) {echo " style='border-top:black solid 1pt'";}?>><?php echo $RESULTADO;?></td>
<td<?php if ($CUENTA!=$oldcuenta) {echo " style='border-top:black solid 1pt'";}?>><?php echo $GT;?></td>
<td<?php if ($CUENTA!=$oldcuenta) {echo " style='border-top:black solid 1pt'";}?>><?php echo $CT;?></td>
<td<?php if ($CUENTA!=$oldcuenta) {echo " style='border-top:black solid 1pt'";}?>><?php echo $VI;?></td>
<td<?php if ($CUENTA!=$oldcuenta) {echo " style='border-top:black solid 1pt'";}?>><?php echo $CV;?></td>
<td<?php if ($CUENTA!=$oldcuenta) {echo " style='border-top:black solid 1pt'";}?>><?php echo $MONTOPROM;?></td>
<td<?php if ($CUENTA!=$oldcuenta) {echo " style='border-top:black solid 1pt'";}?>><?php echo $MONTOPAG;?></td>
<td<?php if ($CUENTA!=$oldcuenta) {echo " style='border-top:black solid 1pt'";}?>><?php echo $EFECT;?></td>
</tr>
<?php 
$oldcuenta=$CUENTA;
} ?>
</tbody>
</table>
<?php   
}
}
mysql_close($con);
?>
</body>
</html> 
