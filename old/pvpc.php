<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$go=mysql_real_escape_string($_REQUEST['go']);
if (!empty($go)) {
$go='';
$query1b="drop table if exists paid;";
mysql_query($query1b) or die(mysql_error());
$query1a="create temporary table paid (
  `c_cont` int(11) NOT NULL default '0',
  `df` date default NULL
) 
SELECT c_cont,max(d_fech) as df FROM historia WHERE n_prom>0 GROUP BY c_cont";
mysql_query($query1a) or die(mysql_error());
$cliente=mysql_real_escape_string($_REQUEST['cliente']);
$h=0;
$query0 = "SELECT ejecutivo_asignado_call_center, sum(saldo_total), 
COUNT(1) FROM resumen 
WHERE (cliente='".$cliente."')
AND (status_de_credito not regexp 'nactivo')
GROUP BY ejecutivo_asignado_call_center";
$result0 = mysql_query($query0) or die(mysql_error());
while($answer0=mysql_fetch_row($result0)) {
$gestor[$h]=$answer0[0];
$asignado[$h]=$answer0[1];
$cuentas[$h]=$answer0[2];
$h++;
}
$i=0;
$query1 = "SELECT COUNT(DISTINCT (n_prom>0)*c_cont)-1, SUM(n_prom)
FROM resumen JOIN historia ON id_cuenta=c_cont 
WHERE (d_prom>curdate()
OR (c_cvba,cuenta) IN (SELECT cliente,cuenta from pagos))
AND (id_cuenta,d_fech) IN (SELECT c_cont,df FROM paid)
AND cliente='".$cliente."' 
AND ejecutivo_asignado_call_center='".$gestor[$i]."';";
$result1 = mysql_query($query1) or die(mysql_error());
while($answer1=mysql_fetch_row($result1)) {
$ppc[$i]=$answer1[0];
$ppl[$i]=$answer1[1];
$i++;
}
$j=0;
$query2= "SELECT COUNT(distinct cuenta,pagos.cliente), SUM(monto)
FROM resumen LEFT JOIN pagos 
ON numero_de_cuenta=cuenta AND resumen.cliente=pagos.cliente 
WHERE id_cuenta in (SELECT c_cont FROM historia WHERE n_prom>0)
AND (resumen.cliente='".$cliente."')
AND (status_de_credito not regexp 'nactivo')
GROUP BY ejecutivo_asignado_call_center";
$result2 = mysql_query($query2) or die(mysql_error());
while($answer2=mysql_fetch_row($result2)) {
$pagc[$j]=$answer2[0];
$pagl[$j]=$answer2[1];
$j++;
}
$l=0;
$query3= "SELECT usuaria,COUNT(DISTINCT c_cont*(c_carg<>''))-1,c_cvge
FROM historia JOIN nombres on c_cvge=iniciales 
WHERE (c_visit IS NULL) AND (c_cvge IS NOT NULL)
AND (c_cvba='".$cliente."')
AND (c_cont IN (SELECT id_cuenta FROM resumen WHERE status_de_credito not regexp 'nactivo'))
GROUP BY c_cvge";
$result3 = mysql_query($query3) or die(mysql_error());
while($answer3=mysql_fetch_row($result3)) {
$nombre[$l]=$answer3[0];
$contactosc[$l]=$answer3[1];
$llamador[$l]=$answer3[2];
$query4= "SELECT COUNT(1), SUM(saldo_total) FROM resumen 
WHERE (cliente='".$cliente."')
AND (status_de_credito not regexp 'nactivo')
AND id_cuenta IN (SELECT c_cont FROM historia WHERE c_cvge='".$llamador[$l]."')
GROUP BY ejecutivo_asignado_call_center;";
$result4 = mysql_query($query4) or die(mysql_error());
while($answer4=mysql_fetch_row($result4)) {
$cuentasg[$l]=$answer4[0];
$gestionados[$l]=$answer4[1];
}
$query5= "SELECT SUM(saldo_total) 
FROM resumen  
WHERE id_cuenta IN 
(SELECT c_cont FROM historia WHERE c_cvge='".$llamador[$l]."' AND c_carg<>'')
AND (status_de_credito not regexp 'nactivo')
AND (cliente='".$cliente."');";
$result5 = mysql_query($query5) or die(mysql_error());
while($answer5=mysql_fetch_row($result5)) {
$contactosl[$l]=$answer5[0];
}
$query6= "SELECT COUNT(DISTINCT cuenta), SUM(monto) 
FROM resumen JOIN pagos ON cuenta=numero_de_cuenta AND pagos.cliente=resumen.cliente 
WHERE id_cuenta IN 
(SELECT c_cont FROM historia WHERE c_cvge='".$llamador[$l]."' AND c_carg<>'')
AND (status_de_credito not regexp 'nactivo')
AND id_cuenta NOT IN
(SELECT c_cont FROM historia WHERE n_prom>0)
AND (resumen.cliente='".$cliente."')
;";
$result6 = mysql_query($query6) or die(mysql_error());
while($answer6=mysql_fetch_row($result6)) {
$pagsc[$l]=$answer6[0];
$pagsl[$l]=$answer6[1];
}
$l++;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Promesas vs Pagos - Por Cliente <?php echo $cliente ?></title>

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
<h1>Promesas vs Pagos - Por Cliente <?php echo $cliente ?></h1>
<h2>Gestiones VS PP</h2>
<table summary="Efectividad">
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
for ($k=0;$k<$h;$k++) {
?>
<tr>
<td><?php echo $gestor[$k];?></td>
<td class="num"><?php echo number_format($asignado[$k],2);?></td>
<td class="num"><?php echo $cuentas[$k];?></td>
<td class="num"><?php echo number_format($ppc[$k],0);?></td>
<td class="num"><?php echo number_format($ppl[$k],2);?></td>
<td class="num"><?php echo number_format($pagc[$k],0);?></td>
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
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Promesas vs Pagos - Por Mes</title>
</head>
<body>
<div>
<form action='pvpc.php' method='get'>
<p>Cliente
<select name='cliente'>
<?php 
$querycl = "SELECT cliente FROM clientes ORDER BY cliente;";
$resultcl = mysql_query($querycl);
while ($answercl = mysql_fetch_array($resultcl)) {?>
<option value="<?php echo $answercl[0];?>" <?php if ($cliente==$answercl[0]) {?> selected='selected'<?php } ?>><?php echo $answercl[0];?>
</option>
<?php } ?>
</select>
</p>
<input type='hidden' name='capt' value='<?php echo $capt?>'>
<input type='submit' name='go' value='Elegir'>
</form>
</div>
</body>
</html>
<?php
}
}
}
mysql_close($con);
?>

