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
$querycheck="SELECT count(1),max(tipo) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."';";
$resultcheck=mysql_query($querycheck) or die("ERROR PRM1 - ".mysql_error());
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$tipo=$answercheck[1];
if (empty($_REQUEST['page'])||($_REQUEST['page']+0==0)) {$page=0;} else {$page=mysql_real_escape_string($_REQUEST['page']);}
$tcapt=$capt;
if (substr($capt,0,8)=="practica") {$tcapt="practica";}
$updown='';
	 set_time_limit(300);
$go='';
$reorden='';
if (!empty($_REQUEST['reorden'])) {$reorden=mysql_real_escape_string($_REQUEST['reorden']);}
if (!empty($_REQUEST['dprom'])) {$d_prom=mysql_real_escape_string($_REQUEST['dprom']);}
if (!empty($_REQUEST['go'])) {$go=mysql_real_escape_string($_REQUEST['go']);} else {$reorden='';}
if ($go=='CUENTAS') {
        $go='';
}
$gestorstr=" and (ejecutivo_asignado_call_center='".$tcapt."' or c_cvge='".$tcapt."') ";
if ($tipo=='admin') {$gestorstr="";}
if (!empty($d_prom)) {$gestorstr=$gestorstr." and d_prom='".$d_prom."'  ";}
$count=0;
$nextpage=min(0,$count);
$prevpage=max(0,$count);
$querymain = "select resumen.cliente,numero_de_cuenta,nombre_deudor,saldo_total,
status_de_credito,c_cvge,
status_aarsa,n_prom1,d_prom1,n_prom2,d_prom2,
resumen.id_cuenta,datediff(curdate(),d_prom) as semaforo,d_fech,sum(monto) as sum_monto,
n_prom3,d_prom3,n_prom4,d_prom4
from resumen
join dictamenes on dictamen=status_aarsa
join historia h1 on id_cuenta=c_cont
left join pagos on pagos.id_cuenta=c_cont and fecha>=d_fech
where n_prom>0 and queue in ('CLIENTE NEGOCIANDO','PROMESAS','PAGOS','PAGANDO CONVENIO', 'PROMESAS INCUMPLIDAS')
and status_de_credito not regexp 'inactivo$'
and d_prom>last_day(curdate()-interval 1 month)
and d_fech>last_day(curdate()-interval 2 month)
and not exists (select * from historia h2 where h1.c_cont=h2.c_cont 
and n_prom>0 and concat(h2.d_fech,h2.c_hrfi)>concat(h1.d_fech,h1.c_hrfi))
".$gestorstr."
group by c_cvge,cliente,status_de_credito,numero_de_cuenta
order by c_cvge,sum(monto),d_prom
";
$result = mysql_query($querymain) or die("ERROR PRM3 - ".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Promesas</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #ffffff; color:#000000;}
       table {border: 1pt solid #000000;background-color: #ffffff;table-layout:fixed;}
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
<th>GESTOR</th>
<th>SALDO TOTAL</th>
<th>RESULTADOS</th>
<th>FECHA PROMESA 1</th>
<th>MONTO PROMESA 1</th>
<th>FECHA PROMESA 2</th>
<th>MONTO PROMESA 2</th>
<th>FECHA PROMESA 3</th>
<th>MONTO PROMESA 3</th>
<th>FECHA PROMESA 4</th>
<th>MONTO PROMESA 4</th>
<th>MONTO PAGO</th>
<th>SEMAFORO</th>
</tr>
</thead>
<tbody>
<?php
$j=0;
$oldc=0;
$spr=0;
$spa=0;
while($row = mysql_fetch_array($result)) {
$j=$j+1;
$CUENTA=$row['numero_de_cuenta'];
$CLIENTE=$row['cliente'];
$GESTOR=$row['c_cvge'];
$ID_CUENTA=$row['id_cuenta'];
$STATUS_AARSA=$row['status_aarsa'];
$FECHA_PROMESA1=$row['d_prom1'];
$MONTO_PROMESA1=$row['n_prom1'];
$FECHA_PROMESA2=$row['d_prom2'];
$MONTO_PROMESA2=$row['n_prom2'];
$FECHA_PROMESA3=$row['d_prom3'];
$MONTO_PROMESA3=$row['n_prom3'];
$FECHA_PROMESA4=$row['d_prom4'];
$MONTO_PROMESA4=$row['n_prom4'];
$spr=$spr+$MONTO_PROMESA1+$MONTO_PROMESA2+$MONTO_PROMESA3+$MONTO_PROMESA4;
$MONTO_PAGO=$row['sum_monto'];
$spa=$spa+$MONTO_PAGO;
$NOMBRE=$row['nombre_deudor'];
$STATUS_DE_CREDITO=$row['status_de_credito'];
$MONTOTOTAL=$row['saldo_total'];
$VENC=$row['semaforo'];
$color='white';
$semtext='';
if ($VENC>0) {$color='red';$semtext='VENCIDO';}
if ($VENC<=0) {$color='blue';$semtext='VIGENTE';}
if ($MONTO_PAGO>10) {$color='green';$semtext='PAGO';}
if ($oldc!=$ID_CUENTA) {
$oldc=$ID_CUENTA;
?>
<tr>
<td><a href='resumen.php?go=FROMMIGO&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA;?>&capt=<?php echo $capt;?>'><?php echo $CUENTA;?></a></td>
<td><?php echo htmlentities($NOMBRE);?></td>
<td><?php echo $CLIENTE;?></td>
<td><?php echo $STATUS_DE_CREDITO;?></td>
<td><?php echo $GESTOR;?></td>
<td class='num'><?php echo number_format($MONTOTOTAL,0);?></td>
<td><?php echo $STATUS_AARSA;?></td>
<td><?php echo $FECHA_PROMESA1;?></td>
<td class='num'><?php echo number_format($MONTO_PROMESA1,0);?></td>
<td><?php echo $FECHA_PROMESA2;?></td>
<td class='num'><?php echo number_format($MONTO_PROMESA2,0);?></td>
<td><?php echo $FECHA_PROMESA3;?></td>
<td class='num'><?php echo number_format($MONTO_PROMESA3,0);?></td>
<td><?php echo $FECHA_PROMESA4;?></td>
<td class='num'><?php echo number_format($MONTO_PROMESA4,0);?></td>
<td class='num'><?php echo number_format($MONTO_PAGO,0);?></td>
<td style='background-color:<?php echo $color;?>'><?php echo $semtext;?></td>
</tr>
<?php 
$count++;
}
} 
$nextpage=min(0,$count);
$prevpage=max(0,$count);
?>
<tr>
<td colspan=10>&nbsp;</td>
<td class='num'><b><?php echo number_format($spr,0);?></b></td>
<td class='num'><b><?php echo number_format($spa,0);?></b></td>
</tr>
</tbody>
</table>
<div>
<form class="buttons" name="prev" method="get" action=
"<?php echo $_SERVER['PHP_SELF']; ?>" id="prev"><input type="hidden"
name="updown" value="<?php echo $updown ?>"> <input type="hidden"
name="cliente" value="<?php echo $CLIENTE ?>"> <input type="hidden"
name="capt" value="<?php echo $capt ?>"> <input type="hidden"
name="reorden" value="<?php echo $reorden ?>"> <input type="hidden"
name="page" value="<?php echo $prevpage ?>"> <input type="hidden"
name="go" value="<?php echo $go ?>"><input type="submit"
name="from" value="ANTE"></form>
<form class="buttons" name="next" method="get" action=
"<?php echo $_SERVER['PHP_SELF']; ?>" id="next"><input type="hidden"
name="updown" value="<?php echo $updown ?>"> <input type="hidden"
name="cliente" value="<?php echo $CLIENTE ?>"> <input type="hidden"
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
$resultcl = mysql_query($querycl) or die("ERROR PRM4 - ".mysql_error());
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
?>
</body>
</html>
<?php
}

