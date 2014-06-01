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
$querygable="SELECT id_cuenta, numero_de_cuenta,status_de_credito,ejecutivo_asignado_call_center
FROM resumen WHERE cliente='Credito Si' and status_de_credito like '%0s'
AND fecha_ultima_gestion<'2009-10-01' and fecha_de_actualizacion>'2009-10-01'
AND id_cuenta in (SELECT c_cont
from historia  
where c_cvst like 'Mensaje con%' and month(d_fech) between 7 and 8 
and c_msge is null and cliente='credito si' and c_obse1 not regexp 'manana' 
and c_accion regexp 'LLAMADA'
and c_obse1 not regexp 'marce'
);";
$resultgable=mysql_query($querygable) or die(mysql_error());
while ($answergable=mysql_fetch_row($resultgable)) {
$C_CONT=$answergable[0];
$CUENTA=$answergable[1];
for ($i=0;$i<4;$i++) {
$querysub="select c_tele,c_cvst,ucase(c_obse1),c_cvge from historia 
where c_cont=".$C_CONT." and c_cvst like 'Mensaje con%'
and month(d_fech) between 7 and 8
and c_obse1 not regexp 'manana' and c_accion regexp 'LLAMADA'
and c_obse1 not regexp 'marce'
order by rand() limit 1";
$resultsub=mysql_query($querysub) or die(mysql_error());
while ($answersub=mysql_fetch_row($resultsub)) {
$TEL=$answersub[0];
//$C_CVGE=$answersub[3];
$C_CVGEa=array("jessica","lucio","victor","francisco","miriam","veronica","walter",'alfonso','juan','angel');
$C_CVGE=$C_CVGEa[rand(0,9)];
$C_CVST=$answersub[1];;
$C_OBSE1=$answersub[2];
$C_CVBA='Credito Si';
$C_CNPa=array("Desempleado","Múltiples Deudas","Problemas Familiares");
$C_CNP=$D_FECHa[rand(0,2)];
//$D_FECHa=array("2009-09-14","2009-09-15","2009-09-16","2009-09-17","2009-09-18","2009-09-19","2009-09-20");
//$D_FECH=$D_FECHa[rand(0,6)];
$D_FECH="2009-10-25";
$hour=14;
while ($hour==14) {
        $timebase=strtotime('8:00:00')+rand(0,12*60*60);
        $hour=date('H',$timebase);
        }
$C_HRIN=date('H:i:s',$timebase);
$C_HRFI=date('H:i:s',$timebase+rand(0,5*60)+2*60);
$C_MSGE='X';
$C_ACCION='LLAMADA A DOMICILIO';
$qins = "INSERT INTO ghosts (C_CVBA, C_CVGE, C_MSGE, C_CONT, C_CVST, D_FECH, C_HRIN, C_HRFI, CUENTA, C_ACCION, C_CNP, C_TELE, C_OBSE1) 
VALUES ('".$C_CVBA."', '".
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
$TEL."', '".
$C_OBSE1."')";
$queryins=str_replace(';',' ',$qins);
echo $queryins.";<br>";
//echo "UPDATE resumen SET status_aarsa='TEL OCUPADA O NO CONTESTA' WHERE id_cuenta='".$C_CONT."';<br>";
}
}
}
}
}
mysql_close();
