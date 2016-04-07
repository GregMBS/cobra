<?php
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
$querymain = "select d_fech,c_visit,d_prom,n_prom,fecha,monto,monto/n_prom*100 as effectividad,c_cvba from historia left join pagos on historia.cuenta=pagos.cuenta and c_cvba=cliente where c_cvst regexp 'promesa de' and c_visit is not null order by c_cvba,d_fech,c_visit,d_prom,fecha";
$result = mysql_query($querymain) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Efectividad de Visitadores</title>

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
<th>Fecha Gestion</th>
<th>Visitador</th>
<th>Fecha Promesa</th>
<th>Monto Promesa</th>
<th>Fecha Pag&oacute;</th>
<th>Monto Pag&oacute;</th>
<th>EFECTIVIDAD</th>
</tr>
</thead>
<tbody>
<?php
$OLDCLIENTE='';
while($row = mysql_fetch_row($result)) {
$D_FECH=$row[0];
$VISITADOR=$row[1];
$D_PROM=$row[2];
$N_PROM=number_format($row[3],2);
$FECHA=$row[4];
$MONTO=$row[5];
$EFECT=number_format($row[6],0);
$CLIENTE=$row[7];
if ($CLIENTE!=$OLDCLIENTE) {
$OLDCLIENTE=$CLIENTE;
echo "<tr><th>".$CLIENTE."</th></tr>";
} else {
?>
<tr>
<td><?php echo $D_FECH;?></td>
<td><?php echo $VISITADOR;?></td>
<td><?php echo $D_PROM;?></td>
<td class="num"><?php echo $N_PROM;?></td>
<td><?php echo $FECHA;?></td>
<td><?php echo $MONTO;?></td>
<td><?php echo $EFECT;?>%</td>
</tr>
<?php }} ?>
</tbody>
</table>
<?php   
}
}
mysql_close($con);
?>
</body>
</html> 
