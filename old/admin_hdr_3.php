<?php 
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");
$host = "localhost";
$user = "admin";
$pswd = "AwRats";
$db = "robot";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pswd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$ticket=mysql_real_escape_string($_COOKIE['auth']);
if (!empty($_GET['capt'])) 
{
    $capt = mysql_real_escape_string($_GET['capt']);
}
if (!empty($_POST['capt'])) 
{
    $capt = mysql_real_escape_string($_POST['capt']);
}
$querycheck="SELECT count(1) FROM cobra4.nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."' AND tipo='admin';";
$resultcheck=mysql_query($querycheck);
?>
