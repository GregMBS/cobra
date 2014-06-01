<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>Inactivar Cuentas</title>
<style>
    body {background-color:blue;}
    .num {text-align:right}
    textarea,select,option {background-color:white;}
    form {margin-left:auto;margin-right:auto;}
    p {background-color:gray;}
</style>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="cargar">
<p>Usa numero de cuenta</p>
<textarea name='data' rows='20' cols='50'></textarea>
<input type="hidden" name="capt" value="<?php
    echo $capt
?>" />
<button type="submit" name="go" value="cargar">Cargar</button>
</p>
</form>
<?php
  
    if (!empty($_POST['go'])) 
    {
        
        if ($_POST['go'] == 'cargar') 
        {
            
$data = preg_split("/[\s,]+/", $_POST['data'],0,PREG_SPLIT_NO_EMPTY);
$max=count($data);
$queryload='';
for ($i=0;$i<$max;$i++) {
$querydie="update resumen 
set status_de_credito=concat(trim(status_de_credito),'-inactivo') 
where status_de_credito not like '%tivo' and numero_de_cuenta='".$data[$i]."';";
//echo $querydie;
mysql_query($querydie) or die(mysql_error());
}
?>
<p>Cuentas est&aacute;n inactivadas</p>
<?php } } ?>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
    </body>
    </html>
<?php 
}
}
mysql_close($con);
?>
