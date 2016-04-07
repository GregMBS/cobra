<?php
$host = "localhost";
$user = "root";
$pwd = "DeathSta1";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
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
if ($answerck[0]!=1) {echo "Login por favor.";}
else {
$message='';
$go=mysql_real_escape_string($_REQUEST['go']);
$gestor=mysql_real_escape_string($_REQUEST['gestor']);
$tipo=mysql_real_escape_string($_REQUEST['tipo']);
if (empty($tipo)) {$tipo='id_cuenta';}
if ($go=='RECIBIR') {
$CUENTA=trim(mysql_real_escape_string($_REQUEST['CUENTA']));
if (!empty($CUENTA)) {
$querycta="select id_cuenta from resumen where ".$tipo."='".$CUENTA."';";
$resultcta=mysql_query($querycta) or die(mysql_error());
while ($answercta=mysql_fetch_row($resultcta)) {$C_CONT=$answercta[0];}
$queryins="update vasign set fechain=now() where  
c_cont='".$C_CONT."'
and fechain is null
limit 1
;";
//if ($capt='gmbs') {die($queryins);}
mysql_query($queryins) or die(mysql_error());
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>COBRA Visitador Asignaciones y Recepciones</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type='text/css'>
	body {font-family: verdana,arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0;color:#000000;}
	span.formcap {display: block; width: 12em; float: left;}
	th {width: 12em;}
	td {border: 1pt solid #c0c0c0;background-color: #ffffff; width:12em;color:black;}
	#tableContainer {height: 3cm; overflow: scroll;}
 </style>

</head>
<body onLoad="<?php if (!empty($gestor)) {?>
document.getElementById('CUENTA').focus()
<?php } ?>
">
<div id="vtable">
<h1><?php echo $message; ?></h1>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<form id='asigform' action='checkin.php' method='get'>
<span class="formcap">Visitador:</span>
<select name="gestor" onChange="document.getElementById('asigform').submit()">
<?php 
$query = "SELECT usuaria,completo FROM nombres where usuaria in 
(select gestor from vasign where fechain is null)
order by usuaria";
$result = mysql_query($query);
while ($answer = mysql_fetch_array($result)) {?>
<option value="<?php echo $answer[0];?>" <?php if ($gestor==$answer[0]) {?> selected='selected'<?php } ?>><?php echo $answer[0].' - '.htmlentities($answer[1]);?>
</option>
<?php }
?>
</select>
<input type="text" id="CUENTA" name="CUENTA" value=""><br>
c&oacute;digo de barras<input type="radio" id="CUENTA" name="tipo" <?php if ($tipo=='id_cuenta') {?>checked="checked"<?php } ?> value="id_cuenta">
numero de credito<input type="radio" id="CUENTA" name="tipo" <?php if ($tipo=='numero_de_cuenta') {?>checked="checked"<?php } ?> value="numero_de_cuenta">
<input type="hidden" name="capt" value="<?php echo $capt;?>">
<input type="hidden" name="go" value="RECIBIR">
<input type="submit" name="submit" value="RECIBIR">
</form>
<?php
$querycount="select sum(fechaout>curdate()),sum(fechain>curdate()) from vasign 
where gestor='".$gestor."';";
$resultcount=mysql_query($querycount) or die (mysql_error());
while ($answercount=mysql_fetch_row($resultcount)) {
$ASIG=$answercount[0];
$RECIB=$answercount[1];
}
?>
<p>Asignado: <?php echo $ASIG;?><br>
Recibido: <?php echo $RECIB;?></p>
<table>
<tr>
<th>ID_CUENTA</th>
<th>CUENTA</th>
<th>NOMBRE</th>
<th>CLIENTE</th>
<th>SALDO TOTAL</th>
<th>QUEUE</th>
<th>GESTOR</th>
<th>ASIG.</th>
<th>RECIB.</th>
</tr>
<?php 
if (!empty($gestor)) {
$querycc="select id_cuenta, numero_de_cuenta, nombre_deudor, cliente, saldo_total, 
q(status_aarsa),completo, fechaout, fechain 
from resumen join vasign on c_cont=id_cuenta 
join nombres on iniciales=gestor 
where gestor = '".$gestor."' 
order by fechain desc;";
$resultcc=mysql_query($querycc) or die (mysql_error());
while ($answercc=mysql_fetch_row($resultcc)) {
$ID_CUENTA=$answercc[0];
$CUENTA=$answercc[1];
$NOMBRE=$answercc[2];
$CLIENTE=$answercc[3];
$ST=$answercc[4];
$QUEUE=$answercc[5];
$GESTOR=htmlentities($answercc[6]);
$FECHAOUT=$answercc[7];
$FECHAIN=$answercc[8];
?>
<tr>
<td><?php echo $ID_CUENTA; ?></td>
<td><?php echo $CUENTA; ?></td>
<td><?php echo $NOMBRE; ?></td>
<td><?php echo $CLIENTE; ?></td>
<td><?php echo number_format($ST,0); ?></td>
<td><?php echo $QUEUE; ?></td>
<td><?php echo $GESTOR; ?></td>
<td><?php echo $FECHAOUT; ?></td>
<td><?php echo $FECHAIN; ?></td>
</tr>
<?php }
} ?>
</table>
</div>
<?php   
}
}
mysql_close($con);
?>
</body>
</html> 
