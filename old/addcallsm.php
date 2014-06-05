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
$querygable="SELECT id_cuenta, numero_de_cuenta,tel_1,ejecutivo_asignado_call_center
from resumen join dictamenes on dictamen=status_aarsa
join nombres on ejecutivo_asignado_call_center=usuaria
where month(fecha_de_asignacion)=10 
and month(fecha_de_actualizacion)=11 
and turno='matutino'
and (status_de_credito='270s' or status_de_credito = '360s')
and cliente='Credito Si'
order by rand() limit 300;";
$resultgable=mysql_query($querygable) or die(mysql_error());
while ($answergable=mysql_fetch_row($resultgable)) {
for ($i=0;$i<1;$i++) {
$C_CONT=$answergable[0];
$CUENTA=$answergable[1];
for ($i=0;$i<1;$i++) {
$querysub="select c_tele,c_cvst,ucase(c_obse1),c_cvge from historia 
where c_cont=".$C_CONT." and n_prom=0 and c_cvge<>'Milt' and c_cvst<>'CLIENTE NEGOCIANDO'
and c_cvst not like 'PAG%' and month(d_fech)<11
and c_obse1 not regexp 'manana' and c_accion regexp 'LLAMADA'
and c_obse1 not regexp 'marce'
order by rand() limit 1";
$resultsub=mysql_query($querysub) or die(mysql_error());
while ($answersub=mysql_fetch_row($resultsub)) {
$TEL=$answersub[0];
//$C_CVGEa=array("veronica","francisco","alfonso","emilia","walter");
//$C_CVGE=$C_CVGEa[rand(0,4)];
$C_CVGE=$answergable[3];
$C_CVST=$answersub[1];;
$C_OBSE1=$answersub[2];
$C_CVBA='Credito Si';
//$D_FECHa=array("2009-11-01","2009-11-02","2009-11-03","2009-11-04");
//$D_FECH=$D_FECHa[rand(0,3)];
$D_FECH="2009-11-05";
$hour=14;
while ($hour==14) {
        $timebase=strtotime('8:00:00')+rand(0,6*60*60);
        $hour=date('H',$timebase);
        }
$C_HRIN=date('H:i:s',$timebase);
$C_HRFI=date('H:i:s',$timebase);
$C_MSGE='X';
$C_ACCION='LLAMADA A DOMICILIO';
$qins = "INSERT INTO historia (C_CVBA, C_CVGE, C_MSGE, C_CONT, C_CVST, D_FECH, C_HRIN, CUENTA, C_ACCION, C_OBSE1) 
VALUES ('".$C_CVBA."', '".
$C_CVGE."', '".
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
}
}
}
mysql_close();
