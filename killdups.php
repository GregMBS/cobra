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
$capt=mysql_real_escape_string($_REQUEST['capt']);
$tcapt=$capt;
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."' AND tipo='admin';";
$resultcheck=mysql_query($querycheck);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$query1="truncate prdups;";
$query2="insert into prdups select numero_de_cuenta from resumen
group by cliente,numero_de_cuenta,numero_de_credito 
having count(1)>1;";
$query3="delete from resumen 
where cliente='prestamo Relampago' 
and numero_de_cuenta in (select numero_de_cuenta from prdups) 
and id_cuenta not in (select c_cont from historia)
limit 1;";
for ($i=0;$i<1690;$i++) {
mysql_query($query1) or die(mysql_error());
mysql_query($query2) or die(mysql_error());
mysql_query($query3) or die(mysql_error());
}
}
}
mysql_close();
