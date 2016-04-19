<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querylp="CREATE TEMPORARY TABLE lastprom SELECT c_cont,max(auto) AS lp FROM historia 
WHERE (c_cvst like 'PROMESA DE%' OR c_cvst like 'PROPUESTA DE%')
AND (d_prom>=curdate())
GROUP BY c_cont";
mysql_query($querylp) or die(mysql_error());
$i=0;
$queryas="select ejecutivo_asignado_call_center,status_aarsa,
count(1),sum(saldo_total),sum(n_prom),sum(monto) 
from resumen 
left join lastprom on id_cuenta=c_cont 
left join historia on auto=lp 
left join pagos on pagos.cuenta=numero_de_cuenta and pagos.cliente=resumen.cliente 
where ejecutivo_asignado_call_center in (select usuaria from nombres)
group by ejecutivo_asignado_call_center,status_aarsa with rollup;";
$resultas=mysql_query($queryas) or die(mysql_error());
while ($answeras=mysql_fetch_row($resultas)) {
$gestor[$i]=$answeras[0];
$status[$i]=$answeras[1];
$cuantos[$i]=$answeras[2];
$monto[$i]=$answeras[3];
$prom[$i]=$answeras[4];
$pago[$i]=$answeras[5];
$i++;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
	
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
	<TITLE>Status por gestor</TITLE>
	
	<STYLE type='text/css'>
	td.data {text-align:right}
	</STYLE>
	
</HEAD>

<BODY>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<h1>Status por gestor</h1>
<TABLE>
	<TBODY>
		<TR>
			<TH>Gestor</TH>
			<TH>Status</TH>
			<TH>Cuantos</TH>
			<TH>Monto Total</TH>
			<TH>Monto Promesa</TH>
			<TH>Monto Pago</TH>
			<TH>&nbsp;</TH>
		</TR>
<?php 
for ($n=0;$n<$i;$n++) {
?>
		<TR>
			<TD><?php echo $gestor[$n];?></TD>
			<TD><?php if (isset($status[$n])) {echo $status[$n];} else {echo 'total';}?></TD>
			<TD><?php echo $cuantos[$n];?></TD>
			<TD style='text-align:right'><?php echo number_format($monto[$n],0);?></TD>
			<TD style='text-align:right'><?php echo number_format($prom[$n],0);?></TD>
			<TD style='text-align:right'><?php echo number_format($pago[$n],0);?></TD>
			<TD><?php if (isset($status[$n])) {?>
			<a href="speclist.php?capt=<?php echo $capt ?>
			&ejecutivo_asignado_call_center=<?php echo $gestor[$n] ?>
			&status_aarsa=<?php echo $status[$n] ?>
			">
			<?php } else {?>
			<a href="glist.php?capt=<?php echo $capt ?>
			&ejecutivo_asignado_call_center=<?php echo $gestor[$n] ?>
			">
			<?php } ?>
			LISTADO</a></TD>
		</TR>
<?php } ?>
	</TBODY>
</TABLE>
</BODY>
</HTML>
<?php 
}
}
mysql_close();
?>
