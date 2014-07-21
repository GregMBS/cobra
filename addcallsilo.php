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
$querygable="SELECT id_cuenta, numero_de_cuenta,tel_1
from resumen 
where status_de_credito not like '%o' 
and cliente='provident' and status_aarsa ='';";
$resultgable=mysql_query($querygable) or die(mysql_error());
while ($answergable=mysql_fetch_row($resultgable)) {
for ($i=0;$i<1;$i++) {
$C_CONT=$answergable[0];
$CUENTA=$answergable[1];
$TEL=$answergable[2];
//$C_CVGEa=array("jessica","lucio","victor","francisco","miriam","veronica","walter",'alfonso','juan','angel');
$C_CVGE='greg';
//$C_CVSTa=array('TEL OCUPADA O NO CONTESTA','MENSAJE EN CONTESTADORA','TEL OCUPADA O NO CONTESTA','MENSAJE EN CONTESTADORA');
$C_CVST='ILOCALIZABLE TELEFONICO';
//$n=rand(0,3);
//$C_CVST=$C_CVSTa[$n];
$C_OBSE1='NO HAY TELEFONOS PARA MARCAR';
$C_CVBA='Provident';
//$D_FECHa=array("2009-10-25","2009-10-26","2009-10-27","2009-10-28","2009-10-29");
//$D_FECH=$D_FECHa[rand(0,4)];
$D_FECH='2011-04-30';
$hour=0;
while ($hour==0) {
        $timebase=strtotime('14:00:00')+rand(0,8*60*60);
        $hour=date('H',$timebase);
        }
$C_HRIN=date('H:i:s',$timebase);
$C_HRFI=date('H:i:s',$timebase);
$C_MSGE='';
$C_CNP='Ilocalizable';
$C_ACCION='LLAMADA A DOMICILIO';

$qins = "INSERT INTO historia (C_CVBA, C_TELE, C_CVGE, C_MSGE, C_CONT, C_CVST, D_FECH, C_HRIN, C_HRFI, CUENTA, C_ACCION, C_CNP, C_OBSE1) 
VALUES ('".$C_CVBA."', '".
$TEL."', '".
$C_CVGE."', '".
$C_MSGE."', '".
$C_CONT."', '".
$C_CVST."', date('".
$D_FECH."'), '".
$C_HRIN."', '".
$C_HRFI."', '".
$CUENTA."', '".
$C_ACCION."', '".
$C_CNP."', '".
$C_OBSE1."')";
$queryins=str_replace(';',' ',$qins);
echo $queryins.";<br>";
//echo "UPDATE resumen SET status_aarsa='ILOCALIZABLE TELEFONICO' WHERE id_cuenta='".$C_CONT."';<br>";
}
}
}
}
mysql_close();
