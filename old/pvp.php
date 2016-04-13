<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$go='';
$i=0;
$query0 = "SELECT ejecutivo_asignado_call_center, sum(saldo_total), 
COUNT(1) FROM resumen 
GROUP BY ejecutivo_asignado_call_center";
$result0 = mysql_query($query0) or die(mysql_error());
while($answer0=mysql_fetch_row($result0)) {
$gestor[$i]=$answer0[0];
$asignado[$i]=$answer0[1];
$cuentas[$i]=$answer0[2];
$query1 = "SELECT count(distinct((n_prom>0)*cuenta))-1, sum(n_prom)
FROM resumen JOIN historia ON id_cuenta=c_cont 
WHERE ejecutivo_asignado_call_center='".$gestor[$i]."'
AND ((d_prom>curdate()) OR cuenta in (select cuenta from pagos))
;";
$result1 = mysql_query($query1) or die(mysql_error());
while($answer1=mysql_fetch_row($result1)) {
$ppc[$i]=$answer1[0];
$ppl[$i]=$answer1[1];
}
$query2= "SELECT COUNT(distinct cuenta,pagos.cliente), SUM(monto)
FROM resumen JOIN pagos 
ON numero_de_cuenta=cuenta AND resumen.cliente=pagos.cliente 
WHERE id_cuenta in (SELECT c_cont FROM historia WHERE n_prom>0 
AND c_cvge='".$gestor[$i]."')
AND ejecutivo_asignado_call_center='".$gestor[$i]."';";
$result2 = mysql_query($query2) or die(mysql_error());
while($answer2=mysql_fetch_row($result2)) {
$pagc[$i]=$answer2[0];
$pagl[$i]=$answer2[1];
}
$i++;
}
$l=0;
$query3= "SELECT usuaria,COUNT(DISTINCT c_cont*(c_carg<>''))-1,c_cvge
FROM historia JOIN nombres on c_cvge=iniciales 
WHERE (c_visit IS NULL) AND (c_cvge IS NOT NULL)
GROUP BY c_cvge";
$result3 = mysql_query($query3) or die(mysql_error());
while($answer3=mysql_fetch_row($result3)) {
$nombre[$l]=$answer3[0];
$contactosc[$l]=$answer3[1];
$llamador[$l]=$answer3[2];
$query4= "SELECT COUNT(1), SUM(saldo_total) FROM resumen 
WHERE id_cuenta IN (SELECT c_cont FROM historia WHERE c_cvge='".$llamador[$l]."');";
$result4 = mysql_query($query4) or die(mysql_error());
while($answer4=mysql_fetch_row($result4)) {
$cuentasg[$l]=$answer4[0];
$gestionados[$l]=$answer4[1];
}
$query5= "SELECT SUM(saldo_total) 
FROM resumen  
WHERE id_cuenta IN 
(SELECT c_cont FROM historia WHERE c_cvge='".$llamador[$l]."' AND c_carg<>'')
;";
$result5 = mysql_query($query5) or die(mysql_error());
while($answer5=mysql_fetch_row($result5)) {
$contactosl[$l]=$answer5[0];
}
$query6= "SELECT COUNT(DISTINCT cuenta), SUM(monto) 
FROM resumen JOIN pagos ON cuenta=numero_de_cuenta AND pagos.cliente=resumen.cliente 
WHERE id_cuenta IN 
(SELECT c_cont FROM historia WHERE c_cvge='".$llamador[$l]."' AND c_carg<>'')
AND id_cuenta NOT IN
(SELECT c_cont FROM historia WHERE n_prom>0)
;";
$result6 = mysql_query($query6) or die(mysql_error());
while($answer6=mysql_fetch_row($result6)) {
$pagsc[$l]=$answer6[0];
$pagsl[$l]=$answer6[1];
}
$l++;
}
$query1b="drop table if exists paid;";
mysql_query($query1b) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Promesas vs Pagos - Todos</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#000000;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;}
     tr:hover {background-color: #ff0000;}
       th {border: 1pt solid #000000;background-color: #c0c0c0;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
 </style>

</head>
<body>
<table summary="Efectividad">
<h2>Gestiones VS PP</h2>
<thead>
<tr>
<th>Gestor</th>
<th>Asignado</th>
<th>Cuentas</th>
<th>Promesas #</th>
<th>Promesas $</th>
<th>Pagos #</th>
<th>Pagos $</th>
<th>Efectividad #</th>
<th>Efectividad $</th>
</tr>
</thead>
<tbody>
<?php
for ($k=0;$k<$i;$k++) {
?>
<tr>
<td><?php echo $gestor[$k];?></td>
<td class="num"><?php echo number_format($asignado[$k],2);?></td>
<td class="num"><?php echo $cuentas[$k];?></td>
<td class="num"><?php echo $ppc[$k];?></td>
<td class="num"><?php echo number_format($ppl[$k],2);?></td>
<td class="num"><?php echo $pagc[$k];?></td>
<td class="num"><?php echo number_format($pagl[$k],2);?></td>
<td class="num"><?php echo number_format($pagc[$k]/($ppc[$k]+0.001)*100,0);?>%</td>
<td class="num"><?php echo number_format($pagl[$k]/($ppl[$k]+0.001)*100,0);?>%</td>
</tr>
<?php } ?>
</tbody>
</table>
<table summary="Efectividad">
<h2>Gestiones VS PP</h2>
<thead>
<tr>
<th>Gestor</th>
<th>Gestionados</th>
<th>Cuentas</th>
<th>Contactadas #</th>
<th>Contactadas $</th>
<th>Pagos sin Promesas #</th>
<th>Pagos sin Promesas $</th>
<th>Efectividad #</th>
<th>Efectividad $</th>
</tr>
</thead>
<tbody>
<?php
for ($k=0;$k<$l;$k++) {
?>
<tr>
<td><?php echo $nombre[$k];?></td>
<td class="num"><?php echo number_format($gestionados[$k],2);?></td>
<td class="num"><?php echo $cuentasg[$k];?></td>
<td class="num"><?php echo $contactosc[$k];?></td>
<td class="num"><?php echo number_format($contactosl[$k],2);?></td>
<td class="num"><?php echo $pagsc[$k];?></td>
<td class="num"><?php echo number_format($pagsl[$k],2);?></td>
<td class="num"><?php echo number_format($pagsc[$k]/($contactosc[$k]+0.001)*100,0);?>%</td>
<td class="num"><?php echo number_format($pagsl[$k]/($contactosl[$k]+0.001)*100,0);?>%</td>
</tr>
<?php } ?>
</tbody>
</table>
</body>
</html> <?php   
}
}
mysql_close($con);
?>

