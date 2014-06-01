<?php  
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$attack=(!empty($_REQUEST['auto']))||(!empty($_REQUEST['auto']));
if ($attack) {die('ATTACK!');}
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_REQUEST['capt']);
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."' AND tipo='admin';";
$resultcheck=mysql_query($querycheck);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$query="select Nombre_deudor, Numero_de_cuenta, c_cvst, c_cnp from resumen left join historia on id_cuenta=c_cont where cliente='Banco Amigo' AND c_cvst is not null;";
$result=mysql_query($query) or die(mysql_error());
 while ($answer = mysql_fetch_row($result)) { 
$outs='';
 $nombre_deudor=$answer[0];
 $numero_de_cuenta=$answer[1];
 $c_cvst=$answer[2];
 $local_no='';
 if ((stristr($c_cvst,'CONTEST'))||(stristr($c_cvst,'TERCERO'))||((stristr($c_cvst,'TELEFONO')))||((stristr($c_cvst,'ILOCAL')))||((stristr($c_cvst,' SIN ')))||((stristr($c_cvst,' MANDO')))) {$local_no='X';}
 $local_si='';
 if ((stristr($c_cvst,'ACLAR'))||(stristr($c_cvst,'PAG'))||((stristr($c_cvst,'PROM')))||((stristr($c_cvst,'FAMILIAR')))||((stristr($c_cvst,'CLIENTE')))||((stristr($c_cvst,'CONVENIO')))) {$local_si='X';$local_no='';}
 $int_no='';
 if (stristr($c_cvst,'NEGA')) {$int_no='X';}
 $int_prom='';
 if (stristr($c_cvst,'PROM')) {$int_prom='X';$int_no='';}
 $int_si='';
 if (stristr($c_cvst,'PAG')) {$int_si='X';$int_prom='';$int_no='';}
 $c_cnp=$answer[3];
 $ne='';
 if (!empty($c_cnp)) {$ne='X';}
 $des='';
 if (stristr($c_cnp,'Dese')||stristr($c_cnp,' trab')) {$des='X';$ne='';}
 $gm='';
 if (stristr($c_cnp,'Medicos')) {$gm='X';$ne='';}
 $gi='';
 if (stristr($c_cnp,'Inesper')) {$gi='X';$ne='';}
 $fc='';
 if (stristr($c_cnp,' Capac')) {$fc='X';$ne='';}
 $bv='';
 if (stristr($c_cnp,' venta')) {$bv='X';$ne='';}
 $cnr='';
 if (stristr($c_cnp,' recon')) {$cnr='X';$ne='';}
 $cc='';
 if (stristr($c_cnp,' cred')) {$cc='X';$ne='';}
 $neg_no='';
 if (stristr($c_cvst,'negativ')) {$neg_no='X';}
 $neg_si=''; 
 if (stristr($c_cvst,'nego')) {$neg_si='X';$neg_no='';}

$outs=$outs."'".$nombre_deudor."','".$numero_de_cuenta."','".$local_si."','";
$outs=$outs.$local_no."','".$int_si."','".$int_no."','".$int_prom;
$outs=$outs."','".$des."','".$gm."','".$gi."','".$fc."','".$bv;
$outs=$outs."','".$cnr."','".$cc."','".$ne."','".$neg_si."','".$neg_no;
$outs=$outs."','".$c_cvst."'<br>";
echo $outs;
}
}
}
mysql_close()
 ?>
