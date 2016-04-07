<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_REQUEST['capt']);
set_time_limit(300);
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."';";
$resultcheck=mysql_query($querycheck) or die(mysql_error());
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$field=mysql_real_escape_string ($_REQUEST['field']);
$find=mysql_real_escape_string ($_REQUEST['find']);
$querymain = "SELECT SQL_NO_CACHE ".$field." from resumen where ".$field." regexp '".$find."'";
if ($field=='id_cuenta')  {$querymain = "SELECT id_cuenta from resumen where id_cuenta = ".$find;}
if ($field=='REFS')  {
    $querymain = "SELECT SQL_NO_CACHE nombre_deudor_alterno,nombre_referencia_1, 
    nombre_referencia_2,nombre_referencia_3,nombre_referencia_4
FROM resumen WHERE 
(nombre_deudor_alterno regexp '".$find."' or 
nombre_referencia_1 regexp '".$find."' or 
nombre_referencia_2 regexp '".$find."' or 
nombre_referencia_3 regexp '".$find."' or 
nombre_referencia_4 regexp '".$find."')";    
    }
if ($field=='TELS')  {
    $querymain = "SELECT SQL_NO_CACHE 
    tel_1,tel_2,tel_3,tel_4,tel_1_alterno,tel_2_alterno,tel_3_alterno,tel_4_alterno,
    tel_1_ref_1,tel_2_ref_1,tel_1_ref_2,tel_2_ref_2,tel_1_ref_3,tel_2_ref_3,tel_1_ref_4,tel_2_ref_4,
    tel_1_verif,tel_2_verif,tel_3_verif,tel_4_verif,tel_1_laboral,tel_2_laboral
     FROM resumen WHERE 
(tel_1 regexp '".$find."' or 
tel_2 regexp '".$find."' or 
tel_3 regexp '".$find."' or 
tel_4 regexp '".$find."' or 
tel_1_alterno regexp '".$find."' or 
tel_2_alterno regexp '".$find."' or 
tel_3_alterno regexp '".$find."' or 
tel_4_alterno regexp '".$find."' or 
tel_1_ref_1 regexp '".$find."' or 
tel_2_ref_1 regexp '".$find."' or 
tel_1_ref_2 regexp '".$find."' or 
tel_2_ref_2 regexp '".$find."' or 
tel_1_ref_3 regexp '".$find."' or 
tel_2_ref_3 regexp '".$find."' or 
tel_1_ref_4 regexp '".$find."' or 
tel_2_ref_4 regexp '".$find."' or 
tel_1_laboral regexp '".$find."' or 
tel_2_laboral regexp '".$find."' or 
tel_1_verif regexp '".$find."' or 
tel_2_verif regexp '".$find."' or 
tel_3_verif regexp '".$find."' or 
tel_4_verif regexp '".$find."' or 
telefonos_marcados regexp '".$find."')";    
    }
$result = mysql_query($querymain) or die(mysql_error());
$count = mysql_num_rows($result);
$numfields = mysql_num_fields($result);
header ("content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8" ?>';
echo "<xml>";
echo "<count>".$count."</count>";
while ($answer=mysql_fetch_row($result)) {
for ($i=0;$i<$numfields;$i++) {
if (ereg(strtoupper($find),strtoupper($answer[$i]))) {
echo "<val>".$answer[$i]."</val>";
}
}
}
echo "</xml>";
}
}
mysql_close($con);
?>
