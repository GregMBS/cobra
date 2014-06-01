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
$querygable="SELECT id_cuenta, cuenta, substring_index(c_obse1, ' ',1),c_obse1,c_cvst
from resumen,edgar2 
where 
cuenta=numero_de_cuenta and cliente='Credito Si'";
$resultgable=mysql_query($querygable) or die(mysql_error());
while ($answergable=mysql_fetch_row($resultgable)) {
$C_CONT=$answergable[0];
$CUENTA=$answergable[1];
$C_TELE=$answergable[2];
$C_OBSE1=$answergable[3];
$C_CVST=$answergable[4];
$C_CVGEa=array("gerardo","yolanda","alfredo","armando");
$C_CVGE=$C_CVGEa[rand(0,3)];
$C_CVBA='Credito Si';
$D_FECHa=array("2010-09-02","2010-09-03","2010-09-04","2010-09-05","2010-09-06","2010-09-07");
$D_FECH=$D_FECHa[rand(0,5)];
//$D_FECH="2009-06-29";
$hour=14;
while ($hour==14)  {
        $timebase=strtotime('8:00:00')+rand(0,12*60*60);
        $hour=date('H',$timebase);
        }
while ($hour==14) {
        $timebase=strtotime('8:00:00')+rand(0,6*60*60);
        $hour=date('H',$timebase);
        }
$C_HRIN=date('H:i:s',$timebase);
$C_HRFI=date('H:i:s',$timebase);
$C_MSGE='X';
$C_ACCION='LLAMADA A DOMICILIO';
$qins = "INSERT INTO historia (C_CVBA, C_CVGE, C_TELE, C_MSGE, C_CONT, C_CVST, D_FECH, C_HRIN, CUENTA, C_ACCION, C_OBSE1) 
VALUES ('".$C_CVBA."', '".
$C_CVGE."', '".
$C_TELE."', '".
$C_MSGE."', '".
$C_CONT."', '".
$C_CVST."', '".
$D_FECH."', '".
$C_HRIN."', '".
$CUENTA."', '".
$C_ACCION."', '".
$C_OBSE1."')";
$queryins=str_replace(';',' ',$qins);
echo $queryins.";<br>";
//echo "UPDATE resumen SET status_aarsa='TEL OCUPADA O NO CONTESTA' WHERE id_cuenta='".$C_CONT."';<br>";
}
}
}
mysql_close();
