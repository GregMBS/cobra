<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$ticket=mysql_real_escape_string($_COOKIE['auth']);
     $local=$_SERVER['REMOTE_ADDR'];
set_time_limit(300);
$querycheck="SELECT gestor,nombres.tipo FROM nombres,userlog 
WHERE (usuario='".$local."' or usuario='".gethostbyaddr($local)."') 
and iniciales=gestor
and userlog.fechahora>curdate() order by fechahora desc limit 1;";
$resultcheck=mysql_query($querycheck) or die(mysql_error());
while ($answercheck=mysql_fetch_row($resultcheck)) {
$capt=$answercheck[0];
$mytipo=$answercheck[1];
if (empty($capt)) {
        $redirector = "Location: index.php";
        header($redirector);
}
if ($capt=='') {
        $redirector = "Location: index.php";
        header($redirector);
}
$qcamp="update nombres set camp=2 where iniciales='".$capt."';";
mysql_query($qcamp) or die(mysql_error());
$field='ID_CUENTA';
$find=mysql_real_escape_string ($_GET['find']);
$redirector = "Location: resumen-elastix.php?go=FROMBUSCAR&i=0&elastix=yes&field=id_cuenta&find=".$find."&capt=".$capt;
header($redirector);
}
mysql_close($con);
?>
</body>
</html> 
