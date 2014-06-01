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
<p>Usa formato CUENTA,TELE</p>
<textarea name='data' rows='20' cols='50'></textarea>
<p>Mensaje <select name="msgtag">
<?php
    $querycl = "SELECT client,tipo FROM robot.msglist;";
    $resultcl = mysql_query($querycl);
    
    while ($answercl = mysql_fetch_array($resultcl)) 
    {?>
  <option value="<?php echo $answercl[0].','.$answercl[1];?>" style="font-size:120%;">
  <?php echo $answercl[0].','.$answercl[1];?></option>
<?php
    } ?>
</select>
</p>
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
            
            $querytemp1 = 'DROP TABLE IF EXISTS robot.tempc';
mysql_query($querytemp1) or die(mysql_error());
            $querytemp2 = 'CREATE TABLE robot.tempc (
  `id` varchar(20) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `turno` varchar(50)
)';
mysql_query($querytemp2) or die(mysql_error());
$data0 = preg_replace('/[^0-9a-zA-Z]/', ',', $_POST['data']);
//$data0 = $_POST['data'];
$data1 = preg_replace('/\,\,/', ',', $data0);
$data = explode(',', $data1);
$max=ceil(count($data)/2);
$veces=1;
$veces=mysql_real_escape_string($_POST['count']);
$msgtag=mysql_real_escape_string($_POST['msgtag']);
$queryload='';
for ($i=0;$i<$max;$i++) {
$a=$i*2;
$b=$i*2+1;
$queryload = "INSERT INTO robot.tempc (id,tel) VALUES ('".$data[$a]."','".$data[$b]."');";
mysql_query($queryload) or die(mysql_error());
$queryload2 = "update robot.tempc 
SET tel=concat(9,tel) 
WHERE left(tel,1)<>9;";
//mysql_query($queryload2) or die(mysql_error());
}
            $fields = $_POST['fields'];
$queryput1 = "INSERT INTO robot.calllist (id,tel,msg,turno) 
SELECT id,tel,msg,0 FROM robot.tempc left join (select msg from robot.msglist 
where concat_ws(',',client,tipo)='".$msgtag."') as tmp on 1=1
;";
$queryput2 = "INSERT INTO robot.calllist (id,tel,msg,turno) 
SELECT id,tel,msg,0 FROM robot.tempc left join (select msg from robot.msglist 
where concat_ws(',',client,tipo)='".$msgtag."') as tmp on 1=1
;";
mysql_query($queryput1) or die(mysql_error());
//echo $queryput1.'<br>';
//mysql_query($queryput2) or die(mysql_error());
//echo $queryput2.'<br>';
?>
<p>Llamadas estan guardado</p>
<?php } } ?>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
    </body>
    </html>
<?php 
}
}
mysql_close($con);
?>
