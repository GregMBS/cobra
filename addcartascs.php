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
$querygable="SELECT id_cuenta, numero_de_cuenta, 
domicilio_deudor, colonia_deudor, ciudad_deudor, 
(ciudad_deudor in (select ciudad from locales)) as metro,
saldo_total,cliente
FROM resumen 
where cliente regexp 'Credito si ' and domicilio_deudor<>''
and status_aarsa=''
and status_de_credito not like '%o';";
$resultgable=mysql_query($querygable) or die(mysql_error());
while ($answergable=mysql_fetch_row($resultgable)) {
$C_CONT=$answergable[0];
$CUENTA=$answergable[1];
$CALLE=$answergable[2];
$COLONIA=$answergable[3];
$CIUDAD=$answergable[4];
$C_CVBA=$answergable[7];
$C_CVGE='edgar';
$C_VISIT='edgar';
$C_CVST='SE MANDO CARTA';
$C_OBSE1='SE MANDO CARTA A '.$CALLE.', '.$COLONIA.', '.$CIUDAD;
$datebase = array("2011-09-15", "2011-09-15", "2011-09-15");
$D_FECH=$datebase[rand(0,2)];
$timebase=strtotime('18:00:00');
$C_HRIN=date('H:i:s',$timebase);
$C_MSGE='X';

$qins = "INSERT INTO historia (C_CVBA,C_CVGE,C_MSGE,C_CONT,C_CVST,D_FECH,C_HRIN,CUENTA,C_OBSE1) 
VALUES ('".$C_CVBA."','".
$C_CVGE."','".
$C_MSGE."','".
$C_CONT."','".
$C_CVST."',date('".
$D_FECH."'),'".
$C_HRIN."','".
$CUENTA."','".
$C_OBSE1."')";
$queryins=str_replace(';',' ',$qins);
echo $queryins.";<br>";
}
}
}
mysql_close();
