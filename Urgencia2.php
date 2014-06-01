<?php
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");$host = "localhost";
$user = "root";
$pswd = "AwRats";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pswd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_GET['capt']);
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."' AND tipo='admin';";
$resultcheck=mysql_query($querycheck);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$mes=3;
$ano=2009;
for ($dia=5;$dia<10;$dia++) {$ayer=$ano.'-'.$mes.'-'.$dia;
$querymain="SELECT cuenta,d_fech,c_hrin,c_cvge,csi_cr,lugar,csi_tipo,csi_res,
if (n_prom>0,d_prom,''),if (n_prom>0,n_prom,''),left(c_obse1,200) 
from historia join csidict on c_cvst=dictamen join csilugar on accion=c_accion 
where d_fech='".$ayer."';";
$result=mysql_query($querymain) or die(mysql_error);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">

<HTML>
<HEAD>
	
	<TITLE>Layout Carga de Gestiones</TITLE>
	
	<STYLE>
	</STYLE>
	
</HEAD>

<BODY>
<TABLE>
	<TBODY>
		<TR>
			<TD>1</TD>
			<TD>2</TD>
			<TD>3</TD>
			<TD>4</TD>
			<TD>5</TD>
			<TD>6</TD>
			<TD>7</TD>
			<TD>8</TD>
			<TD>9</TD>
			<TD>10</TD>
			<TD>11</TD>
		</TR>
		<TR>
<td style='font-weight:bold'>Número de Crédito</td>
<td style='font-weight:bold'>Fecha de gestión</td>
<td style='font-weight:bold'>Hora de gestión</td>
<td style='font-weight:bold'>Cobrador</td>
<td style='font-weight:bold'>Código de Gestión</td>
<td style='font-weight:bold'>Lugar de gestión</td>
<td style='font-weight:bold'>Tipo de contacto</td>
<td style='font-weight:bold'>Resultado de la Gestión</td>
<td style='font-weight:bold'>Fecha Promesa de Pago</td>
<td style='font-weight:bold'>Monto Promesa de Pago</td>
<td style='font-weight:bold'>Comentario</td>
		</TR>
<?php
while ($answer=mysql_fetch_row($result)) {
?>
<tr>
<td style='font-weight:bold'><?php echo $answer[0];?></td>
<td style='font-weight:bold'><?php echo $answer[1];?></td>
<td style='font-weight:bold'><?php echo $answer[2];?></td>
<td style='font-weight:bold'><?php echo $answer[3];?></td>
<td style='font-weight:bold'><?php echo $answer[4];?></td>
<td style='font-weight:bold'><?php echo $answer[5];?></td>
<td style='font-weight:bold'><?php echo $answer[6];?></td>
<td style='font-weight:bold'><?php echo $answer[7];?></td>
<td style='font-weight:bold'><?php echo $answer[8];?></td>
<td style='font-weight:bold'><?php echo $answer[9];?></td>
<td style='font-weight:bold'><?php echo $answer[10];?></td>
<td style='font-weight:bold'><?php echo $answer[11];?></td>
</tr>
<?php } ?>
</TABLE>
</BODY>
</HTML>
<?php 
}
}
}
mysql_close();
?>
