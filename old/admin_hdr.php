<?php 
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");
$host = "localhost";
$user = "root";
$pswd = "DeathSta1";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pswd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_REQUEST['capt']);
$querycheck="SELECT count(1) FROM nombres 
WHERE ticket='".$ticket."' 
AND iniciales='".$capt."'
AND (tipo='admin' OR tipo='supervisor')
;";
$resultcheck=mysql_query($querycheck);
?>
