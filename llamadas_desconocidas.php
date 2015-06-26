<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {mysql_close($con);}
else {
$querycobra="SELECT right(tel_1,8) as tel from resumen where length(tel_1)>7
UNION
SELECT right(tel_2,8) from resumen where length(tel_2)>7
UNION
SELECT right(tel_3,8) from resumen where length(tel_3)>7
UNION
SELECT right(tel_4,8) from resumen where length(tel_4)>7
UNION
SELECT right(tel_1_ref_1,8) from resumen where length(tel_1_ref_1)>7
UNION
SELECT right(tel_1_ref_2,8) from resumen where length(tel_1_ref_2)>7
UNION
SELECT right(tel_1_ref_3,8) from resumen where length(tel_1_ref_3)>7
UNION
SELECT right(tel_1_alterno,8) from resumen where length(tel_1_alterno)>7
UNION
SELECT right(tel_2_alterno,8) from resumen where length(tel_2_alterno)>7
UNION
SELECT right(tel_1_laboral,8) from resumen where length(tel_1_laboral)>7
UNION
SELECT right(tel_2_laboral,8) from resumen where length(tel_2_laboral)>7
UNION
SELECT right(tel_1_verif,8) from resumen where length(tel_1_verif)>7
UNION
SELECT right(tel_2_verif,8) from resumen where length(tel_2_verif)>7
UNION
SELECT right(tel_3_verif,8) from resumen where length(tel_3_verif)>7
UNION
SELECT right(tel_4_verif,8) from resumen where length(tel_4_verif)>7
;";
$resultcobra=mysql_query($querycobra) or die(mysql_error());
$i=0;
while ($teli=mysql_fetch_row($resultcobra)) {$tel[$i]=$teli[0];$i++;}
mysql_close($con);
$host = "192.168.0.102";
$user = "asterisk";
$pswd = "DeathSta1";
$db = "asteriskcdrdb";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pswd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$querya="SELECT * FROM cdr 
where calldate>curdate() and length(src)=3";
$resulta=mysql_query($querya) or die(mysql_error());
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>LLAMADAS DESCONOCIDAS</title>
</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<table>
<tr>
<?php while ($rowa=mysql_fetch_row($resulta)) {
$pbxmatch=substr($rowa[3], -8);
if (!array_search($pbxmatch,$tel)) {
for ($j=0;$j<16;$j++) {
echo "<td>".$rowa[$j]."</td>";
}
 } ?>
</tr>
<?php } ?>
</table>
    </body>
    </html>
<?php 
}
}
mysql_close($con);
?>
