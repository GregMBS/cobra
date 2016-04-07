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
$querygable="SELECT id_cuenta, numero_de_cuenta,tel_1,ejecutivo_asignado_call_center,
cliente,
status_de_credito regexp 'o',fecha_de_ultimo_pago+interval 1 day,
fecha_de_ultimo_pago,monto_ultimo_pago
FROM resumen 
where id_cuenta in (select c_cont from losconfs)
and id_cuenta not in 
(select c_cont from historia where c_cvst like 'PAGO %')
and fecha_de_ultimo_pago>'2009-11-30'
;";
$resultgable=mysql_query($querygable) or die(mysql_error());
while ($answergable=mysql_fetch_row($resultgable)) {
for ($i=0;$i<1;$i++) {
$C_CONT=$answergable[0];
$CUENTA=$answergable[1];
$TEL='Entrante';
//$C_CVGEa=array("veronica","francisco","alfonso","emilia","walter");
//$C_CVGE=$C_CVGEa[rand(0,4)];
$C_CVGE=$answergable[3];
$SC=$answergable[5];
$FP=$answergable[7];
$MP=$answergable[8];
if ($SC==0) {$C_CVST='PAGO PARCIAL';} else {$C_CVST='PAGO TOTAL';}
$C_OBSE1="DIJO QUE YA PAGO ".$MP." ".$FP;
$C_CVBA=$answergable[3];
//$D_FECHa=array("2009-11-06","2009-11-07","2009-11-08","2009-11-09","2009-11-10","2009-11-11");
//$D_FECH=$D_FECHa[rand(0,5)];
$D_FECH=$answergable[6];
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
