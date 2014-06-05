<?php
$host = "localhost";
$user = "cobra";
$pwd = "aarsa";
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
$querygable="SELECT c_cont,auto,c_tele from historia where c_obse1='greg oops';";
$resultgable=mysql_query($querygable) or die(mysql_error());
while ($answergable=mysql_fetch_row($resultgable)) {
$C_CONT=$answergable[0];
$AUTO=$answergable[1];
$TEL=$answergable[2];
$C_CVSTa=array('TEL OCUPADA O NO CONTESTA','MENSAJE EN CONTESTADORA','TEL OCUPADA O NO CONTESTA','MENSAJE EN CONTESTADORA');
$n=rand(0,3);
$C_CVST=$C_CVSTa[$n];
$C_OBSE1a=array('SE MARCA TEL '.$TEL.' Y NO CONTESTA',$TEL.' SE DEJA MSJ EN CONTESTADORA','SE MARCA TEL '.$TEL.'. TEL OCUPADO',$TEL.' SE DEJA MSJ EN BUZON');
$C_OBSE1=$C_OBSE1a[$n];
$qins = "update historia 
set c_tele='".$TEL."', c_cvst='".$C_CVST."', c_obse1='".$C_OBSE1."'
where auto=".$AUTO.";";
$queryins=str_replace(';',' ',$qins);
echo $queryins.";<br>";
//echo "UPDATE resumen SET status_aarsa='TEL OCUPADA O NO CONTESTA' WHERE id_cuenta='".$C_CONT."';<br>";
}
}
}
mysql_close();
