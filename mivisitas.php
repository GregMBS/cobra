<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$capt=mysql_real_escape_string($_REQUEST['capt']);
$go=mysql_real_escape_string($_REQUEST['go']);
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$querycheck="SELECT count(1),tipo,iniciales FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."';";
$resultcheck=mysql_query($querycheck);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$mytipo=$answercheck[1];
$mynombre=$answercheck[2];
if ($mytipo=="admin") {$querymain = "SELECT numero_de_cuenta,nombre_deudor,saldo_total,campo_libre_1,ejecutivo_asignado_call_center,pagos_vencidos,campo_libre_1,saldo_descuento_1,producto,estado_deudor,ciudad_deudor,cliente,id_cuenta FROM resumen ORDER BY cliente,numero_de_cuenta";}
else {
$querymain = "SELECT numero_de_cuenta,nombre_deudor,saldo_total,campo_libre_1,ejecutivo_asignado_call_center,pagos_vencidos,campo_libre_1,saldo_descuento_1,producto,estado_deudor,ciudad_deudor,cliente,id_cuenta FROM resumen WHERE ejecutivo_asignado_domiciliario = '$mynombre' ORDER BY pagos_vencidos";
}
$result = mysql_query($querymain) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Cuentas Migo</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#ffffff;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;}
     tr:hover {background-color: #ff0000;}
       th {border: 1pt solid #000000;background-color: #c0c0c0;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
 </style>
</head>
<body>
<table summary="Cuentas">
<thead>
<tr>
<th>CUENTA</th>
<th>NOMBRE</th>
<th>CLIENTE</th>
<th>PAGOS VENCIDOS</th>
<th>SALDO TOTAL</th>
<th>MONTO PAGO</th>
<th>STATUS</th>
<th>FECHA PROM.</th>
<?php if ($mytipo=="admin") {?>
    <th>VISITADOR</th>
<?php }?>
<th>LOCAL / FORANEO</th>
</tr>
</thead>
<tbody>
<?php
$j=0;
while($row = mysql_fetch_row($result)) {
$j=$j+1;
$CUENTA=$row[0];
$CLIENTE=$row[11];
$ID_CUENTA=$row[12];
$NOMBRE=$row[1];
$GESTOR=$row[4];
$PV=$row[5];
$STATUS=$row[6];
$MONTODESC=$row[7];
$PRODUCTO=$row[8];
$CIUDAD=$row[10];
$MONTOTOTAL=$row[2];
$queryc="select count(1) from local where ciudad ='$CIUDAD'";
$resultc = mysql_query($queryc) or die(mysql_error());
while ($answerc=mysql_fetch_row($resultc)) {$localc=($answerc[0]==1);}
if ($localc) {$FORANEO='LOCAL';} else {$FORANEO='FORANEO';}
$D_PROM='';
$querysub="select C_CVST,D_PROM,N_PROM from historia where C_CONT='$ID_CUENTA'  order by D_FECH desc,C_HRIN desc";
$resultsub = mysql_query($querysub) or die(mysql_error());
if($rowsub = mysql_fetch_row($resultsub)){
if ($rowsub[2]>0) {$D_PROM=$rowsub[1];}
}
$MONTOPAG=0;
$querypag="select sum(MONTO) from pagos where C_CONT='$ID_CUENTA' ";
if($resultpag = mysql_query($querypag)){
$rowpag = mysql_fetch_row($resultpag);
$MONTOPAG=$rowpag[0];
}
?>
<tr>
<form class="migochange" name="gestorchange<?php echo $j ?>" method="get" action=
"<?php echo $_SERVER['PHP_SELF'] ?>" id="gestorchange<?php echo $j ?>">
<input type="hidden" name="capt" value="<?php echo $capt ?>"> 
<input type="hidden" name="id_cuenta" value="<?php echo $ID_CUENTA ?>"> 
<input type="hidden" name="j" value="<?php echo $j ?>"> 
<td><a href='resumen.php?go=FROMMIGO&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA;?>&capt=<?php echo $capt;?>'><?php echo $CUENTA;?></a></td>
<td><?php echo utf8_decode($NOMBRE);?></td>
<td><?php echo $PV;?></td>
<td><?php echo $CLIENTE;?></td>
<td class='num'><?php echo number_format($MONTOTOTAL,2);?></td>
<td class='num'><?php echo number_format($MONTOPAG,2);?></td>
<td><?php echo $STATUS;?></td>
<td><?php echo $D_PROM;?></td>
<?php if ($mytipo=="admin")  {?>
<select name="GESTOR">
<?php 
$query = "SELECT usuaria FROM nombres";
$result = mysql_query($query);
while ($answer = mysql_fetch_array($result)) {?>
  <option value="<?php if (isset($answer[0])) {echo $answer[0];}?>" style="font-size:120%;" <?php if ($answer[0]==$GESTOR) {echo "selected='selected'";}?>><?php if (isset($answer[0])) {echo $answer[0];}?></option>
<?php } ?>
</select>
<?php }?>
<td><?php echo $FORANEO;?></td>
<?php if ($mytipo=="admin")  {?>
<td><input type="submit" name="go" value="GUARDAR">
</td>
<?php }?>
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
