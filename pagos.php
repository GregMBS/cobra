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
$redirector = "Location: ".$uri."/index.php";
header($redirector);
}
$capt=mysql_real_escape_string($_REQUEST['capt']);
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."';";
$resultcheck=mysql_query($querycheck);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$ID_CUENTA=mysql_real_escape_string($_REQUEST['id_cuenta']);
$querycc="SELECT numero_de_cuenta, cliente, 
ejecutivo_asignado_call_center, numero_de_credito 
FROM resumen 
WHERE id_cuenta='".$ID_CUENTA."';";
$resultcc=mysql_query($querycc) or die (mysql_error());
while ($answercc=mysql_fetch_row($resultcc)) {
$CUENTA=$answercc[0];
$CLIENTE=$answercc[1];
$GESTOR=$answercc[2];
$CREDITO=$answercc[3];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>COBRA Pagos</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type='text/css'>
	body {font-family: verdana,arial, helvetica, sans-serif; font-size: 8pt; background-color: #ffffff;color:#000000;}
	span.formcap {display: block; width: 12em; float: left;}
	th {width: 12em;}
	td {border: 1pt solid #c0c0c0;background-color: #c0c0c0; width:12em;color:black;}
	#tableContainer {height: 3cm; overflow: scroll;}
<?php
        if (substr($stc, -8)=='iquidado') {
?>
        #capturar {display:none}
<?php
}
?>
</style>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/JavaScript" SRC="CalendarPopup.js"></SCRIPT>
</head>
<body>
<div id="pagobox">
<p>
CUENTA:&nbsp;&nbsp;<?php echo $CUENTA?><br>
CLIENTE:&nbsp;<?php echo $CLIENTE?>
</p>
<table summary="pagohead" border='0' cellpadding='0' cellspacing=
'0' width='100%' id="pagohead">
<thead class='fixedHeader'>
<tr>
<th>FECHA</th>
<th>MONTO</th>
<th>CONFIRMADO</th>
</tr>
</thead>
</table>
<?php 
$querysub = "SELECT fecha,monto,confirmado 
FROM cobra.pagos 
WHERE cuenta='".$CUENTA."' AND cliente='".$CLIENTE."'  
ORDER BY fecha";
                $rowsub = mysql_query($querysub);
if (!(empty($rowsub))) {
?>
<div id='tableContainer' class='tableContainer'>
<table summary="notas" border='0' cellpadding='0' cellspacing=
'0' width='100%' id='notabody'>
<tbody class="scrollContent">
<?php
while ($answer = mysql_fetch_array($rowsub)) { 
$CF="NO";
if ($answer[2]==1) {$CF="S&Iacute;";}
?>
<tr>
<td><?php echo $answer[0];?></td>
<td><?php echo $answer[1];?></td>
<td><?php echo $CF;?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<?php } ?>
<button onClick='window.close()'>CIERRA</button>
<?php   
}
}
mysql_close($con);
?>
</body>
</html> 
