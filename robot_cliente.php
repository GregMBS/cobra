<?php
include('cliente_hdr.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$mytipo=$answercheck[1];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Cliente ROBOT Menu</title>
<style>
       body {font-family: verdana,arial, helvetica, sans-serif; font-size: 10pt; background-color: #00a0f0;color:#000000;}
       div {border: 1pt black solid;background-color:#c0c0c0; float:left; margin: 1em;padding:0.25em;text-align:left}
       h2 {padding:0.25em;text-align: center}
       button {display:block;clear: both;text-align: center}
</style>
</head>
<div><h2>Controlar ROBOT</h2>
<h3>ROBOT</h3>
<a href="cargatel_cliente.php?capt=<?php echo $capt;?>" name="cargatel">CARGAR Llamadas Manualimente</a><br>
<a href="robocon_cliente.php?capt=<?php echo $capt;?>" name="robocon">CONTROLAR ROBOT</a><br>
<a href="callfileedit_cliente.php?capt=<?php echo $capt;?>" name="callfileedit">QUITAR Llamadas</a><br>
</div>
</body>
</html>
<?php
}
}
mysql_close();
?>
