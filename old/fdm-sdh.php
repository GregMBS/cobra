<?php
$host = "localhost";
$user = "root";
$pwd = "DeathSta1";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_GET['capt']);
$querycheck="SELECT count(1),max(tipo) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."';";
$resultcheck=mysql_query($querycheck);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$tipo=$answercheck[1];
if (empty($_GET['page'])||($_GET['page']+0==0)) {$page=0;} else {$page=mysql_real_escape_string($_GET['page']);}
$tcapt=$capt;
if (substr($capt,0,8)=="practica") {$tcapt="practica";}
$updown='';
	 set_time_limit(300);
$go='';
$reorden='';
if (!empty($_GET['reorden'])) {$reorden=mysql_real_escape_string($_GET['reorden']);}
if (!empty($_GET['dprom'])) {$d_prom=mysql_real_escape_string($_GET['dprom']);}
if (!empty($_GET['go'])) {$go=mysql_real_escape_string($_GET['go']);} else {$reorden='';}
if ($go=='CUENTAS') {
        $go='';
}
$gestorstr="";
if (!empty($d_prom)) {$gestorstr=$gestorstr." and d_prom='".$d_prom."'  ";}
$queryupd="update historia, resumen set status_aarsa=c_cvst where id_cuenta=c_cont
and auto in (select max(auto) from historia group by c_cont)";
//mysql_query($queryupd) or die(mysql_error());
$count=0;
$nextpage=min(0,$count);
$prevpage=max(0,$count);
$querymain = "select r.cliente,r.numero_de_cuenta,nombre_deudor,
status_de_credito,ejecutivo_asignado_call_center,
status_aarsa,c_cvst,d_fech,r.id_cuenta,datediff(curdate(),d_prom),c_cvge,
(n_prom<=sum(monto))*(fecha>=last_day(curdate()-interval 5 week)) 
from resumen r
join historia h on c_cont=id_cuenta
join fdmsdh f using (numero_de_cuenta,cliente)
left join pagos using (cuenta,cliente)
where n_prom>0
and status_de_credito not like '%o'
group by ejecutivo_asignado_call_center,cliente,status_de_credito,cuenta,d_fech desc,c_hrin desc
";
$result = mysql_query($querymain) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Fin del mes Surtidor del Hogar</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#000000;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;table-layout:fixed;}
     tr:hover {background-color: #ff0000;}
       th {border: 1pt solid #000000;background-color: #c0c0c0;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
	div,p {clear:both}
	#next,#prev {float:left;clear:none;}
	#paging {font-weight:bold; font-size:110%}
 </style>

</head>
<body>
<table summary="Cuentas">
<thead>
<tr>
<th>CUENTA</th>
<th>NOMBRE</th>
<th>CLIENTE</th>
<th>CAMPA&Ntilde;A</th>
<th>ASIGNADO</th>
<th>STATUS TOTAL</th>
<th>GESTOR</th>
<th>STATUS ULTIMO</th>
<th>FECHA ULT.GESTION</th>
<th>SEMAFORO</th>
</tr>
</thead>
<tbody>
<?php
$j=0;
$oldc=0;
while($row = mysql_fetch_row($result)) {
$j=$j+1;
$CLIENTE=$row[0];
$CUENTA=$row[1];
$NOMBRE=$row[2];
$STATUS_DE_CREDITO=$row[3];
$GESTOR=$row[4];
$STATUS_AARSA=$row[5];
$STATUS_ULT=$row[6];
$D_FECH=$row[7];
$ID_CUENTA=$row[8];
$GULT=$row[10];
$PAID=$row[11];
$VENC=$row[9];
if ($VENC>0) {$color='red';}
if ($VENC==0) {$color='yellow';}
if ($VENC<0) {$color='blue';}
if ($PAID>0) {$color='green';}
if ($oldc!=$ID_CUENTA) {
$oldc=$ID_CUENTA;
?>
<tr>
<td><a href='resumen.php?go=FROMMIGO&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA;?>&capt=<?php echo $capt;?>'><?php echo $CUENTA;?></a></td>
<td><?php echo htmlentities($NOMBRE);?></td>
<td><?php echo $CLIENTE;?></td>
<td><?php echo $STATUS_DE_CREDITO;?></td>
<td><?php echo $GESTOR;?></td>
<td><?php echo $STATUS_AARSA;?></td>
<td><?php echo $GULT;?></td>
<td><?php echo $STATUS_ULT;?></td>
<td><?php echo $D_FECH;?></td>
<td style='background-color:<?php echo $color;?>'>&nbsp;</td>
</tr>
<?php 
$count++;
}
} 
$nextpage=min(0,$count);
$prevpage=max(0,$count);
?>
</tbody>
</table>
<div>
<form class="buttons" name="prev" method="get" action=
"<?php echo $_SERVER['PHP_SELF']; ?>" id="prev"><input type="hidden"
name="updown" value="<?php echo $updown ?>"> <input type="hidden"
name="cliente" value="<?php echo $cliente ?>"> <input type="hidden"
name="capt" value="<?php echo $capt ?>"> <input type="hidden"
name="reorden" value="<?php echo $reorden ?>"> <input type="hidden"
name="page" value="<?php echo $prevpage ?>"> <input type="hidden"
name="go" value="<?php echo $go ?>"><input type="submit"
name="from" value="ANTE"></form>
<form class="buttons" name="next" method="get" action=
"<?php echo $_SERVER['PHP_SELF']; ?>" id="next"><input type="hidden"
name="updown" value="<?php echo $updown ?>"> <input type="hidden"
name="cliente" value="<?php echo $cliente ?>"> <input type="hidden"
name="capt" value="<?php echo $capt ?>"> <input type="hidden"
name="reorden" value="<?php echo $reorden ?>"> <input type="hidden"
name="page" value="<?php echo $nextpage ?>"> <input type="hidden"
name="go" value="<?php echo $go ?>"><input type="submit"
name="from" value="SEG"></form>
</div>
<p id='paging'>
Resultados <?php echo '1' ?> a <?php echo $count ?> de <?php echo $count ?>
</p>
<div id="searchbox">
<h2>Buscar</h2>
<form name="search" method="get" action=
"buscar.php" id="search">Buscar a: <input type=
"text" name="find"> en <select name="field">
<option value="nombre_deudor">Nombre</option>
<option value="numero_de_cuenta">Cuenta</option>
<option value="TELS">Telefonos</option>
<option value="REFS">Referencias</option>
<option value="id_cuenta">Expediente</option>
</select><br>
Client = <select name="cliente">
<option value=" ">Todos</option>
<?php 
$querycl = "SELECT cliente FROM clientes;";
$resultcl = mysql_query($querycl);
while ($answercl = mysql_fetch_array($resultcl)) {?>
<option value="<?php echo $answercl[0];?>"><?php echo $answercl[0];?>
</option>
<?php  } ?>
</select><br>
<input type="hidden" name="i" value="0">
<input type="hidden" name="capt" value="<?php if (isset($capt)) {echo $capt;} ?>">
<input type="hidden" name="go" value="BUSCAR">
<input type="hidden" name="from" value="resumen.php">
<input type="submit" name="go1" value="BUSCAR">
<input type="button" name="cancel" onclick="cancelbox('searchbox')"
value="Cancel"> 
</form>
</div>
<?php
}   
}
mysql_close($con);
?>
</body>
</html> 
