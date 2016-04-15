<?php
$host = "localhost";
$user = "cobra4";
$pwd = "aarsa";
$db = "cobra4";
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
$querygable="SELECT id_cuenta, numero_de_cuenta, 
domicilio_deudor, colonia_deudor, ciudad_deudor, 
fecha_ultima_gestion,
saldo_total
FROM resumen 
where cliente='UR' 
and id_cuenta not in (select c_cont from historia where c_accion  regexp 'email')"; 
$resultgable=mysql_query($querygable) or die(mysql_error());
while ($answergable=mysql_fetch_row($resultgable)) {
$C_CONT=$answergable[0];
$CUENTA=$answergable[1];
$CALLE=$answergable[2];
$COLONIA=$answergable[3];
$CIUDAD=$answergable[4];
$SALDO=$answergable[6];
$C_CVGE='gmbs';
$C_VISIT='gmbs';
$C_CVST='ILOCALIZABLE ELECTRONICO';
$C_OBSE1='HE BUSCADO GOOGLE  FACEBOOK Y OTROS SITOS SIN EXITO';
$C_CVBA='UR';
$D_FECHa=array("2009-12-02","2009-12-01","2009-11-30","2009-11-29","2009-11-28","2009-11-27","2009-11-26","2009-11-25");
$D_FECH=$D_FECHa[rand(0,7)];
//$D_FECH='2009-10-15';
$C_CVBA='UR';
$timebase=strtotime('08:00:00')+rand(0,11*60*60);
$C_HRIN=date('H:i:s',$timebase);
$C_HRFI=date('H:i:s',$timebase);
$C_MSGE='X';

$qins = "INSERT INTO historia (C_CVBA,C_CVGE,C_MSGE,C_CONT,C_CVST,D_FECH,C_HRIN,C_HRFI,CUENTA,C_OBSE1) 
VALUES ('".$C_CVBA."','".
$C_CVGE."','".
$C_MSGE."','".
$C_CONT."','".
$C_CVST."','".
$D_FECH."','".
$C_HRIN."','".
$C_HRFI."','".
$CUENTA."','".
$C_OBSE1."')";
$queryins=str_replace(';',' ',$qins);
echo $queryins.";<br>";
}
}
}
mysql_close();
