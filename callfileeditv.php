<?php  
include('admin_hdr_2.php');
$i=0;
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
if (!empty($_GET['go'])) {
$wherestr='';
$cliente=mysql_real_escape_string($_GET['cliente']);
$wherestring=$wherestring.' msg IN (select msg from robot.msglist where client="'.$cliente.'")';
$nombre=mysql_real_escape_string($_GET['nombre']);
if (!empty($nombre)) {
$wherestring=$wherestring.' AND id IN (select numero_de_cuenta from cobra.resumen where nombre_deudor="'.$nombre.'")';
}
$cuenta=mysql_real_escape_string($_GET['cuenta']);
if (!empty($cuenta)) {
$wherestring=$wherestring.' AND id = "'.$cuenta.'")';
}
$tel=mysql_real_escape_string($_GET['tel']);
if (!empty($tel)) {$wherestring=$wherestring.' AND tel="'.$tel.'"';}
$querydel="DELETE FROM robot.calllist WHERE ".$wherestring;
mysql_query($querydel);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>ROBOT Edit</title>
</head>
<body>
<?php if (!empty($_GET['go'])) {?>
<p>Llamadas estan quitado</p>
<?php } ?>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
<p>Cliente <select name="cliente">
<?php
    $querycl = "SELECT DISTINCT client FROM robot.calllist JOIN robot.msglist USING (msg);";
    $resultcl = mysql_query($querycl);
    
    while ($answercl = mysql_fetch_array($resultcl)) 
    {?>
  <option value="<?php echo $answercl[0];?>" 
  style="font-size:120%;" 
  <?php if ($answercl[0]=='Vanguardia') echo 'selected="selected"';?>>
  <?php echo $answercl[0];?></option>
<?php
    } ?>
</select>
</p>
<p>Nombre <select name="nombre">
<?php
$queryv = "SELECT DISTINCT nombre_deudor FROM robot.calllist 
JOIN robot.msglist USING (msg)
JOIN cobra.resumen on id=numero_de_cuenta and client=cliente
ORDER BY nombre_deudor;";
$resultv = mysql_query($queryv);
?>  
<option value=""></option>
<?php
    while ($answerv = mysql_fetch_array($resultv)) 
    {?>
  <option value="<?php echo $answerv[0];?>" style="font-size:120%;">
  <?php echo $answerv[0];?></option>
<?php
    } ?>
</select>
</p>
<p>Cuenta <select name="cuenta">
<?php
$queryv = "SELECT DISTINCT id FROM robot.calllist 
ORDER BY id+0;";
$resultv = mysql_query($queryv);
?>  
<option value=""></option>
<?php
    while ($answerv = mysql_fetch_array($resultv)) 
    {?>
  <option value="<?php echo $answerv[0];?>" style="font-size:120%;">
  <?php echo $answerv[0];?></option>
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
mysql_close()
?>
