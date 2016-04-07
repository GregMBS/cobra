<?php
$host = "localhost";
$user = "root";
$pwd = "DeathSta1";
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
$queryh='select c_cont,v_cc,c_cvst from historia join dictamenes on c_cvst=dictamen
where c_cvge="marci"';
$resulth=mysql_query($queryh);
while($answerh=mysql_fetch_row($resulth)) {
$c_cont=$answerh[0];
$v_cc=$answerh[1];
$c_cvst=$answerh[2];
$queryr='update resumen,dictamenes set status_aarsa="'.$c_cvst.'"
where id_cuenta='.$c_cont.' 
and status_aarsa=dictamen and v_cc>'.$v_cc.';';
echo $queryr."<br>";
}
}
}
mysql_close();
