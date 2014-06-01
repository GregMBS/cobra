<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querylp="CREATE TEMPORARY TABLE lastprom SELECT c_cont,max(auto) AS lp FROM historia 
WHERE (c_cvst like 'PROMESA DE%' or c_cvst like 'PROP% DE%')
AND (d_prom>=curdate())
GROUP BY c_cont";
mysql_query($querylp) or die(mysql_error());
$i=0;
$clienteold='';
$queryas="select resumen.cliente,status_aarsa,count(distinct id_cuenta),sum(saldo_total),sum(n_prom),sum(monto) 
from resumen 
left join lastprom on id_cuenta=c_cont 
left join historia on auto=lp 
left join pagos on pagos.cuenta=numero_de_cuenta and pagos.cliente=resumen.cliente 
where ejecutivo_asignado_call_center in (select usuaria from nombres) 
AND status_de_credito not regexp 'nactivo' 
group by cliente,status_aarsa with rollup;";
$resultas=mysql_query($queryas) or die(mysql_error());
while ($answeras=mysql_fetch_row($resultas)) {
$cstring[$i]='';
$cliente[$i]=$answeras[0];
if ($clienteold==$cliente[$i]) {$cstring[$i]='';}
else {$clienteold=$cliente[$i];$cstring[$i]=$cliente[$i];}
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
	<TITLE>Status por cliente</TITLE>
	
	<STYLE type='text/css'>
       body {font-family: arial, helvetica, sans-serif; font-size: 10pt; background-color: #00a0f0; color:#000000;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;}
     tr:hover {background-color: #ff0000;}
       th {border: 1pt solid #000000;background-color: #c0c0c0;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.data {text-align:right;}
	</STYLE>
	
</HEAD>

<BODY>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<h1>Status por cliente</h1>
<TABLE>
	<TBODY>
		<TR>
			<TH>Cliente</TH>
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
			<TD><?php echo $cstring[$n];?></TD>
			<TD><?php if (isset($status[$n])) {echo $status[$n];} else {echo 'total';}?></TD>
			<TD><?php echo $cuantos[$n];?></TD>
			<TD style='text-align:right'><?php echo number_format($monto[$n],0);?></TD>
			<TD style='text-align:right'><?php echo number_format($prom[$n],0);?></TD>
			<TD style='text-align:right'><?php echo number_format($pago[$n],0);?></TD>
			<TD><?php if (isset($status[$n])) {?>
			<a href="speclistc.php?capt=<?php echo $capt ?>
			&cliente=<?php echo $cliente[$n] ?>
			&status_aarsa=<?php echo $status[$n] ?>
			">
			<?php } else {?>
			<a href="clist.php?capt=<?php echo $capt ?>
			&cliente=<?php echo $cliente[$n] ?>
			">
			<?php } ?>
			LISTADO</a></TD>
		</TR>
<?php }?>
	</TBODY>
</TABLE>
</BODY>
</HTML>
<?php 
}
}
mysql_close();
?>
