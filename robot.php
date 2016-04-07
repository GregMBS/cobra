<?php  
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$attack=(!empty($_GET['auto']))||(!empty($_POST['auto']));
if ($attack) {die('ATTACK!');}
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_GET['capt']);
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."' AND tipo='admin';";
$resultcheck=mysql_query($querycheck);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$query="SELECT right(tel_1,8) from resumen 
WHERE cliente='Banco Amigo' 
AND status_de_credito='Castigado'
AND length(tel_1)=10
AND tel_1 LIKE '81%'
AND status_aarsa LIKE 'NEGATIVA %'";
$result=mysql_query($query) or die(mysql_error());
 while ($answer = mysql_fetch_row($result)) { 
$TEL=$answer[0];
$COMD="vm shell -c u -S /usr/bin/perl /home/gmbs/call.pl ".$TEL." /home/gmbs/ba.rmd\n";
echo $COMD;
exec ($COMD);
}
}
}
mysql_close()
 ?>
