<?php
$host = "localhost";
$user = "root";
$pwd = "DeathSta1";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_REQUEST['capt']);
set_time_limit(300);
$querycheck="SELECT count(1),max(tipo) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."';";
$resultcheck=mysql_query($querycheck) or die("ERROR UM1 - ".mysql_error());
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {
        $redirector = "Location: index.php";
        header($redirector);
}
else {
$mytipo=$answercheck[1];
$field=mysql_real_escape_string ($_REQUEST['field']);
$find=mysql_real_escape_string ($_REQUEST['find']);
$from=mysql_real_escape_string ($_REQUEST['from']);
if (isset($_GET['C_CONT'])) {
	$C_CONT=mysql_real_escape_string ($_GET['C_CONT']);
} else {
	$C_CONT=0;
}
$CLIENTE=mysql_real_escape_string ($_REQUEST['cliente']);
$querymain = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito from resumen where ".$field." like '%".$find."%'";
if ($field=='id_cuenta')  {$querymain = "SELECT numero_de_cuenta,nombre_deudor,
cliente,id_cuenta from resumen where id_cuenta = ".$find." order by id_cuenta;";}
if ($field=='numero_de_cuenta')  {$querymain = "SELECT numero_de_cuenta,
nombre_deudor,cliente,id_cuenta,status_de_credito from resumen 
where numero_de_cuenta regexp '".$find."' ";}
if ($field=='producto')  {$querymain = "SELECT numero_de_cuenta,
nombre_deudor,cliente,id_cuenta,status_de_credito from resumen 
where producto regexp '".$find."' ";}
if ($field=='subproducto')  {$querymain = "SELECT numero_de_cuenta,
nombre_deudor,cliente,id_cuenta,status_de_credito from resumen 
where subproducto regexp '".$find."' ";}
if ($field=='REFS')  {
    $querymain = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,
    id_cuenta,status_de_credito 
    FROM resumen WHERE 
(nombre_deudor_alterno regexp '".$find."' or 
nombre_referencia_1 like '%".$find."%' or 
nombre_referencia_2 like '%".$find."%' or 
nombre_referencia_3 like '%".$find."%' or 
nombre_referencia_4 like '%".$find."%')";    
    }
if ($field=='ROBOT')  {
    $querymain = "SELECT SQL_NO_CACHE distinct numero_de_cuenta,nombre_deudor,
    cliente,id_cuenta,status_de_credito 
FROM resumen, historia use index (tel) 
WHERE c_tele LIKE '%".$find."' and c_cont=id_cuenta
";    
    }
if ($field=='EXACTO')  {
    $querymain = "SELECT SQL_NO_CACHE distinct numero_de_cuenta,nombre_deudor,
    cliente,id_cuenta,status_de_credito
FROM resumen
WHERE numero_de_cuenta= '".$find."' order by numero_de_cuenta";
    }
if ($field=='TELS')  {
    $querymain = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,
    id_cuenta,status_de_credito FROM resumen WHERE 
(tel_1 like '%".$find."' or 
tel_2 like '%".$find."' or 
tel_3 like '%".$find."' or 
tel_4 like '%".$find."' or 
tel_1_alterno like '%".$find."' or 
tel_2_alterno like '%".$find."' or 
tel_3_alterno like '%".$find."' or 
tel_4_alterno like '%".$find."' or 
tel_1_ref_1 like '%".$find."' or 
tel_2_ref_1 like '%".$find."' or 
tel_1_ref_2 like '%".$find."' or 
tel_2_ref_2 like '%".$find."' or 
tel_1_ref_3 like '%".$find."' or 
tel_2_ref_3 like '%".$find."' or 
tel_1_ref_4 like '%".$find."' or 
tel_2_ref_4 like '%".$find."' or 
tel_1_laboral like '%".$find."' or 
tel_2_laboral like '%".$find."' or 
tel_1_verif like '%".$find."' or 
tel_2_verif like '%".$find."' or 
tel_3_verif like '%".$find."' or 
tel_4_verif like '%".$find."' or 
telefonos_marcados like '%".$find."')";    
    }
if (strlen($CLIENTE)>1) {$querymain=$querymain." and cliente='".$CLIENTE."'";}
if ($mytipo!='admin'&&$mytipo!='supervisor') {
        $querymain=$querymain.";";}
$result = mysql_query($querymain) or die("ERROR UM2 - ".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>COBRA - Buscar</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #ffffff; color:#000000;}
       table {border: 1pt solid #000000;background-color: #ffffff;}
     tr:hover {background-color: #ff0000;}
       th {border: 1pt solid #000000;background-color: #ffffff;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
 </style>

</head>
<body>
<h1>BUSCAR</h1>
<button onClick="window.location='<?php echo $from;?>?go=FROMBUSCAR&i=0&field=id_cuenta&find=<?php echo $C_CONT;?>&capt=<?php echo $capt;?>'">Regresar al resumen</button>
<table summary="Cuentas">
<thead>
<tr>
<th>CUENTA</th>
<th>NOMBRE</th>
<th>CLIENTE</th>
<th>CAMPAÑA</th>
</tr>
</thead>
<tbody>
<?php
$j=0;
while($row = mysql_fetch_row($result)) {
$j=$j+1;
$CUENTA=$row[0];
$NOMBRE=utf8_decode($row[1]);
$CLIENTE=$row[2];
$ID_CUENTA=$row[3];
$STATUS=$row[4];
?>
<tr>
<td><a<?php if ((preg_match('/ivo/', $STATUS))||(preg_match('/alo/', $STATUS))) { ?> style="color:#c0c0c0;"<?php } ?> href='<?php echo $from;?>?go=FROMBUSCAR&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA;?>&capt=<?php echo $capt;?>&highlight=<?php echo $field?>&hfind=<?php echo $find?>'><?php echo $CUENTA;?></a></td>
<td><?php echo utf8_decode($NOMBRE);?></td>
<td><?php echo $CLIENTE;?></td>
<td><?php echo $STATUS;?></td>
</tr>
<?php } ?>
</tbody>
</table>
<div id="searchbox">
<h2>Buscar</h2>
<form name="search" method="get" action=
"buscar.php" id="search">Buscar a: <input type=
"text" name="find"> en <select name="field">
<option value="numero_de_cuenta">Cuenta</option>
<option value="numero_de_credito"># del Grupo</option>
<option value="nombre_deudor">Nombre</option>
<option value="domicilio_deudor">Direcci&oacute;n</option>
<option value="EXACTO">Cuenta Exacta</option>
<option value="TELS">Telefonos</option>
<option value="ROBOT">Telefonos marcados</option>
<option value="REFS">Aval/Referencias</option>
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
