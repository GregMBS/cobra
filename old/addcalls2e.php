<?php
$host = "localhost";
$user = "cobra";
$pwd = "aarsa";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL ".$host);
mysql_query("USE $db",$con) or die ("Could not select $db database");
$host2 = "192.168.1.60:13306";
$user2 = "root";
$pwd2 = "ElastixMysql";
$db2 = "call_center";
$con2 = (mysql_connect($host2, $user2, $pwd2)) or die ("Could not connect to MySQL ".$host2);
mysql_query("USE $db2",$con2) or die ("Could not select $db2 database");
	 set_time_limit(300);
$ticket=mysql_real_escape_string($_COOKIE['auth'],$con);
$capt=mysql_real_escape_string($_GET['capt'],$con);
$tcapt=$capt;
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."' AND tipo='admin';";
$resultcheck=mysql_query($querycheck,$con);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querysub="select phone,value from call_attribute, calls c 
WHERE call_attribute.id_call=c.id 
AND c.`fecha_llamada`>'2011-06-01' AND c.`status`<>'success'
AND columna='id_cuenta'
 LIMIT 1
";
//die($querysub);
$resultsub=mysql_query($querysub,$con2) or die(mysql_error($con2));
while ($answersub=mysql_fetch_row($resultsub)) {
$TEL=$answersub[0];
$C_CONT=$answersub[1];
$querygable="SELECT id_cuenta, numero_de_cuenta,cliente
from resumen 
where 
id_cuenta not in (select c_cont from historia where d_fech>='2011-07-01')
and id_cuenta in (select c_cont from historia 
where d_fech<='2011-06-30')
and cliente regexp 'Credito Si' and status_de_credito not like '%o'
and id_cuenta=".$C_CONT;
$resultgable=mysql_query($querygable,$con) or die(mysql_error($con));
while ($answergable=mysql_fetch_row($resultgable)) {
$CUENTA=$answergable[1];
$cliente=$answergable[2];
$C_CVGEa=array("greg","edgar","lupita");
$C_CVGE=$C_CVGEa[rand(0,2)];
//$C_CVGE=$answergable[3];
$C_CVST='TEL SUSPENDIDO';
$C_CVBA=$cliente;
$D_FECHa=array("2011-07-12","2011-07-13","2011-06-11","2011-06-12","2011-06-13","2011-06-14","2011-06-13","2011-06-14");
$D_FECH=$D_FECHa[rand(0,1)];
$C_OBSE='';
        $timebase=strtotime('9:00:00')+rand(0,10*60*60);
        $hour=date('H',$timebase);
$CKD=chr(65+(date('H',$timebase)+date('i',$timebase)+date('s',$timebase))%32);
$C_OBSE1=$TEL.' CONMUTADOR DICE FUERA DE SERVICIO';;
$C_HRIN=date('H:i:s',$timebase);
$C_HRFI=date('H:i:s',$timebase);
$C_MSGE='P';
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
mysql_close($con2);
mysql_close($con);
