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
$querygable="SELECT id_cuenta from resumen 
where fecha_de_actualizacion>='2010-11-01' and cliente='Credito Si' 
and status_de_credito not like '%o'
and id_cuenta in (select c_cont from historia where d_fech<'2010-11-01' 
and c_visit is not null and n_prom=0)
;";
$resultgable=mysql_query($querygable) or die(mysql_error());
while ($answergable=mysql_fetch_row($resultgable)) {
$C_CONT=$answergable[0];
$CUENTA=$answergable[1];
$querysub="select 'karen', C_CVST, C_OBSE1, C_NSE, C_CNIV, C_CARG, 
C_CFAC, C_CPTA, C_RCON, C_CALLE1, C_CALLE2, 
C_CTIPO, C_COWN, C_CSTAT, C_CREJ, C_CPAT
 from historia 
where c_cont=".$C_CONT." and d_fech<'2010-11-01' 
and c_visit is not null and n_prom=0 LIMIT 1
";
$resultsub=mysql_query($querysub) or die(mysql_error());
while ($answersub=mysql_fetch_row($resultsub)) {
$C_CVGE=$answersub[0];
$C_CVST=$answersub[1];
$C_OBSE=$answersub[2];
$C_NSE=$answersub[3];
$C_CNIV=$answersub[4];
$C_CARG=$answersub[5];
$C_CFAC=$answersub[6];
$C_CPTA=$answersub[7];
$C_RCON=$answersub[8];
$C_CALLE1=$answersub[9];
$C_CALLE2=$answersub[10];
$C_CTIPO=$answersub[11];
$C_COWN=$answersub[12];
$C_CSTAT=$answersub[13];
$C_CREJ=$answersub[14];
$C_CPAT=$answersub[15];
$C_CVBA='Credito Si';
$C_VISITa=array("Edgar","Eduardo");
$C_VISIT=$C_VISITa[rand(0,1)];
$D_FECHa=array("2010-11-04","2010-11-05","2010-11-06","2010-11-07","2010-11-08","2010-11-09");
$D_FECH=$D_FECHa[rand(0,5)];
//$D_FECH="2009-06-29";
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
$C_ACCION='VISITA A DOMICILIO';
$qins = "INSERT INTO historia (C_CVBA, C_CVGE, C_MSGE, C_CONT, C_CVST, D_FECH, 
C_HRIN, CUENTA, C_ACCION, C_NSE, C_CNIV, C_CARG, 
C_CFAC, C_CPTA, C_RCON, C_CALLE1, C_CALLE2, 
C_CTIPO, C_COWN, C_CSTAT, C_CREJ, C_CPAT, C_OBSE1) 
VALUES ('".$C_CVBA."', '".
$C_CVGE."', '".
$C_MSGE."', '".
$C_CONT."', '".
$C_CVST."', '".
$D_FECH."', '".
$C_HRIN."', '".
$CUENTA."', '".
$C_ACCION."', '".
$C_NSE."', '".
$C_CNIV."', '".
$C_CARG."', '".
$C_CFAC."', '".
$C_CPTA."', '".
$C_RCON."', '".
$C_CALLE1."', '".
$C_CALLE2."', '".
$C_CTIPO."', '".
$C_COWN."', '".
$C_CSTAT."', '".
$C_CREJ."', '".
$C_CPAT."', '".
$C_OBSE1."')";
$queryins=str_replace(';',' ',$qins);
echo $queryins.";<br>";
//echo "UPDATE resumen SET status_aarsa='TEL OCUPADA O NO CONTESTA' WHERE id_cuenta='".$C_CONT."';<br>";
}
}
}
}
mysql_close();
