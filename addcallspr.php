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
$querygable="SELECT id_cuenta, numero_de_cuenta,tel_1,ejecutivo_asignado_call_center,cliente
from resumen 
where fecha_de_actualizacion>='2010-03-01' and cliente='Prestamo Relampago' 
and status_de_credito not like '%o'
and id_cuenta not in (select c_cont from historia where d_fech>'2010-03-01')
;";
$resultgable=mysql_query($querygable) or die(mysql_error());
while ($answergable=mysql_fetch_row($resultgable)) {
for ($i=0;$i<1;$i++) {
$C_CONT=$answergable[0];
$CUENTA=$answergable[1];
$TEL=$answergable[2];
//$C_CVGEa=array("veronica","francisco","alfonso","emilia","walter");
//$C_CVGE=$C_CVGEa[rand(0,4)];
$C_CVGE=$answergable[3];
$C_CVSTa=array('TEL OCUPADA O NO CONTESTA','MENSAJE EN CONTESTADORA','MENSAJE EN CONTESTADORA','TEL OCUPADA O NO CONTESTA','MENSAJE EN CONTESTADORA');
$n=rand(0,4);
$C_CVST=$C_CVSTa[$n];
$C_OBSE1a=array('SE MARCA TEL '.$TEL.' Y NO CONTESTA',$TEL.' SE DEJA MSJ EN CONTESTADORA','SE DEJA MSJ EN CONTESTADORA '.$TEL,'SE MARCA TEL '.$TEL.'. TEL OCUPADO',$TEL.' SE DEJA MSJ EN BUZON');
$C_OBSE1=$C_OBSE1a[$n];
$C_CVBA=$answergable[4];
$D_FECHa=array("2010-03-07","2010-03-08","2010-03-09","2010-03-10","2010-03-11","2010-03-12");
$D_FECH=$D_FECHa[rand(0,5)];
$hour=0;
while ($hour==0) {
        $timebase=strtotime('08:00:00')+rand(0,11*60*60);
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
}
mysql_close();
