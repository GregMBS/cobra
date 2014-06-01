<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$queryayer="SELECT max(d_fech),year(max(d_fech)),month(max(d_fech)),day(max(d_fech)) FROM historia WHERE d_fech='2009-04-02' and c_cvge<>'Milt';";
$resultayer=mysql_query($queryayer) or die(mysql_error);
while ($answerayer=mysql_fetch_row($resultayer)) {
        $ayer=$answerayer[0];
        $ano=$answerayer[1];
        $mes=$answerayer[2];
        $dia=$answerayer[3];
        }
$querymain="SELECT cuenta,DATE_FORMAT(d_fech,'%d-%m-%Y'),DATE_FORMAT(c_hrin,'%H:%i'),'1017',if (c_visit is not null,'DV','DT'),codigo,csi_tipo,csi_cr,
if (n_prom>0,DATE_FORMAT(d_prom,'%d-%m-%Y'),''),if (n_prom>0,floor(n_prom),''),left(c_obse1,200) 
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
mysql_close();
?>
