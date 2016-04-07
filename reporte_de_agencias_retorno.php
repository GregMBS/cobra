<?php  
$host = "localhost";
$user = "root";
$pwd = "DeathSta1";
$db = "cobra4";
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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>Reporte de Agencias Retorno</title>
<style type="text/css">
.style0
	{
	text-align:left;
	vertical-align:bottom;
	white-space:nowrap;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial;
	border:none;}
td
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial;
	text-align:left;
	vertical-align:bottom;
	border:none;
	white-space:nowrap;}
.xl24
	{	
	white-space:normal;
	border:.5pt solid black;}
.xl25
	{
	border-top:none;
	border-right:.5pt solid black;
	border-bottom:.5pt solid black;
	border-left:.5pt solid black;
	background:silver;
	}
.xl26
	{
	border:.5pt solid black;
	background:silver;
	}
.xl27
	{
	font-weight:700;
	font-family:Arial, sans-serif;
	border-top:none;
	border-right:.5pt solid black;
	border-bottom:.5pt solid black;
	border-left:.5pt solid black;
	background:silver;
	}
.xl28
	{
	border:.5pt solid black;
	white-space:normal;}
.xl29
	{
	font-weight:700;
	font-family:Arial, sans-serif;
	text-align:center;
	border-top:none;
	border-right:.5pt solid black;
	border-bottom:.5pt solid black;
	border-left:.5pt solid black;
	background:silver;
	}
.xl30
	{
	font-weight:700;
	font-family:Arial, sans-serif;
	text-align:center;
	background:silver;
	}
.xl31
	{
	font-weight:700;
	font-family:Arial, sans-serif;
	text-align:center;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid black;
	border-left:.5pt solid black;
	background:silver;
	}
.xl32
	{
	font-weight:700;
	font-family:Arial, sans-serif;
	text-align:center;
	border-top:none;
	border-right:.5pt solid black;
	border-bottom:.5pt solid black;
	border-left:none;
	background:silver;
	}
-->
</style>
</head>

<body>

<table border=0 cellpadding=0 cellspacing=0 width=963 style='border-collapse:
 collapse;table-layout:fixed;width:724pt'>
 <col width=125 style='width:94pt'>
 <col width=80 style='width:60pt'>
 <col width=52 style='width:39pt'>
 <col width=56 style='width:42pt'>
 <col width=52 style='width:39pt'>
 <col width=56 style='width:42pt'>
 <col width=59 style='width:44pt'>
 <col width=34 style='width:26pt'>
 <col width=28 style='width:21pt'>
 <col width=20 style='width:15pt'>
 <col width=24 style='width:18pt'>
 <col width=25 style='width:19pt'>
 <col width=34 style='width:26pt'>
 <col width=25 span=2 style='width:19pt'>
 <col width=52 style='width:39pt'>
 <col width=56 style='width:42pt'>
 <col width=160 style='width:120pt'>
 <tr style='height:12.75pt'>
  <td colspan=18 class=xl30 style='height:12.75pt; width:724pt'>BANCO AMIGO S.A</td>
 </tr>
 <tr style='height:12.75pt'>
  <td colspan=18 class=xl30 style='height:12.75pt'>INSTITUCION DE
  BANCA MULTIPLE</td>
 </tr>
 <tr style='height:12.75pt'>
  <td colspan=18 height=17 class=xl30 style='height:12.75pt'>REPORTE DE RETORNO
  DE INFORMACION AGENCIAS DE COBRANZA</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl27 style='height:12.75pt'>NOMBRE</td>
  <td class=xl27 style='border-left:none'>NUM.CRED</td>
  <td colspan=2 class=xl29 style='border-left:none'>LOCALIZACION</td>
  <td colspan=3 class=xl29 style='border-left:none'>INT.PAGO.</td>
  <td colspan=8 class=xl29 style='border-left:none'>MOTIVO DE ATRAZO</td>
  <td colspan=2 class=xl31 style='border-right:.5pt solid black;border-left:
  none'>INT. DE REST.</td>
  <td class=xl27 style='border-left:none'>Observaciones</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl26 style='height:12.75pt;border-top:none'>&nbsp;</td>
  <td class=xl26 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl25 style='border-left:none'>Positiva</td>
  <td class=xl25 style='border-left:none'>Negativa</td>
  <td class=xl25 style='border-left:none'>Positiva</td>
  <td class=xl25 style='border-left:none'>Negativa</td>
  <td class=xl25 style='border-left:none'>Promesa</td>
  <td class=xl25 style='border-left:none'>DES</td>
  <td class=xl25 style='border-left:none'>GM</td>
  <td class=xl25 style='border-left:none'>GI</td>
  <td class=xl25 style='border-left:none'>FC</td>
  <td class=xl25 style='border-left:none'>BV</td>
  <td class=xl25 style='border-left:none'>CNR</td>
  <td class=xl25 style='border-left:none'>CC</td>
  <td class=xl25 style='border-left:none'>NE</td>
  <td class=xl25 style='border-left:none'>Positiva</td>
  <td class=xl25 style='border-left:none'>Negativa</td>
  <td class=xl26 style='border-top:none;border-left:none'>&nbsp;</td>
 </tr>
 <?php  
 while ($answer = mysql_fetch_row($result)) { 
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

 ?>
 <tr height=68 style='height:51.0pt'>
  <td height=68 class=xl24 style='height:51.0pt;border-top:none'><?php echo $nombre_deudor ?></span></td>
  <td class=xl24 align=right style='border-top:none;border-left:none' x:num><?php echo $numero_de_cuenta ?></td>
  <td class=xl24 style='border-top:none;border-left:none'><?php echo $local_si ?></td>
  <td class=xl24 style='border-top:none;border-left:none'><?php echo $local_no ?></td>
  <td class=xl24 style='border-top:none;border-left:none'><?php echo $int_si ?></td>
  <td class=xl24 style='border-top:none;border-left:none'><?php echo $int_no ?></td>
  <td class=xl24 style='border-top:none;border-left:none'><?php echo $int_prom ?></td>
  <td class=xl24 style='border-top:none;border-left:none'><?php echo $des ?></td>
  <td class=xl24 style='border-top:none;border-left:none'><?php echo $gm ?></td>
  <td class=xl24 style='border-top:none;border-left:none'><?php echo $gi ?></td>
  <td class=xl24 style='border-top:none;border-left:none'><?php echo $fc ?></td>
  <td class=xl24 style='border-top:none;border-left:none'><?php echo $bv ?></td>
  <td class=xl24 style='border-top:none;border-left:none'><?php echo $cnr ?></td>
  <td class=xl24 style='border-top:none;border-left:none'><?php echo $cc ?></td>
  <td class=xl24 style='border-top:none;border-left:none'><?php echo $ne ?></td>
  <td class=xl24 style='border-top:none;border-left:none'><?php echo $neg_si ?></td>
  <td class=xl24 style='border-top:none;border-left:none'><?php echo $neg_no ?></td>
  <td class=xl28 width=160 style='border-top:none;border-left:none;width:120pt'><?php echo $c_cvst ?></td>
 </tr>
<?php } ?>
</table>
</body>
</html>
<?php 
}
}
mysql_close()
 ?>
