<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$attack=(!empty($_REQUEST['auto']))||(!empty($_REQUEST['auto']));
if ($attack) {die('ATTACK!');}
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
if ($answerck[0]!=1) {}
else {
$message='';
$go=mysql_real_escape_string($_REQUEST['go']);
$gestor=mysql_real_escape_string($_REQUEST['gestor']);
$fechaout=mysql_real_escape_string($_REQUEST['fechaout']);
if ($go=='RECIBIR') {
$CUENTA=mysql_real_escape_string($_REQUEST['CUENTA']);
if (!empty($CUENTA)) {
$querycc="select id_cuenta from resumen 
where ((numero_de_cuenta='".$CUENTA."' and cliente<>'Prestamo Relampago') 
or (numero_de_credito='".$CUENTA."' and cliente='Prestamo Relampago'))
and status_de_credito=who(status_de_credito);";
$resultcc=mysql_query($querycc) or die(mysql_error());
while ($answercc = mysql_fetch_array($resultcc)) {$ID_CUENTA=$answercc[0];}
$queryins="INSERT INTO vasign (cuenta, gestor, fechaout, fechain,c_cont) 
VALUES ('".$CUENTA."','".$gestor."','".$fechaout."',now(),".$ID_CUENTA.");";
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
<?php } else { ?>
document.getElementById('CUENTA').disabled=true
<?php } ?>
">
<div id="vtable">
<h1><?php echo $message; ?></h1>
<form id='asigform' action='checkboth.php' method='get'>
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
<select name="fechaout">
<option value='' <?php if ($fechaout=='') {?> selected='selected'<?php } ?>></option>
<?php 
$queryd = "SELECT distinct concat_ws('-',year(d_fech),month(d_fech),day(d_fech)) FROM historia 
where d_fech between (curdate()-interval 1 month) AND curdate()
order by d_fech
";
$resultd = mysql_query($queryd);
while ($answerd = mysql_fetch_array($resultd)) {?>
<option value="<?php echo $answerd[0];?>" <?php if ($fechaout==$answerd[0]) {?> selected='selected'<?php } ?>><?php echo $answerd[0];?>
</option>
<?php }
?>
</select>
<input type="text" id="CUENTA" name="CUENTA" value="">
<input type="hidden" name="capt" value="<?php echo $capt;?>">
<input type="submit" name="go" value="RECIBIR">
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
$gstring=';';
if (!empty($gestor)) {$gstring=" where gestor = '".$gestor."' order by fechain desc;";} 
$querycc="select id_cuenta, numero_de_cuenta, nombre_deudor, cliente, saldo_total, 
q(status_aarsa),completo, fechaout, fechain 
from resumen join vasign on id_cuenta=c_cont join nombres on iniciales=gestor ".$gstring;
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
