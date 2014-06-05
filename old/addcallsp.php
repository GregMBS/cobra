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
$querygable="SELECT id_cuenta, numero_de_cuenta,tel_2,'greg',cliente
from resumen 
where (cliente='Provident')
and status_de_credito not like '%o'
and not exists (select * from historia 
where resumen.id_cuenta=historia.c_cont) and tel_2 <> ''
;";
$resultgable=mysql_query($querygable) or die(mysql_error());
while ($answergable=mysql_fetch_row($resultgable)) {
$C_CONT=$answergable[0];
$CUENTA=$answergable[1];
$TEL=$answergable[2];
//$C_CVGEa=array("veronica","francisco","alfonso","emilia","walter");
//$C_CVGE=$C_CVGEa[rand(0,4)];
$C_CVGE=$answergable[3];
$C_CVSTa=array('MENSAJE EN BUZON','MENSAJE EN BUZON','MENSAJE EN BUZON', 'MENSAJE EN BUZON');
$n=rand(0,3);
$C_CVST=$C_CVSTa[$n];
$C_OBSE1a=array($TEL.' SE DEJA MSJ EN BUZON','SE DEJA MSJ EN BUZON '.$TEL, $TEL.' SE DEJA MSJ EN BUZON', 'MARCA CEL '.$TEL.' Y DEJO MSG EN BUZON');
$C_OBSE1=$C_OBSE1a[$n];
$C_CVBA=$answergable[4];
//$D_FECHa=array("2011-04-18","2011-04-18");
//$D_FECH=$D_FECHa[rand(0,7)];
$FDATE=rand(0,5)+25;
$D_FECH="2011-04-".$FDATE;
$hour=0;
while ($hour==0) {
        $timebase=strtotime('09:00:00')+rand(0,4*60*60);
        $hour=date('H',$timebase);
        }
$C_HRIN=date('H:i:s',$timebase);
$C_HRFI=date('H:i:s',$timebase);
$C_MSGE='X';
$C_ACCION='LLAMADA A DOMICILIO';

$qins = "INSERT INTO historia (C_CVBA, C_TELE, C_CVGE, C_MSGE, C_CONT, C_CVST, D_FECH, C_HRIN, C_HRFI, CUENTA, C_ACCION, C_OBSE1) 
VALUES ('".$C_CVBA."', '".
$TEL."', '".
$C_CVGE."', '".
$C_MSGE."', '".
$C_CONT."', '".
$C_CVST."', '".
$D_FECH."', '".
$C_HRIN."', '".
$C_HRFI."', '".
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
