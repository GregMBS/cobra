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
$querygable="select h1.* from historia h1,resumen 
where id_cuenta=c_cont
and d_fech>='2011-01-01'
and n_prom>0 
and not exists (select * from historia h2 where h1.c_cont=h2.c_cont and h2.auto>h1.auto and h2.n_prom>0)
and status_aarsa='PROMESA INCUMPLIDA'
and cliente='Credito Si'
and status_de_credito not like '%o'";
$resultgable=mysql_query($querygable) or die(mysql_error());
while ($answergable=mysql_fetch_array($resultgable)) {
$C_CONT=$answergable[3];
$CUENTA=$answergable[10];
$C_TELE=$answergable[8];
$C_CVGE=$answergable[1];
$C_CVST='CLIENTE NEGOCIANDO';
$C_CVBA='Credito Si';
$D_FECH="2011-01-27";
$N_PROM1=$answergable['N_PROM1']+$answergable['N_PROM2'];
$N_PROM=$N_PROM1;
$N_PROM2=0;
$D_PROM1a=array("2011-01-29","2011-01-31");
$D_PROM1=$D_PROM1a[rand(0,1)];
$D_PROM=$D_PROM1;
$D_PROM2='0000-00-00';
$C_CARG==$answergable[18];
$C_CNP==$answergable[30];
$C_OBSE1=$answergable[11];
        $timebase=strtotime('9:00:00')+rand(0,10*60*60);
        $hour=date('H',$timebase);
$C_HRIN=date('H:i:s',$timebase);
$C_HRFI=date('H:i:s',$timebase);
$C_MSGE='X';
$C_ACCION='LLAMADA A DOMICILIO';
$qins = "INSERT INTO historia (C_CVBA, C_CVGE, C_MSGE, C_CONT, C_CVST, 
D_FECH, C_HRIN, CUENTA, C_ACCION, C_TELE, N_PROM, N_PROM1, N_PROM2, 
D_PROM, D_PROM1, D_PROM2, C_CARG, C_CNP, C_OBSE1) 
VALUES ('".$C_CVBA."', '".
$C_CVGE."', '".
$C_MSGE."', '".
$C_CONT."', '".
$C_CVST."', '".
$D_FECH."', '".
$C_HRIN."', '".
$CUENTA."', '".
$C_ACCION."', '".
$C_TELE."', '".
$N_PROM."', '".
$N_PROM1."', '".
$N_PROM2."', '".
$D_PROM."', '".
$D_PROM1."', '".
$D_PROM2."', '".
$C_CARG."', '".
$C_CNP."', '".
$C_OBSE1."')";
$queryins=str_replace(';',' ',$qins);
echo $queryins.";<br>";
//echo "UPDATE resumen SET status_aarsa='TEL OCUPADA O NO CONTESTA' WHERE id_cuenta='".$C_CONT."';<br>";
}
}
}
mysql_close();
