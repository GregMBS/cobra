<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$attack=(!empty($_GET['auto']))||(!empty($_POST['auto']));
if ($attack) {die('ATTACK!');}
if (empty($_GET['capt']))
{
$redirector = "Location: index.php";
header($redirector);
}
$capt=mysql_real_escape_string($_GET['capt']);
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$queryck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."';";
$resultck=mysql_query($queryck);
while ($answerck=mysql_fetch_row($resultck)) {
if ($answerck[0]!=1) {}
else {
$message='';
$go=mysql_real_escape_string($_GET['go']);
$gestor=mysql_real_escape_string($_GET['gestor']);
if ($go=='ASIGNAR') {
$CUENTA=mysql_real_escape_string($_GET['CUENTA']);
if (!empty($CUENTA)) {
$querycheck1="SELECT count(1),('".$CUENTA."','".$gestor."') not in (select cuenta,gestor from vasign where fechaout>curdate()) 
FROM resumen WHERE numero_de_credito='".$CUENTA."' 
and cliente='PRESTAMO RELAMPAGO'
AND status_de_credito NOT REGEXP '-' and q(status_aarsa)<>'PAGOS' and q(status_aarsa)<>'PAGANDO CONVENIO'
and status_aarsa<>'PROPUESTA DE PAGO' 
and ('".$CUENTA."','".$gestor."') not in (select cuenta,gestor from vasign where fechaout>curdate())
";
$resultcheck1=mysql_query($querycheck1) or die(mysql_error());
while ($answercheck1=mysql_fetch_row($resultcheck1)) {
if ($answercheck1[0]==1) {
$C_CONT=0;
$querycc="select id_cuenta from resumen where numero_de_credito='".$CUENTA."'
and status_de_credito not like '%o' and cliente='Prestamo Relampago'
LIMIT 1;";
$resultcc=mysql_query($querycc) or die(mysql_error());
while ($answercc=mysql_fetch_row($resultcc)) {$C_CONT=$answercc[0];}
$queryins="INSERT INTO vasign (cuenta, gestor, fechaout, c_cont) 
VALUES ('".$CUENTA."','".$gestor."',now(),".$C_CONT.");";
mysql_query($queryins) or die(mysql_error());
}
else {if ($answercheck1[1]==1) {$message="Error capturando cuenta ".$CUENTA;}}
}}}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>COBRA Visitador Asignaciones y Recepciones - Prestamo Relampago</title>
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
<?php } else { ?>
document.getElementById('CUENTA').disabled=true
<?php } ?>
">
<h1>SOLO PARA PRESTAMO RELAMPAGO</h1>
<div id="vtable">
<h1><?php echo $message; ?></h1>
<form id='asigform' action='checkoutpr.php' method='get'>
<span class="formcap">Visitador:</span>
<select name="gestor" onChange="document.getElementById('asigform').submit()">
<option value='' <?php if ($gestor=='') {?> selected='selected'<?php } ?>></option>
<?php 
$query = "SELECT usuaria,completo FROM nombres where completo<>'' 
and (tipo='visitador' or tipo='admin')";
$result = mysql_query($query);
while ($answer = mysql_fetch_array($result)) {?>
<option value="<?php echo $answer[0];?>" <?php if ($gestor==$answer[0]) {?> selected='selected'<?php } ?>><?php echo htmlentities($answer[1]);?>
</option>
<?php }
?>
</select>
<input type="text" id="CUENTA" name="CUENTA" value="">
<input type="hidden" name="capt" value="<?php echo $capt;?>">
<input type="submit" name="go" value="ASIGNAR">
</form>
<button onclick="window.location='checkoutlist.php?capt=<?php echo $capt;?>&visitador=<?php echo $gestor;?>'"">CHECKLIST</button>
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
$gstring=';';
if (!empty($gestor)) {$gstring=" where gestor = '".$gestor."' and fechain is null order by fechaout desc limit 2;";} 
$querycc="select id_cuenta, numero_de_credito, nombre_deudor, cliente, saldo_total, 
q(status_aarsa),completo, fechaout, fechain 
from resumen join vasign 
on (cuenta=numero_de_credito and cliente='PRESTAMO RELAMPAGO')
join nombres on iniciales=gestor ".$gstring;
$resultcc=mysql_query($querycc) or die (mysql_error());
while ($answercc=mysql_fetch_row($resultcc)) {
$ID_CUENTA=$answercc[0];
$CUENTA=$answercc[1];
$NOMBRE=$answercc[2];
$CLIENTE=$answercc[3];
$ST=$answercc[4];
$QUEUE=$answercc[5];
$GESTOR=$answercc[6];
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
<?php } ?>
</table>
</div>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<?php   
}
}
mysql_close($con);
?>
</body>
</html> 
