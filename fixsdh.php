<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra";
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
$queryh='select auto,c_cont,cuenta,c_cvba from historia 
where c_cont not in (select id_cuenta from resumen) and c_cont>0 
';
$resulth=mysql_query($queryh);
while($answerh=mysql_fetch_row($resulth)) {
$c_cont=$answerh[1];
$auto=$answerh[0];
$cuenta=$answerh[2]+0;
$cliente=$answerh[3];
$querya="update resumen,historia
set c_cont=id_cuenta   
where auto=".$auto."
and cliente='".$cliente."' and numero_de_cuenta+0 =".$cuenta;
echo $querya.";<br>";
}
}
}
mysql_close();
