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
$ID_CUENTA=mysql_real_escape_string($_GET['id_cuenta']);
setcookie('id_cuenta',$ID_CUENTA);
$querycc="SELECT numero_de_cuenta, cliente, 
ejecutivo_asignado_call_center, numero_de_credito, status_de_credito 
FROM resumen 
WHERE id_cuenta='".$ID_CUENTA."';";
$resultcc=mysql_query($querycc) or die (mysql_error());
while ($answercc=mysql_fetch_row($resultcc)) {
$CUENTA=$answercc[0];
$CLIENTE=$answercc[1];
$GESTOR=$answercc[2];
$CREDITO=$answercc[3];
$stc=$answercc[4];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>COBRA Pagos</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<link rel="stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script> 
			<script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script> 
			<script src="bower_components/datatables/media/js/jquery.dataTables.min.js" type="text/javascript"></script> 
<style>
tr.odd { background-color: white }
tr.even { background-color: #dddddd }
</style>
</head>
<body>
<script LANGUAGE="JavaScript" TYPE="text/JavaScript">
	$(function() {
		$( "input:submit, a, button" ).button();
		$( "body" ).css("font-size", "10pt")
		$('#pagohead').dataTable({
			"sAjaxSource": "pagos_ajax.php",
			"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
				$('td:eq(2)', nRow).css('text-align','center');
				if (aData[2]==0) {
				$('td:eq(2)', nRow).html('NO');
					}
				else {
				$('td:eq(2)', nRow).html('S&Iacute;');
					}	
				return nRow;
			},
			"bJQueryUI": true
				})
		});	
</script>
<div id="pagobox">
<p>
CUENTA:&nbsp;&nbsp;<?php echo $CUENTA?><br>
CLIENTE:&nbsp;<?php echo $CLIENTE?>
</p>
<table summary="pagohead" id="pagohead">
<thead>
<tr>
<th>FECHA PAGO</th>
<th>MONTO</th>
<th>CONFIRMADO</th>
<th>FECHA CAPTURADO</th>
</tr>
</thead>
</table>
<tbody>
</tbody>
</table>
</div>
<button onClick='window.close()'>CIERRA</button>
<?php   
}
}
mysql_close($con);
?>
</body>
</html> 
