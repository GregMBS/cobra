<?php
include('user_hdr.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {
$redirector = "Location: index.php";
header($redirector);
}
else {
$sistema=$_SERVER['REMOTE_ADDR'];
$usuario=$capt;
$go=mysql_real_escape_string($_REQUEST['go']);
if ($go=='ENVIAR') {
$fechahora = date('Y-m-d H:i:s');
$fuente=mysql_real_escape_string($_REQUEST['fuente']);
$descripcion=mysql_real_escape_string($_REQUEST['descripcion']);
$error_msg=mysql_real_escape_string($_REQUEST['error_msg']);
$queryins = "INSERT INTO cobra.trouble (sistema,usuario,fechahora,fuente,descripcion,error_msg) 
VALUES ('$sistema','$usuario',now(),'$fuente','$descripcion','$error_msg')";
mysql_query($queryins) or die (mysql_error());
$message='Error en '.$fuente.' de sistema '.$sistema.' y usuario '.$usuario.' enviado '.$fechahora;
};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>COBRA Trouble</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type='text/css'>
	body {font-family: verdana,arial, helvetica, sans-serif; font-size: 8pt; background-color: #ffffff;color:#000000;}
	span.formcap {display: block; width: 12em; float: left;}
	th {width: 12em;}
	td {border: 1pt solid #c0c0c0;background-color: #c0c0c0; width:12em;color:black;}
	#tableContainer {height: 6cm; overflow: scroll;}
</style>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/JavaScript">
<?php if ($go=='ENVIAR') {?>
    alert('<?php echo $message;?>');
<?php } ?>
</SCRIPT>
</head>
<body>
<form action="#" method="get" name="trouble">
<span class="formcap">Fuente de problema</span><select name='fuente'>
<option value='COBRA'>COBRA</option>
<option value='EKIGA'>EKIGA</option>
<option value='ELASTIX'>ELASTIX</option>
<option value='DIADEMA'>DIADEMA</option>
<option value='COMPUTADORA'>COMPUTADORA</option>
<option value='MONITOR'>MONITOR</option>
<option value='TECLADO'>TECLADO</option>
<option value='RATON'>RATON</option>
<option value='otro'>otro</option>
</select>
<br>
<span class="formcap">Descripcion</span><textarea rows="6" cols="60" name="descripcion">Cuando yo:

Veo:

Sin embargo, espero:

</textarea><br>
<span class="formcap">Error mensajen (texto <em>EXACTO</em>)</span><textarea rows="2" cols="40" name="error_msg"></textarea><br>
<input type="hidden" name="C_CONT" readonly="readonly" value=<?php echo $C_CONT;?> /><br>
<input type="hidden" name="capt" readonly="readonly" value=<?php echo $capt;?> /><br>
<input type="submit" name="go" value="ENVIAR">
</form>
<button onClick='window.close()'>CIERRA</button>
</body>
</html> 
<?php 
}  
}
mysql_close($con);
?>

