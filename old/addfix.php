<?php
$host = "localhost";
$user = "cobra4";
$pwd = "aarsa";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
	 set_time_limit(300);
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_GET['capt']);
$tcapt=$capt;
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."' AND tipo='admin';";
$resultcheck=mysql_query($querycheck);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querygable="SELECT auto,d_fech,hour(c_hrin) from historia where d_fech>='2011-02-01'
and c_cvge='eduardo' and c_msge='X';";
$resultgable=mysql_query($querygable) or die(mysql_error());
while ($answergable=mysql_fetch_row($resultgable)) {
$auto=$answergable[0];
$d_fech=$answergable[1];
$hr=$answergable[2];
$querynew="SELECT c_cvge from historia where d_fech='".$d_fech."' 
and hour(c_hrin)=".$hr." and c_msge is null order by rand() limit 1";
$resultnew=mysql_query($querynew) or die(mysql_error());
while ($answernew=mysql_fetch_row($resultnew)) {
$name=$answernew[0];
$qu = "UPDATE historia set c_cvge='".$name."' where auto=".$auto;
$queryu=str_replace(';',' ',$qu);
echo $queryu.";<br>";
//echo "UPDATE resumen SET status_aarsa='TEL OCUPADA O NO CONTESTA' WHERE id_cuenta='".$C_CONT."';<br>";
}
}
}
}
mysql_close();
