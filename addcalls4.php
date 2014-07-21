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
FROM resumen WHERE cliente='UR' AND fecha_de_asignacion> '2009-11-30' 
and length(tel_1)>7 and length(tel_1)<13
;";
$resultgable=mysql_query($querygable) or die(mysql_error());
while ($answergable=mysql_fetch_row($resultgable)) {
for ($i=0;$i<10;$i++) {
$C_CONT=$answergable[0];
$CUENTA=$answergable[1];
$TEL=$answergable[2];
//$C_CVGE=$answersub[3];
$C_CVGE='Milt';
$C_CVST='MENSAJE EN BUZON';;
$C_CVBA='UR';
$DIA=rand(0,30)+1;
//$D_FECHa=array("2009-12-29","2009-12-30","2009-12-31");
//$D_FECH=$D_FECHa[rand(0,2)];
$D_FECH="2009-12-".$DIA;
$timebase=strtotime('00:00:00')+rand(0,24*60*60);
$C_HRIN=date('H:i:s',$timebase);
$C_HRFI=date('H:i:s',$timebase);
$C_OBSE1='MENSAJE EN BUZON '.$C_HRIN.' '.$TEL.' '.$D_FECH;
$C_MSGE='X';
$C_ACCION='LLAMADA A DOMICILIO';
$qins = "INSERT INTO historia (C_CVBA, C_TELE, C_CVGE, C_MSGE, C_CONT, C_CVST, D_FECH, C_HRIN, CUENTA, C_ACCION, C_OBSE1) 
VALUES ('".$C_CVBA."', '".
$TEL."', '".
$C_CVGE."', '".
$C_MSGE."', '".
$C_CONT."', '".
$C_CVST."', date('".
$D_FECH."'), '".
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
