<?php
include('usuario_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$cliente=mysql_real_escape_string($_GET['cliente']);
$cuenta=mysql_real_escape_string($_GET['cuenta']);
$tel=mysql_real_escape_string($_GET['tel']);
$hstart=mysql_real_escape_string($_GET['hstart']);
$hend=mysql_real_escape_string($_GET['hend']);
$veces=10;
if ($cliente!='Credito Si') {$veces=0;}
$querytemp1 = 'DROP TABLE IF EXISTS robot.tempc';
mysql_query($querytemp1) or die(mysql_error());
$querytemp2 = 'CREATE TABLE robot.tempc (
  `id` varchar(20) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `turno` varchar(50)
)';
mysql_query($querytemp2) or die(mysql_error());
$querycl = "SELECT client,tipo FROM robot.msglist LIMIT 1;";
$resultcl = mysql_query($querycl);
while ($answercl = mysql_fetch_array($resultcl)) {$msgtag=$answercl[0].','.$answercl[1];}
$queryload = "INSERT INTO robot.tempc (id,tel) VALUES ('".$cuenta."','".$tel."');";
mysql_query($queryload) or die(mysql_error());
}
for ($j=0;$j<$veces;$j++) {
for ($h=$hstart;$h<$hend;$h++) {
$queryput1 = "INSERT INTO robot.calllist (id,tel,msg,turno) 
SELECT id,right(tel,8),msg,".$h." FROM robot.tempc left join (select msg from robot.msglist 
where concat_ws(',',client,tipo)='".$msgtag."') as tmp on 1=1
WHERE (length(tel)=10 and left(tel,2)=81);";
$queryput2 = "INSERT INTO robot.calllist (id,tel,msg,turno) 
SELECT id,right(tel,8),msg,".$h." FROM robot.tempc left join (select msg from robot.msglist 
where concat_ws(',',client,tipo)='".$msgtag."') as tmp on 1=1
WHERE (length(tel)=10 and left(tel,2)<>81)
OR (length(tel)=8);";
mysql_query($queryput1) or die(mysql_error());
mysql_query($queryput2) or die(mysql_error());
     }
     }
     }
mysql_close($con);
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>ROBOT Carga</title>
</head>
<body>
<p>Robot se carg&oacute;<br>
Cliente: <?php echo $cliente?><br>
Cuenta: <?php echo $cuenta?><br>
Tel: <?php echo $tel?></p>
<button onClick='window.close()'>CIERRA</button>
</body>
</html>
