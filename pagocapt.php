<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$attack=(!empty($_GET['auto']))||(!empty($_POST['auto']));
if ($attack) {die('ATTACK!');}
if (empty($_GET['capt']))
{
$redirector = "Location: ".$uri."/index.php";
header($redirector);
}
$capt=mysql_real_escape_string($_GET['capt']);
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."';";
$resultcheck=mysql_query($querycheck);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$go=mysql_real_escape_string($_GET['go']);
if ($go=='PAGO') {
$CUENTA=mysql_real_escape_string($_GET['CUENTA']);
$CLIENTE=mysql_real_escape_string($_GET['CLIENTE']);
$FECHA=mysql_real_escape_string($_GET['FECHA']);
$MONTO=mysql_real_escape_string($_GET['MONTO']);
$queryadd="insert into pagos (cuenta,fecha,monto,cliente,gestor,confirmado,credito,id_cuenta)
select numero_de_cuenta, '".$FECHA."', ".$MONTO.", cliente, 
c_cvge, 1, numero_de_credito,id_cuenta from resumen 
left join historia h1 on c_cont=id_cuenta and n_prom>0 and d_fech<='".$FECHA."'
where numero_de_cuenta='".$CUENTA."' 
and cliente='".$CLIENTE."'
and (numero_de_cuenta,'".$FECHA."','".$MONTO."',cliente) 
not in (select cuenta,fecha,monto,cliente from pagos where confirmado=1) 
group by id_cuenta,c_cvge  
order by d_fech desc,c_hrin desc limit 1";
$resultadd=mysql_query($queryadd) or die (mysql_error());
$queryadd2="update resumen,pagos
set fecha_de_ultimo_pago=fecha,monto_ultimo_pago=monto 
where resumen.id_cuenta=pagos.id_cuenta and confirmado=1 
and fecha>fecha_de_ultimo_pago";
$resultadd2=mysql_query($queryadd2) or die (mysql_error());
	}

if (empty($CUENTA)) {$CUENTA=0;}
$querycc="SELECT numero_de_cuenta, cliente, 
ejecutivo_asignado_call_center, numero_de_credito 
FROM resumen 
WHERE numero_de_cuenta='".$CUENTA."'
AND cliente='".$CLIENTE."'
;";
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
<SCRIPT LANGUAGE="JavaScript" TYPE="text/JavaScript" SRC="CalendarPopup.js"></SCRIPT>
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
CUENTA:&nbsp;<?php echo $CUENTA?><br>
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
FROM cobra4.pagos 
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
<div>
<form action='#' method='GET' id='payment'>
<input type='hidden' name='go' value='PAGO'>
<input type='hidden' name='capt' value='<?php echo $capt; ?>'>
<SCRIPT LANGUAGE="JavaScript" type="text/javascript">
var cal = new CalendarPopup();
 var oneMinute = 60 * 1000  // milliseconds in a minute
 var oneHour = oneMinute * 60
 var oneDay = oneHour * 24
 var today = new Date()
 var dateInMS = today.getTime() + oneDay * 10
cal.setMonthNames('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
cal.setDayHeaders('Do','Lu','Ma','Mi','Ju','Vi','Sa');
cal.setWeekStartDay(1);
cal.setTodayText("Hoy");
</SCRIPT>
CUENTA <input type='text' name='CUENTA' value=0>
CLIENTE <select name="CLIENTE" style="width: 8cm;">
<option value="" selected="selected"> </option>
<?php 
$query = "SELECT cliente FROM clientes order by cliente";
$result = mysql_query($query);
while ($answer = mysql_fetch_array($result)) { ?>
  <option style='width: 12cm;' value="<?php echo $answer[0];?>"><?php echo $answer[0];?></option>
<?php
}
?>
</select><br>
FECHA <INPUT TYPE="text" NAME="FECHA" ID="FECHAi" VALUE="" SIZE=15> 
<BUTTON onClick="cal.select(document.getElementById('FECHAi'),'anchor','yyyy-MM-dd'); return false;" 
NAME="anchor" ID="anchor">eligir</BUTTON></td>
MONTO <input type='text' name='MONTO' value=0>
<input type='submit' name='PAGO' value='PAGO'>
</form>
</div>
<button onClick='window.close()'>CIERRA</button>
<?php   
}
}
mysql_close($con);
?>
</body>
</html> 
