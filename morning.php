<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pwd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_REQUEST['capt']);
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."' AND tipo='admin';";
$resultcheck=mysql_query($querycheck);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$yr=date('Y');
$mes=date('m');
$hoy=date('d');
if ($hoy==1) {
$yesterday = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
$yr=date('Y',$yesterday);
$mes=date('m',$yesterday);
$hoy=date('d',$yesterday)+1;	
	}
$dst='';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Performance</title>
<meta http-equiv="refresh" content="900"/>
<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #cc9900;}
       table {border: 1pt solid #000000;background-color: #ffffff;}
 	tr:hover {background-color: #ffff00;}
       th,td {border: 1pt solid #000000;background-color: #ffffff;}
       th,.heavy {font-weight:bold;font-size:10pt;}
       .heavytot {font-weight:bold;font-size:10pt;text-align:right;}
       .light {text-align:right;}
</style>
</head>
<body>
<h2>RECUPERACI&Oacute;N</h2>
<table summary="Montopag">
<thead>
<tr>
<td></td>
<th>RECUPERACI&Oacute;N</th>
<th>SUM de SALDO VENCIDO</th>
</tr>
</thead>
<tbody>
<?php
$queryp = "SELECT ejecutivo_asignado_call_center,sum(monto),sum(saldo_vencido) FROM resumen LEFT JOIN pagos ON resumen.numero_de_cuenta=pagos.cuenta JOIN nombres ON ejecutivo_asignado_call_center=usuaria group by ejecutivo_asignado_call_center";
$resultp = mysql_query($queryp) or die(mysql_error());
while ($answerp = mysql_fetch_row($resultp)) {
$nombre=$answerp[0];
$montopag=$answerp[1];
$montototal=$answerp[2];
?>
<tr>
<td class="heavy"><?php echo $nombre;?></td>
<td class="light"><?php echo number_format($montopag,2);?></td>
<td class="light"><?php echo number_format($montototal,2);?></td>
</tr>
<?php } 
$querys = "SELECT sum(monto),sum(saldo_vencido) FROM resumen LEFT JOIN pagos ON resumen.numero_de_cuenta=pagos.cuenta";
$results = mysql_query($querys) or die(mysql_error());
while ($answers = mysql_fetch_row($results)) {
$nombre='TOTAL';
$montopag=$answers[0];
$montototal=$answers[1];
?>
<tr>
<td class="heavy"><?php echo $nombre;?></td>
<td class="heavytot"><?php echo number_format($montopag,2);?></td>
<td class="heavytot"><?php echo number_format($montototal,2);?></td>
</tr>
<?php } 
?>
</tbody>
</table>
<h2>GESTIONES</h2>
<table summary="Calls">
<thead>
<tr>
<td></td>
<?php 
for ($i=0;$i<$hoy;$i++) {
$empe=$yr.'-'.$mes.'-01';
$dsti[$i]='sum(D_FECH=adddate("'.$empe.'",'.$i.'))';
$dst=$dst.','.$dsti[$i]; ?>
<th><?php echo $i+1;?></th>
<?php } ?>
<th>TOTAL</th>
<th>SIN CONTACTO</th>
</tr>
</thead>
<tbody>
<?php
$queryg = "SELECT usuaria ".$dst." FROM historia JOIN nombres on C_CVGE=iniciales GROUP BY usuaria";
$resultg = mysql_query($queryg) or die(mysql_error());
while ($answerg = mysql_fetch_row($resultg)) {
$numg=count($answerg);
$sumg=0;
$nombre=$answerg[0];
?>
<tr><td class="heavy"><?php echo $nombre;?></td>
<?php 
for ($i=1;$i<=$hoy;$i++) {
?>
<td class="light"><?php echo $answerg[$i];?></td>
<?php
$sumg=$sumg+$answerg[$i];
}
?>
<td class="heavy light"><?php echo $sumg;?></td>
<?php
$queryu = "select sum(lla=0 or lla is null) from (select id_cuenta,sum(C_CARG<>'') as lla from resumen left join historia on C_CONT=id_cuenta where ejecutivo_asignado_call_center='$nombre' group by id_cuenta) as subq";
$resultu = mysql_query($queryu) or die(mysql_error());
$answeru = mysql_fetch_row($resultu) or die(mysql_error());
?>
<td class="heavy light"><?php echo $answeru[0];?></td>
</tr>
<?php } 
?>
<tr class="heavy">
<td>TOTAL</td>
<?php 
$tdst=ltrim($dst,',');
$queryt = 'SELECT '.$tdst.' FROM historia JOIN nombres on C_CVGE=iniciales';
$resultt = mysql_query($queryt) or die(mysql_error());
while ($answert = mysql_fetch_row($resultt)) {
$sumt=0;
?>
<?php 
for ($ii=0;$ii<$hoy;$ii++) {
?>
<td class="light"><?php echo $answert[$ii];?></td>
<?php
$sumt=$sumt+$answert[$ii];
}
}
?>
<td class="heavy light"><?php echo $sumt;?></td>
<?php
$queryuu = "select sum(lla=0 or lla is null) from (select id_cuenta,sum(C_CARG<>'') as lla from resumen left join historia on cuenta=numero_de_cuenta join nombres on c_cvge=iniciales group by id_cuenta) as subq";
$resultuu = mysql_query($queryuu) or die(mysql_error());
$answeruu = mysql_fetch_row($resultuu) or die(mysql_error());
?>
<td class="heavy light"><?php echo $answeruu[0];?></td>
</tbody>
</table>
<h2>PROMESAS</h2>
<table summary="Promesas">
<thead>
<tr>
<td></td>
<?php 
$dst2="";
for ($i2=1;$i2<=$hoy;$i2++) {
$dst2=$dst2.",sum(month(D_FECH)=".$mes." AND (day(D_FECH)=".$i2.") AND (N_PROM>0))" ?>
<th><?php echo $i2;?></th>
<?php } ?>
<th>TOTAL</th>
</tr>
</thead>
<tbody>
<?php
$queryg2 = "SELECT usuaria ".$dst2." FROM historia JOIN nombres on C_CVGE=iniciales GROUP BY usuaria";
$resultg2 = mysql_query($queryg2) or die(mysql_error());
while ($answerg2 = mysql_fetch_row($resultg2)) {
$numg2=count($answerg2);
$sumg2=0;
$nombre=$answerg2[0];
?>
<tr><td class="heavy"><?php echo $nombre;?></td>
<?php 
for ($i2=1;$i2<=$hoy;$i2++) {
?>
<td class="light"><?php echo $answerg2[$i2];?></td>
<?php
$sumg2=$sumg2+$answerg2[$i2];
}
?>
<td class="heavy light"><?php echo $sumg2;?></td>
</tr>
<?php } 
?>
<tr class="heavy">
<td>TOTAL</td>
<?php 
$tdst=ltrim($dst2,',');
$queryt2 = 'SELECT '.$tdst.' FROM historia JOIN nombres on C_CVGE=iniciales';
$resultt2 = mysql_query($queryt2) or die(mysql_error());
while ($answert2 = mysql_fetch_row($resultt2)) {
$sumt2=0;
?>
<?php 
for ($ii2=0;$ii2<$hoy;$ii2++) {
?>
<td class="light"><?php echo $answert2[$ii2];?></td>
<?php
$sumt2=$sumt2+$answert2[$ii2];
}
}
?>
<td class="heavy light"><?php echo $sumt2;?></td>
</tbody>
</table>
</body>
</html>
<?php   
}
}
mysql_close($con);
?>
</body>
</html>
