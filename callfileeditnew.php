<?php  
include('admin_hdr_2.php');
$i=0;
$myFile = "/tmp/callfile.csv";
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
if (!empty($_GET['go'])) {
$wherestr='';
$cliente=mysql_real_escape_string($_GET['cliente']);
if (!empty($cliente)) {
$wherestring=$wherestring.' id IN (select id_cuenta from cobra4.resumen where cliente="'.$cliente.'")';
}
$nombre=mysql_real_escape_string($_GET['nombre']);
if (!empty($nombre)) {
$wherestring=$wherestring.' AND id IN (select id_cuenta from cobra4.resumen where nombre_deudor="'.$nombre.'")';
}
$cuenta=mysql_real_escape_string($_GET['cuenta']);
if (!empty($cuenta)) {
$wherestring=$wherestring.' AND id IN (select id_cuenta from cobra4.resumen where numero_de_cuenta="'.$cuenta.'")';
}
$tel=mysql_real_escape_string($_GET['tel']);
if (!empty($tel)) {$wherestring=$wherestring.' AND tel="'.$tel.'"';}
$querydel="DELETE FROM robot.calllist WHERE ".$wherestring;
mysql_query($querydel);
$redirector = "Location: index.php";
header($redirector);
}
if (empty($_POST['go'])) {
$i=0;
$query="select id_cuenta,tel,msg,id,nombre_deudor 
from robot.calllist join cobra4.resumen on id=numero_de_cuenta;";
$result = mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$cuenta[$i]=$row[3];$nombre[$i]=$row[4];
$id[$i]=$row[0];
$tel[$i]=$row[1];
$msg[$i]=$row[2];
$i++;
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Editar ROBOT</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
<p>Cliente <select name="cliente">
<?php
    $querycl = "SELECT DISTINCT client FROM robot.calllist JOIN robot.msglist USING (msg);";
    $resultcl = mysql_query($querycl);
    
    while ($answercl = mysql_fetch_array($resultcl)) 
    {?>
  <option value="<?php echo $answercl[0];?>" style="font-size:120%;">
  <?php echo $answercl[0];?></option>
<?php
    } ?>
</select>
</p>
<p>Nombre <select name="nombre">
<?php
$query = "SELECT DISTINCT nombre_deudor FROM robot.calllist 
JOIN cobra4.resumen on id=id_cuenta ORDER BY nombre_deudor;";
$result = mysql_query($query);
?>  
<option value=""></option>
<?php
    while ($answer = mysql_fetch_array($result)) 
    {?>
  <option value="<?php echo $answer[0];?>" style="font-size:120%;">
  <?php echo $answer[0];?></option>
<?php
    } ?>
</select>
</p>
<p>Cuenta <select name="cuenta">
<?php
$query = "SELECT DISTINCT numero_de_cuenta FROM robot.calllist 
JOIN cobra4.resumen on id=id_cuenta ORDER BY numero_de_cuenta+0;";
$result = mysql_query($query);
?>  
<option value=""></option>
<?php
    while ($answer = mysql_fetch_array($result)) 
    {?>
  <option value="<?php echo $answer[0];?>" style="font-size:120%;">
  <?php echo $answer[0];?></option>
<?php
    } ?>
</select>
</p>
<p>Tel&eacute;fono <select name="tel">
<?php
$query = "SELECT DISTINCT tel FROM robot.calllist 
ORDER BY tel+0;";
$result = mysql_query($query);
?>  
<option value=""></option>
<?php
    while ($answer = mysql_fetch_array($result)) 
    {?>
  <option value="<?php echo $answer[0];?>" style="font-size:120%;">
  <?php echo $answer[0];?></option>
<?php
    } ?>
</select>
</p>
<input type="hidden" name="capt" value="<?php echo $capt ?>" />
<input type="submit" name="go" value="quitar" />
</form>
</body>
</html>
<?php
}
}
}
mysql_close()
?>
