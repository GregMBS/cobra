<?php
include('admin_hdr_2.php');
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");$host = "localhost";
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$i=0;
$querypre="SELECT count(distinct id_cuenta),count(distinct ejecutivo_asignado_call_center),
sum(status_aarsa like 'ILO%') 
FROM resumen 
WHERE fecha_de_actualizacion>last_day(curdate() - interval 33 day)
and cliente='Surtidor del Hogar'
;";
$resultpre=mysql_query($querypre) or die(mysql_error());
while ($answerpre=mysql_fetch_row($resultpre)) {
    $total[$i]=$answerpre[0];
//    $gestores=$answerpre[1];
$gestores[$i]=ceil($total[$i]/500);
    $cilo[$i]=$answerpre[2];
    $sdc[$i]='';
    $i++;
    }
$queryf="SELECT count(distinct id_cuenta),count(distinct id_cuenta*(saldo_total=0)) 
FROM resumen JOIN folios on who(cuenta)=numero_de_cuenta and folios.cliente=resumen.cliente
WHERE fecha_de_actualizacion>last_day(curdate() - interval 33 day) 
AND resumen.cliente='Surtidor del Hogar'
AND fecha>last_day(curdate() - interval 33 day)
;";
$i=0;
$resultf=mysql_query($queryf) or die(mysql_error);
while ($answerf=mysql_fetch_row($resultf)) {
    $casot[$i]=$answerf[0];
    $casoc[$i]=$answerf[1];
    $i++;
    }
$i=0;
$querymain="SELECT count(distinct c_cont),count(1),sum(csi_tipo='CD'),sum(csi_cr='PP')
from historia left join csidict on c_cvst=dictamen left join csilugar on accion=c_accion 
join resumen on c_cont=id_cuenta
where fecha_de_actualizacion>last_day(curdate() - interval 33 day)
and d_fech>last_day(curdate() - interval 33 day)  
and cliente='Surtidor del Hogar'
;";
$result=mysql_query($querymain) or die(mysql_error);
while ($answer=mysql_fetch_row($result)) {
    $ctrab[$i]=$answer[0];
    if ($ctrab[$i]>$total[$i]) {$ctrab[$i]=$total[$i];}
    $gestiones[$i]=$answer[1];
    $gef[$i]=$answer[2];
    $gpp[$i]=$answer[3];
    $i++;
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Productividad Surtidor del Hogar</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<table>
<tr>
<th>ADARSA</th>
<th>Cuentas Asignadas</th>
<th>#Ejecutivos Asignados</th>
<th>Cuentas por Ejecutivo</th>
<th>Cuentas Trabajadas</th>
<th>% Ctas Trabajadas</th>
<th>Total Gestiones</th>
<th>Gestiones x Cuenta</th>
<th>Gestiones Efectivas</th>
<th>% GE</th>
<th>Promesas de Pago</th>
<th># PTP vs RPC</th>
<th>Cuentas Ilocalizables por Segmeno</th>
</tr>
<?php for ($j=0;$j<$i;$j++) { ?>
<tr>
<td><?php echo $sdc[$j]; ?></td>
<td><?php echo $total[$j]; ?></td>
<td><?php echo $gestores[$j]; ?></td>
<td><?php echo number_format($total[$j]/$gestores[$j],0); ?></td>
<td><?php echo $ctrab[$j]; ?></td>
<td><?php echo number_format($ctrab[$j]/$total[$j]*100,2); ?>%</td>
<td><?php echo $gestiones[$j]; ?></td>
<td><?php echo number_format($gestiones[$j]/$ctrab[$j],1); ?></td>
<td><?php echo $gef[$j]; ?></td>
<td><?php echo number_format($gef[$j]/$gestiones[$j]*100,2); ?>%</td>
<td><?php echo $gpp[$j]; ?></td>
<td><?php echo number_format($gpp[$j]/$gef[$j]*100,2); ?>%</td>
<td><?php echo $cilo[$j]; ?></td>
</tr>
<?php } ?>
<tr>
<td>Total</td>
<td><?php echo array_sum($total); ?></td>
<td><?php echo array_sum($gestores); ?></td>
<td><?php echo number_format(array_sum($total)/array_sum($gestores),0); ?></td>
<td><?php echo array_sum($ctrab); ?></td>
<td><?php echo number_format(array_sum($ctrab)/array_sum($total)*100,2); ?>%</td>
<td><?php echo array_sum($gestiones); ?></td>
<td><?php echo number_format(array_sum($gestiones)/array_sum($ctrab),1); ?></td>
<td><?php echo array_sum($gef); ?></td>
<td><?php echo number_format(array_sum($gef)/array_sum($gestiones)*100,2); ?>%</td>
<td><?php echo array_sum($gpp); ?></td>
<td><?php echo number_format(array_sum($gpp)/array_sum($gef)*100,2); ?>%</td>
<td><?php echo array_sum($cilo); ?></td>
</tr>
</table>
<table>
<tr>
<?php for ($j=0;$j<$i;$j++) { ?>
<th>Casos Totales</th>
<th>Casos Cumplidos</th>
<th>% Cumplidos</th>
<?php } ?>
</tr>
<tr>
<?php for ($j=0;$j<$i;$j++) { ?>
<td><?php echo $casot[$j]; ?></td>
<td><?php echo $casoc[$j]; ?></td>
<td><?php echo number_format($casoc[$j]/$casot[$j]*100,2); ?>%</td>
<?php } ?>
</tr>
</table>

</body>
</html>
<?php
}
}
mysql_close();
?>
