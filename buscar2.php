<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_GET['capt']);
setcookie('capt',$capt);
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
$field=mysql_real_escape_string ($_GET['field']);
setcookie('field',$field);
$find=mysql_real_escape_string ($_GET['find']);
setcookie('find',$find);
$from=mysql_real_escape_string ($_GET['from']);
if (!empty($_GET['C_CONT'])) {
$C_CONT=mysql_real_escape_string ($_GET['C_CONT']);
}
$CLIENTE=mysql_real_escape_string ($_GET['cliente']);
setcookie('cliente',$CLIENTE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>COBRA - Buscar</title>

			<link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="js/jquery-1.5.1.min.js" type="text/javascript"></script> 
			<script src="js/jquery-ui-1.8.13.custom.min.js" type="text/javascript"></script> 
			<script src="DT/media/js/jquery.dataTables.min.js" type="text/javascript"></script> 
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
		$('#buscartab').dataTable({
			"sAjaxSource": "buscar_ajax.php",
			"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
				$('td:eq(0)', nRow).html('<a href="<?php echo $from;?>?go=FROMBUSCAR&i=0&field=id_cuenta&find='+aData[4]+'&capt=<?php echo $capt;?>&highlight=<?php echo $field?>&hfind='+aData[1]+'">'+aData[0]+'</a>');
				if (aData[3].search(/[vd]o$/)>-1) {
				$('td:eq(0) a', nRow).css('color','gray');
					}
				return nRow;
			},
				"bJQueryUI": true
				})
		});	
</script>
<h1>BUSCAR</h1>
<?php if (!empty($C_CONT)) { ?>
<button onClick="window.location='<?php echo $from;?>?go=FROMBUSCAR&i=0&field=id_cuenta&find=<?php echo $C_CONT;?>&capt=<?php echo $capt;?>'">Regresar al resumen</button>
<?php } else { ?>
<button onClick="window.location='<?php echo $from;?>?capt=<?php echo $capt;?>'">Regresar al resumen</button>
<?php } ?>
<table summary="Cuentas" id='buscartab'>
<thead>
<tr>
<th>CUENTA</th>
<th>NOMBRE</th>
<th>CLIENTE</th>
<th>CAMPA&Ntilde;A</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
<div id="searchbox">
<h2>Buscar</h2>
<form name="search" method="get" action=
"buscar.php" id="search">Buscar a: <input type=
"text" name="find"> en <select name="field">
<option value="nombre_deudor">Nombre</option>
<option value="domicilio_deudor">Direcci&oacute;n</option>
<option value="numero_de_cuenta">Cuenta</option>
<option value="numero_de_credito">Credito</option>
<option value="EXACTO">Cuenta Exacta</option>
<option value="TELS">Telefonos</option>
<option value="ROBOT">Telefonos marcados</option>
<option value="REFS">Aval/Referencias</option>
<option value="id_cuenta">Expediente</option>
<option value="producto">Producto</option>
<option value="subproducto">Subproducto/Grupo</option>
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
