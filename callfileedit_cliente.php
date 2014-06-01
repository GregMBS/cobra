<?php  
include('cliente_hdr.php');
$i=0;
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$mytipo=$answercheck[1];
$id=mysql_real_escape_string($_GET['id']);
$tel=mysql_real_escape_string($_GET['tel']);
if (!empty($_GET['go'])) {
$wherestr="((client='".$cliente."' and '".$mytipo."'='admin') 
or client='".$capt."')";
if (!empty($id)) {
$wherestring=$wherestring.' AND id = "'.$id.'"';
}
if (!empty($tel)) {$wherestring=$wherestring.' AND tel="'.$tel.'"';}
$querydel="UPDATE robot.calllist SET camp=0 WHERE ".$wherestring;
mysql_query($querydel);
$querydel2="update cobra.resumen set norobot=1 WHERE ".$wherestring;
mysql_query($querydel2);
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
<button onclick="window.location='robot_cliente.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<form id="quitar" name="quitar" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
<p>Cuenta <input type='text' name='id' id='id' value='<?php echo $id;?>'>
</p>
<p>Tel&eacute;fono <input type='text' name='tel' id='tel' value='<?php echo $tel;?>'>
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
