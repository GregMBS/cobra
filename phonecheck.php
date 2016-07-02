<?php
$host = "localhost";
$user = "root";
$pwd = "DeathSta1";
$db = "cobrajdlr";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pwd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_GET['capt']);
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."' AND tipo='admin';";
$resultcheck=mysql_query($querycheck);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$output="";
require "AsteriskManager.php";
$params = array('server' => '192.168.1.60', 'port' => '5038');
$ast = new Net_AsteriskManager($params);
    try {
        $ast->connect();
    } catch (PEAR_Exception $e) {
    echo $e;
    }
    try {
	$ast->login('phpagi','phpagi');
    } catch(PEAR_Exception $e) {
    echo $e;
    }
     try {
        $output=$ast->command('core show channels verbose');
        } catch(PEAR_Exception $e) {
        echo $e;
    }
     }
     ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Phones</title>
<meta http-equiv="refresh" content="15">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
</head>
<body>
<pre style="font-size:7pt;">
<?php
print_r($output);
?>
</pre>
</body>
</html>
<?php
}
mysql_close($con);
?>

