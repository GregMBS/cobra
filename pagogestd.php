<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querylp2="DROP TABLE if exists lastprom";
mysql_query($querylp2) or die(mysql_error());
$querycallers2="DROP TABLE if exists callers";
mysql_query($querycallers2) or die(mysql_error());
$i=0;
$querylp="CREATE TABLE lastprom SELECT c_cont,max(auto) AS lp,c_cvba,cuenta FROM historia 
WHERE (c_cvst like 'PROMESA DE%' OR c_cvst like 'PROPUESTA DE%')
AND (d_prom>=curdate() OR (cuenta,c_cvba) IN (select cuenta,cliente from pagos))
AND to_days(d_fech)=to_days(curdate())-1
GROUP BY c_cont";
mysql_query($querylp) or die(mysql_error());
$querycallers="CREATE TABLE callers SELECT distinct c_cvge FROM historia";
mysql_query($querycallers) or die(mysql_error());
$queryas="select ejecutivo_asignado_call_center,sum(saldo_total),turno,cliente,if(cliente<>'Vanguardia',status_de_credito,'') FROM resumen
JOIN nombres ON ejecutivo_asignado_call_center=usuaria
WHERE ejecutivo_asignado_call_center IN (select c_cvge from callers)
AND status_de_credito<>'inactivo'
GROUP BY ejecutivo_asignado_call_center,cliente,if(cliente<>'Vanguardia',status_de_credito,'');";
$resultas=mysql_query($queryas) or die(mysql_error());
while ($answeras=mysql_fetch_row($resultas)) {
$gestor[$i]=$answeras[0];
$turno[$i]=$answeras[0];
$cliente[$i]=$answeras[3];
$status[$i]=$answeras[4];
$asignada[$i]=$answeras[1];
$i++;
}
for ($j=0;$j<$i;$j++) {
$queryprom="select sum(n_prom) from historia 
join lastprom ON lp=auto 
join resumen on id_cuenta=lastprom.c_cont
where c_cvge = '".$gestor[$j]."' 
AND status_de_credito='".$status[$j]."'
group by c_cvge,lastprom.c_cvba,if(lastprom.c_cvba<>'Vanguardia',status_de_credito,'')";
$resultprom=mysql_query($queryprom) or die(mysql_error());
while ($answerprom=mysql_fetch_row($resultprom)) {
$promesas[$j]=$answerprom[0];
}}
$k=0;
$querypag="select c_cvge,sum(monto),lastprom.c_cvba,if(lastprom.c_cvba<>'Vanguardia',status_de_credito,'') from pagos 
join lastprom on c_cvba=cliente and pagos.cuenta=lastprom.cuenta
join historia on lp=historia.auto
join resumen on id_cuenta=lastprom.c_cont
where to_days(fecha)=to_days(curdate())-1
AND status_de_credito<>'inactivo'
group by c_cvge,lastprom.c_cvba,if(lastprom.c_cvba<>'Vanguardia',status_de_credito,'')";
$resultpag=mysql_query($querypag) or die(mysql_error());
while ($answerpag=mysql_fetch_row($resultpag)) {
$pagos[$k]=$answerpag[1];
$k++;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
	
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
	<TITLE>Pagos por gestor (ayer)</TITLE>
	
	<STYLE type='text/css'>
	td.data {text-align:right}
	</STYLE>
	
</HEAD>

<BODY>
<h1>Pagos por gestor (<?php echo date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 1, date("Y"))) ?>)</h1>
<TABLE>
	<TBODY>
		<TR>
			<TH>Gestor</TH>
			<TH>Turno</TH>
			<TH>Cliente</TH>
			<TH>Segmento</TH>
			<TH>Asignado</TH>
			<TH>Promesas</TH>
			<TH>% Promesas</TH>
			<TH>Pagos</TH>
			<TH>% Pagos</TH>
		</TR>
<?php 
$m=max($i,$j,$k);
for ($n=0;$n<$m;$n++) {
?>
		<TR>
			<TD><?php echo $gestor[$n];?></TD>
			<TD><?php echo $turno[$n];?></TD>
			<TD><?php echo $cliente[$n];?></TD>
			<TD><?php echo $status[$n];?></TD>
			<TD class='data'>$<?php echo number_format($asignada[$n],0);?></TD>
			<TD class='data'>$<?php echo number_format($promesas[$n],0);?></TD>
			<TD class='data'><?php echo number_format($promesas[$n]/$asignada[$n]*100,0);?>%</TD>
			<TD class='data'>$<?php echo number_format($pagos[$n],0);?></TD>
			<TD class='data'><?php echo number_format($pagos[$n]/$asignada[$n]*100,0);?>%</TD>
		</TR>
<?php } ?>
	</TBODY>
</TABLE>
</BODY>
</HTML>
<?php 
$querylp2="DROP TABLE lastprom";
mysql_query($querylp2) or die(mysql_error());
$querycallers2="DROP TABLE callers";
mysql_query($querycallers2) or die(mysql_error());
}
}
mysql_close();
?>
