<?php 
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");
$host = "localhost";
$user = "root";
$pswd = "4sale";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pswd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$ticket=mysql_real_escape_string($_COOKIE['auth']);
if (!empty($_REQUEST['capt'])) 
{
    $capt = mysql_real_escape_string($_REQUEST['capt']);
}
if (empty($capt)) {print_r($_REQUEST);die();}
$querycheck="SELECT count(1),tipo FROM nombres WHERE ticket='".$ticket."' 
AND iniciales='".$capt."' AND (tipo='cliente' OR tipo='admin')
group by tipo;";
$resultcheck=mysql_query($querycheck);
?>
