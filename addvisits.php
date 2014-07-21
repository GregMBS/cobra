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
saldo_total,curdate()-interval 26 day+interval (14+rand()*4) day
FROM resumen 
where cliente='FISA' and domicilio_deudor<>''
and status_aarsa in ('TEL NO EXISTE')
and ciudad_deudor in (select ciudad from locales)
limit 50
; ";
$resultgable=mysql_query($querygable) or die(mysql_error());
while ($answergable=mysql_fetch_row($resultgable)) {
$C_CONT=$answergable[0];
$CUENTA=$answergable[1];
$CALLE=$answergable[2];
$COLONIA=$answergable[3];
$CIUDAD=$answergable[4];
$SALDO=$answergable[6];
$C_CVGE='gmbs';
$C_VISIT='edgar';
$rn=rand(0,2);
$C_CVSTa=array('NOTIFICACION BAJO PUERTA','NOTIFICACION CON TERCERO','NOTIFICACION CON TERCERO');
$C_CVST=$C_CVSTa[$rn];
$C_OBSE1a=array('SE DEJE AVISE EN '.$CALLE.', '.$COLONIA.', '.$CIUDAD,
'SE DEJE NOTA CON VECINO. TITULAR VA A REGRESAR MUY TARDE',
'SE DEJE AVISO CON VECINO.');
$C_OBSE1=$C_OBSE1a[$rn];
//$D_FECHa=array("2010-12-02","2010-12-01","2010-12-03","2010-12-04","2010-12-05","2010-12-06");
//$D_FECH=$D_FECHa[rand(0,5)];
$D_FECH=$answergable[7];
$C_CVBA='FISA';
$timebase=strtotime('08:00:00')+rand(0,11*60*60);
$C_HRIN=date('H:i:s',$timebase);
$C_HRFI=date('H:i:s',$timebase);
$C_MSGE='X';

$qins = "INSERT INTO historia (C_CVBA,c_visit,C_CVGE,C_MSGE,C_CONT,C_CVST,D_FECH,C_HRIN,C_HRFI,CUENTA,C_OBSE1) 
VALUES ('".$C_CVBA."','".
$C_VISIT."','".
$C_CVGE."','".
$C_MSGE."','".
$C_CONT."','".
$C_CVST."',date('".
$D_FECH."'),'".
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
