<?php
include('usuario_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]==11) {die('ERROR');}
else {
$queryswitch="USE dnt";
mysql_query($queryswitch) or die("ERROR WM1 - ".mysql_error());
$querymain = "SELECT * FROM gray WHERE tel = '' LIMIT 1";
$go=mysql_real_escape_string($_REQUEST['go']);
$tel='';
$nombre='';
$cp='';
$calle='';
$colonia='';
$ciudad='';
$estado='';
if ($go=='FROMBUSCAR') {
$find=mysql_real_escape_string($_REQUEST['find']);
$querymain = "SELECT * FROM gray WHERE tel = '".$find."' LIMIT 1";
}
$result = mysql_query($querymain) or die("ERROR WM2 - ".mysql_error());
while($row = mysql_fetch_row($result)) {
$tel=$row[0];
$nombre=$row[1];
$cp=$row[3];
$calle=$row[2];
$colonia=$row[4];
$ciudad=$row[5];
$estado=$row[6];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Directorio</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
       body {font-family: verdana,arial, helvetica, sans-serif; font-size: 10pt; background-color: #ffffff;color:#000000;}
       span.formcap {display: block; width: 13em; float: left; font-size: 100%; font-weight:bold;}
</style>
</head>
<body>
<div>
<form action='whitesearch.php' method='get'>
<input type="hidden" name="capt" value="<?php if (isset($capt)) {echo $capt;} ?>">
<input type="hidden" name="go" value="BUSCAR">
<span class='formcap'>Nombre</span><input type='text' name='nombre' id="nombre" value='<?php if (isset($nombre)) {echo $nombre;} ?>'><br>
<span class='formcap'>Tel&eacute;fono</span><input type='text' name='tel' value='<?php if (isset($tel)) {echo $tel;} ?>'><br>
<span class='formcap'>Calle</span><input type='text' name='calle' value='<?php if (isset($calle)) {echo $calle;} ?>'><br>
<span class='formcap'>Colonia</span><input type='text' name='colonia' value='<?php if (isset($colonia)) {echo $colonia;} ?>'><br>
<span class='formcap'>Ciudad</span><input type='text' name='ciudad' value='<?php if (isset($ciudad)) {echo $ciudad;} ?>'><br>
<span class='formcap'>Estado</span><input type='text' name='estado' value='<?php if (isset($estado)) {echo $estado;} ?>'><br>
<span class='formcap'>CP</span><input type='text' name='cp' value='<?php if (isset($cp)) {echo $cp;} ?>'><br>
<input type="submit" value="BUSCAR">
<a href="javascript:window.location='white.php?capt=<?php echo $capt?>';">CLARO</a>
</form>
</div>
<?php   
}
}
mysql_close($con);
?>
</body>
</html> 
