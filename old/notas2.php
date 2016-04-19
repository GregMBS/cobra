<?php
//include('user_hdr.php');
//while ($answercheck=mysql_fetch_row($resultcheck)) {
//if ($answercheck[0]!=1) {
//$redirector = "Location: index.php";
//header($redirector);
//}
//else {
$host = "localhost";
$user = "admin";
$pswd = "AwRats";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pswd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$capt=mysql_real_escape_string($_GET['capt']);
setcookie('gestor',$capt,0,'/','');
$C_CONT=mysql_real_escape_string($_GET['C_CONT']);
$querycta="SELECT numero_de_cuenta FROM resumen 
where id_cuenta=".$C_CONT." LIMIT 1";
$resultcta=mysql_query($querycta);
while ($answercta=mysql_fetch_row($resultcta)) {$CUENTA=$answercta[0];}
if ($_GET['go']=='GUARDAR') {
$D_FECH=date('Y-m-d');
$C_HORA= date('H:i:s');
$HORA='';
if (mysql_real_escape_string($_GET['HORA'])!='') {
$HORA=mysql_real_escape_string($_GET['HORA']).':00';
}
$NOTA=mysql_real_escape_string($_GET['NOTA']);
$FECHA=mysql_real_escape_string($_GET['FECHA']);
$querybor = "UPDATE cobra4.notas SET borrado=1 
WHERE c_cvge='".$capt."' and c_cont='".$C_CONT."'";
mysql_query($querybor) or die (mysql_error());
$queryins = "INSERT INTO cobra4.notas (C_CVGE,fuente,D_FECH,C_HORA,FECHA,HORA,NOTA,CUENTA,C_CONT) 
VALUES ('$capt','$capt',date('$D_FECH'),'$C_HORA','$FECHA','$HORA','$NOTA','0','$C_CONT')";
mysql_query($queryins) or die (mysql_error());
$queryfix = "update notas, resumen 
SET cuenta=numero_de_cuenta where c_cont=id_cuenta
and cuenta<>numero_de_cuenta";
mysql_query($queryfix) or die (mysql_error());
$redirector = "Location: notas.php?capt='".$capt."'&go=FROMGUARDAR";
header($redirector);
};
if ($_GET['go']=='BORRAR') {
$AUTO=mysql_real_escape_string($_GET['which']);
$queryins = "UPDATE cobra4.notas set borrado=1 where AUTO='$AUTO' and C_CVGE='$capt'";
mysql_query($queryins) or die (mysql_error());
$redirector = "Location: notas.php?capt=".$capt."&go=FROMBORRAR";
header($redirector);
};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>COBRA Notas</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="js/jquery-1.5.1.min.js" type="text/javascript"></script> 
			<script src="js/jquery-ui-1.8.13.custom.min.js" type="text/javascript"></script> 
			<script src="DT/media/js/jquery.dataTables.min.js" type="text/javascript"></script> 
</head>
<body>
<script LANGUAGE="JavaScript" TYPE="text/JavaScript">
	$(function() {
		$( "#FECHA" ).datepicker($.datepicker.regional['es']);
		$( "#FECHA" ).datepicker( "option", "dateFormat", 'yy-mm-dd' );
		$('#notahead').dataTable({
				"sAjaxSource": "notas_ajax.php",
				"bJQueryUI": true,
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
				$('td:eq(4)', nRow).html( '<a href="notas.php?capt=<?php echo $capt;?>&go=BORRAR&which='+aData[4]+'">BORRAR</a>' );
			return nRow;
			}
		});	
	});
</script>
<div id="notabox">
<table summary="notahead" id="notahead">
<thead>
<tr>
<th>FECHA</th>
<th>HORA</th>
<th>CUENTA</th>
<th>NOTA</th>
<th>BORRAR</th>
</tr>
</thead>
<tbody class="dataTables_empty">
</tbody>
</table>
</div>
<form action="notas.php" method="get" name="notas">
<span class="formcap">Fecha</span><INPUT TYPE="text" NAME="FECHA" ID="FECHA" VALUE="" SIZE=15>
<br>
<span class="formcap">Hora</span>
<select NAME="HORA" ID="HORA">
<option value=''></option>
<option value='00:00'>00:00</option>
<option value='00:15'>00:15</option>
<option value='00:30'>00:30</option>
<option value='00:45'>00:45</option>
<option value='01:00'>01:00</option>
<option value='01:15'>01:15</option>
<option value='01:30'>01:30</option>
<option value='01:45'>01:45</option>
<option value='02:00'>02:00</option>
<option value='02:15'>02:15</option>
<option value='02:30'>02:30</option>
<option value='02:45'>02:45</option>
<option value='03:00'>03:00</option>
<option value='03:15'>03:15</option>
<option value='03:30'>03:30</option>
<option value='03:45'>03:45</option>
<option value='04:00'>04:00</option>
<option value='04:15'>04:15</option>
<option value='04:30'>04:30</option>
<option value='04:45'>04:45</option>
<option value='05:00'>05:00</option>
<option value='05:15'>05:15</option>
<option value='05:30'>05:30</option>
<option value='05:45'>05:45</option>
<option value='06:00'>06:00</option>
<option value='06:15'>06:15</option>
<option value='06:30'>06:30</option>
<option value='06:45'>06:45</option>
<option value='07:00'>07:00</option>
<option value='07:15'>07:15</option>
<option value='07:30'>07:30</option>
<option value='07:45'>07:45</option>
<option value='08:00'>08:00</option>
<option value='08:15'>08:15</option>
<option value='08:30'>08:30</option>
<option value='08:45'>08:45</option>
<option value='09:00'>09:00</option>
<option value='09:15'>09:15</option>
<option value='09:30'>09:30</option>
<option value='09:45'>09:45</option>
<option value='10:00'>10:00</option>
<option value='10:15'>10:15</option>
<option value='10:30'>10:30</option>
<option value='10:45'>10:45</option>
<option value='11:00'>11:00</option>
<option value='11:15'>11:15</option>
<option value='11:30'>11:30</option>
<option value='11:45'>11:45</option>
<option value='12:00'>12:00</option>
<option value='12:15'>12:15</option>
<option value='12:30'>12:30</option>
<option value='12:45'>12:45</option>
<option value='13:00'>13:00</option>
<option value='13:15'>13:15</option>
<option value='13:30'>13:30</option>
<option value='13:45'>13:45</option>
<option value='14:00'>14:00</option>
<option value='14:15'>14:15</option>
<option value='14:30'>14:30</option>
<option value='14:45'>14:45</option>
<option value='15:00'>15:00</option>
<option value='15:15'>15:15</option>
<option value='15:30'>15:30</option>
<option value='15:45'>15:45</option>
<option value='16:00'>16:00</option>
<option value='16:15'>16:15</option>
<option value='16:30'>16:30</option>
<option value='16:45'>16:45</option>
<option value='17:00'>17:00</option>
<option value='17:15'>17:15</option>
<option value='17:30'>17:30</option>
<option value='17:45'>17:45</option>
<option value='18:00'>18:00</option>
<option value='18:15'>18:15</option>
<option value='18:30'>18:30</option>
<option value='18:45'>18:45</option>
<option value='19:00'>19:00</option>
<option value='19:15'>19:15</option>
<option value='19:30'>19:30</option>
<option value='19:45'>19:45</option>
<option value='20:00'>20:00</option>
<option value='20:15'>20:15</option>
<option value='20:30'>20:30</option>
<option value='20:45'>20:45</option>
<option value='21:00'>21:00</option>
<option value='21:15'>21:15</option>
<option value='21:30'>21:30</option>
<option value='21:45'>21:45</option>
<option value='22:00'>22:00</option>
<option value='22:15'>22:15</option>
<option value='22:30'>22:30</option>
<option value='22:45'>22:45</option>
<option value='23:00'>23:00</option>
<option value='23:15'>23:15</option>
<option value='23:30'>23:30</option>
<option value='23:45'>23:45</option>
</select>
<br>
<span class="formcap">Cuenta</span><input type="text" name="CUENTA" readonly="readonly" value=<?php echo $CUENTA;?>></input><br>
<span class="formcap">Nota</span><textarea rows="2" cols="40" name="NOTA"></textarea><br>
<input type="hidden" name="C_CONT" readonly="readonly" value=<?php echo $C_CONT;?> /><br>
<input type="hidden" name="D_FECH" readonly="readonly" value=<?php echo date('Y-m-d');?> /><br>
<input type="hidden" name="C_HORA" readonly="readonly" value=<?php echo date('H:i:s');?> /><br>
<input type="hidden" name="AUTO" readonly="readonly" value="" /><br>
<input type="hidden" name="capt" readonly="readonly" value=<?php echo $capt;?> /><br>
<input type="submit" name="go" value="GUARDAR">
</form>
<button onClick='window.close()'>CIERRA</button>
</body>
</html> 
<?php 
//}  
//}
mysql_close($con);
?>

