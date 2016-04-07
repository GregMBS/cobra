<?php
$host = "localhost";
$user = "root";
$pwd = "eLaStIx.2oo7";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_GET['capt']);
set_time_limit(300);
$querycheck="SELECT count(1),max(tipo) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."';";
$resultcheck=mysql_query($querycheck) or die(mysql_error());
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {
        $redirector = "Location: index.php";
        header($redirector);
}
else {
$mytipo=$answercheck[1];
$field=mysql_real_escape_string ($_GET['field']);
$find=mysql_real_escape_string ($_GET['find']);
$from=mysql_real_escape_string ($_GET['from']);
$C_CONT=mysql_real_escape_string ($_GET['C_CONT']);
$CLIENTE=mysql_real_escape_string ($_GET['cliente']);
$querymain = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,id_cuenta,status_de_credito from resumen where ".$field." regexp '".$find."'";
if ($field=='id_cuenta')  {$querymain = "SELECT numero_de_cuenta,nombre_deudor,cliente,id_cuenta from resumen where id_cuenta = ".$find;}
if ($field=='REFS')  {
    $querymain = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,id_cuenta,status_de_credito FROM resumen WHERE 
(nombre_deudor_alterno regexp '".$find."' or 
nombre_referencia_1 regexp '".$find."' or 
nombre_referencia_2 regexp '".$find."' or 
nombre_referencia_3 regexp '".$find."' or 
nombre_referencia_4 regexp '".$find."')";    
    }
if ($field=='ROBOT')  {
    $querymain = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,id_cuenta,status_de_credito FROM resumen WHERE 
id_cuenta in (SELECT c_cont FROM historia WHERE c_tele REGEXP '".$find."') OR 
numero_de_cuenta in (SELECT id FROM robot.calllog WHERE tel REGEXP '".$find."')";    
    }
if ($field=='TELS')  {
    $querymain = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,id_cuenta,status_de_credito FROM resumen WHERE 
(tel_1 regexp '".$find."' or 
tel_2 regexp '".$find."' or 
tel_3 regexp '".$find."' or 
tel_4 regexp '".$find."' or 
tel_1_alterno regexp '".$find."' or 
tel_2_alterno regexp '".$find."' or 
tel_3_alterno regexp '".$find."' or 
tel_4_alterno regexp '".$find."' or 
tel_1_ref_1 regexp '".$find."' or 
tel_2_ref_1 regexp '".$find."' or 
tel_1_ref_2 regexp '".$find."' or 
tel_2_ref_2 regexp '".$find."' or 
tel_1_ref_3 regexp '".$find."' or 
tel_2_ref_3 regexp '".$find."' or 
tel_1_ref_4 regexp '".$find."' or 
tel_2_ref_4 regexp '".$find."' or 
tel_1_laboral regexp '".$find."' or 
tel_2_laboral regexp '".$find."' or 
tel_1_verif regexp '".$find."' or 
tel_2_verif regexp '".$find."' or 
tel_3_verif regexp '".$find."' or 
tel_4_verif regexp '".$find."' or 
telefonos_marcados regexp '".$find."')";    
    }
if (strlen($CLIENTE)>1) {$querymain=$querymain." and cliente='".$CLIENTE."'";}
if ($mytipo!='admin'&&$mytipo!='supervisor') {
        $querymain=$querymain.";";}
$result = mysql_query($querymain) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>COBRA - Buscar</title>

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
<h1>BUSCAR</h1>
<button onClick="window.location='<?php echo $from;?>?go=FROMBUSCAR&i=0&field=id_cuenta&find=<?php echo $C_CONT;?>&capt=<?php echo $capt;?>'">Regresar al resumen</button>
<table summary="Cuentas">
<thead>
<tr>
<th>CUENTA</th>
<th>NOMBRE</th>
<th>CLIENTE</th>
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
<td><a<?php if (preg_match('/nactivo/', $STATUS)) { ?> style="color:#ffffff;"<?php } ?> href='<?php echo $from;?>?go=FROMBUSCAR&i=0&field=id_cuenta&find=<?php echo $ID_CUENTA;?>&capt=<?php echo $capt;?>&highlight=<?php echo $field?>&hfind=<?php echo $find?>'><?php echo $CUENTA;?></a></td>
<td><?php echo utf8_decode($NOMBRE);?></td>
<td><?php echo $CLIENTE;?></td>
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
