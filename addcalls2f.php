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
$querygable="SELECT id_cuenta, numero_de_cuenta,tel_1_ref_1,ejecutivo_asignado_call_center
from resumen 
where cliente='Credito Si'
and fecha_de_actualizacion>'2010-11-01'
and not exists (select * from historia where c_cont=id_cuenta and d_fech>='2010-11-01');";
$resultgable=mysql_query($querygable) or die(mysql_error());
while ($answergable=mysql_fetch_row($resultgable)) {
$C_CONT=$answergable[0];
$CUENTA=$answergable[1];
$TEL=$answergable[2];
$querysub="select c_tele,c_cvst,ucase(c_obse1),c_cvge from historia 
where c_cont=".$C_CONT." and n_prom=0 and c_cvge<>'Milt' and c_visit is null
and q(c_cvst)='SIN CONTACTOS' 
 LIMIT 1
";
//$resultsub=mysql_query($querysub) or die(mysql_error());
//while ($answersub=mysql_fetch_row($resultsub)) {
//$TEL=$answersub[0];
//$C_CVGEa=array("veronica","francisco","alfonso","emilia","walter");
//$C_CVGE=$C_CVGEa[rand(0,4)];
$C_CVGE=$answergable[3];
if ($C_CVGE=='sinasig') {$C_CVGE='eduardo';};
//$C_CVST=$answersub[1];
$C_CVST='TEL OCUPADA O NO CONTESTA';
$C_CVBA='Credito Si';
//$D_FECHa=array("2010-06-14","2010-06-17");
$day=rand(0,3)+11;
$D_FECH="2010-11-".$day;
$C_OBSE=$TEL." NO CONTESTA";
$hour=14;
while ($hour==14)  {
        $timebase=strtotime('8:00:00')+rand(0,12*60*60);
        $hour=date('H',$timebase);
        }
while ($hour==14) {
        $timebase=strtotime('8:00:00')+rand(0,6*60*60);
        $hour=date('H',$timebase);
        }
$CKD=chr(65+(date('H',$timebase)+date('i',$timebase)+date('s',$timebase))%32);
$C_OBSE1=$C_OBSE.$CHD;
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
mysql_close();
