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
from resumen 
where 
not exists (select c_cont from historia 
where resumen.id_cuenta=historia.c_cont 
and d_fech>='2011-03-01' and c_cvba='Surtidor del Hogar'
)
and exists (select c_cont from historia 
where resumen.id_cuenta=historia.c_cont 
and d_fech<='2011-01-31' and c_cvba='Surtidor del Hogar' and c_carg='')
and cliente='Surtidor del Hogar' and status_de_credito not like '%o'
limit 27
";
$resultgable=mysql_query($querygable) or die(mysql_error());
while ($answergable=mysql_fetch_row($resultgable)) {
$C_CONT=$answergable[0];
$CUENTA=$answergable[1];
$querysub="select c_tele,c_cvst,ucase(c_obse1),c_cvge from historia 
where c_cont=".$C_CONT." and n_prom=0 and c_cvge<>'Milt' and c_visit is null
and d_fech<='2011-01-31' and q(c_cvst)='SIN CONTACTOS'
and length(c_tele) in (8,10) and c_tele not regexp '[a-z]'
 LIMIT 1
";
$resultsub=mysql_query($querysub) or die(mysql_error());
while ($answersub=mysql_fetch_row($resultsub)) {
$TEL=$answersub[0];
$C_CVGEa=array("greg","greg");
$C_CVGE=$C_CVGEa[rand(0,1)];
$C_CVGE=$answergable[3];
$C_CVST=$answersub[1];
$C_CVBA='Surtidor del Hogar';
$D_FECHa=array("2011-03-11","2011-03-11","2011-03-11");
$D_FECH=$D_FECHa[rand(0,2)];
$C_OBSE=$answersub[2];
        $timebase=strtotime('9:00:00')+rand(0,10*60*60);
        $hour=date('H',$timebase);
$CKD=chr(65+(date('H',$timebase)+date('i',$timebase)+date('s',$timebase))%32);
$C_OBSE1=$C_OBSE.$CHD;
$C_HRIN=date('H:i:s',$timebase);
$C_HRFI=date('H:i:s',$timebase);
$C_MSGE='X';
$C_ACCION='LLAMADA A DOMICILIO';
$qins = "INSERT INTO historia (C_CVBA, C_CVGE, C_TELE, C_MSGE, C_CONT, C_CVST, D_FECH, C_HRIN, CUENTA, C_ACCION, C_OBSE1) 
VALUES ('".$C_CVBA."', '".
$C_CVGE."', '".
$TEL."', '".
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
mysql_close();
