<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pwd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$capt=mysql_real_escape_string($_REQUEST['capt']);
     $local=explode('.',gethostbyaddr($_SERVER['REMOTE_ADDR']));
	$queryl="delete from userlog where usuario='".$local[0]."';";
	$resultl = mysql_query($queryl) or die("ERROR BM1 - ".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Breaks del Hoy</title>
<meta http-equiv="refresh" content="15"/>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 24pt; background-color: #00a0f0;}
       table {border: 1pt solid #000000;background-color: #ffffff;border-collapse: collapse;
       margin-left:auto;margin-right:auto;}
 	tr:hover {background-color: #ffff00;}
       th,td {border: 1pt solid #000000;background-color: #ffffff;}
       th,.heavy {font-weight:bold;}
       .light {text-align:right;}
       .rightnow {background-color:#ffff00;}
       .late {background-color:#ffff00; font-weight:bold; text-decoration:blink;}
       .verylate {background-color:#ff0000; font-weight:bold; text-decoration:blink;}
</style>
</head>
<body>
<button onclick="window.location='index.php'">LOGIN</button><br>
<table summary="Braeks">
<thead>
<tr>
<th>Gestor</th>
<th>Tipo</th>
<th>de</th>
<th>a</th>
<th>Minutes</th>
</tr>
</thead>
<tbody>
<?php
$ot='';
$og='';
$queryp = "select auto,c_cvge,c_cvst,c_hrin,time_to_sec(now())-time_to_sec(concat_ws(' ',d_fech,c_hrin)),now() 
from historia where c_cont=0 and 
d_fech=curdate() and c_cvst<>'login' and c_cvst<>'salir' and c_cvge='".$capt."' 
order by c_cvge,c_cvst,c_hrin";
$resultp = mysql_query($queryp) or die("ERROR BM2 - ".mysql_error());
while ($answerp = mysql_fetch_row($resultp)) {
$AUTO=$answerp[0];
$GESTOR=$answerp[1];
$TIPO=$answerp[2];
$TIEMPO=$answerp[3];
$DIFF=$answerp[4];
$formatstr=' class="late"';
$NTP=date('H:i:s',strtotime($answerp[5]));
$queryq = "select time_to_sec(min(c_hrin))-time_to_sec('".$TIEMPO."'),min(c_hrin) from historia 
where c_cvge='".$GESTOR."' and d_fech=curdate()
and c_hrin>'".$TIEMPO."';";
$resultq = mysql_query($queryq) or die("ERROR BM3 - ".mysql_error());
while ($answerq = mysql_fetch_row($resultq)) {
if (!empty($answerq[0])) {
$DIFF=$answerq[0];$NTP=$answerq[1];$formatstr='';
}
}
?>
<tr<?php echo $formatstr;?>>
<td><?php echo $GESTOR;?></td>
<td><?php echo $TIPO;?></td>
<td><?php echo $TIEMPO;?></td>
<td><?php echo $NTP;?></td>
<td><?php echo round($DIFF/60);?></td>
</tr>
<?php
}
?>
</tbody>
</table>
</body>
</html>
<?php   
mysql_close($con);
?>
