<?php 
$host = "localhost";
$user = "root";
$pwd = "DeathSta1";
$db = "cobra4";
$con = new mysqli($host, $user, $pwd, $db) or die("ERROR UHM1 - ".mysqli_error($con));
	 set_time_limit(300);
$ticket=mysqli_real_escape_string($con,$_COOKIE['auth']);
$mytipo='';
if (!empty($_REQUEST['capt'])) 
{
    $capt=mysqli_real_escape_string($con,$_REQUEST['capt']);
}
$queryg = "SELECT usuaria,tipo FROM nombres 
WHERE tipo='admin' 
AND iniciales = '$capt'
AND ticket = '$ticket';";
$resultg = mysqli_query($con,$queryg) or die("ERROR UHM2 - ".mysqli_error($con));
while($answerg = mysqli_fetch_row($resultg)) {
	$mynombre=$answerg[0];
	$mytipo=$answerg[1];
}
if ($mytipo=='') {
	$page="Location: index.php";
	header($page);
}


