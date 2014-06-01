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
<title>ROBOT Carga</title>
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
<p>Una cuenta por fila</p>
<textarea name='data' rows='20' cols='50'></textarea>
</p>
<input type="hidden" name="capt" value="<?php
    echo $capt
?>" />
<input type="hidden" name="go" value="cargar">
<input type="submit" name="submit" value="cargar">
</p>
</form>
<?php
  
    if (!empty($_POST['go'])) 
    {
        
        if ($_POST['go'] == 'cargar') 
        {
            
            $querytemp1 = 'truncate cedulas';
mysql_query($querytemp1) or die(mysql_error());
$data = preg_split("/[\s,]+/", $_POST['data'],0,PREG_SPLIT_NO_EMPTY);
$max=count($data);
$queryload='';
for ($i=0;$i<$max;$i++) {
$queryload = "INSERT INTO cedulas (id) VALUES ('".$data[$i]."');";
mysql_query($queryload) or die(mysql_error());
}
?>
<p>Cuentas estan guardado</p>
<?php } } ?>
<button onclick="window.location='cedula_pdf.php?capt=<?php echo $capt;?>&source=cedula-j.pdf'">Imprimir cedulas PDF (Juarez)
</button><br>
<button onclick="window.location='cedula_pdf.php?capt=<?php echo $capt;?>&source=cedula-r.pdf'">Imprimir cedulas PDF (Reynosa)
</button><br>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa
</button><br>
    </body>
    </html>
<?php 
}
}
mysql_close($con);
?>

