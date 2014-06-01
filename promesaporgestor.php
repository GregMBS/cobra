<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Promesas</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#000000;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;border-collapse: collapse;}
     tr:hover {background-color: #ff0000;}
       th {border: 2pt solid #000000;background-color: #c0c0c0;}
       td {border: 1pt solid #000000;background-color: #c0c0c0;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.numw {text-align:right;color:#ffffff;}
	.numcs {text-align:right;color:#000000;}
	.numpr {text-align:right;color:#ff0000;}
	.numsdh {text-align:right;color:#00bb00;}
 </style>

</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<h2>Promesas Vigentes del Mes Actual</h2>
<table summary="Por gestor este mes">
<thead>
<tr>
<th>Gestor de captura</th>
<th>Promesas</th>
</tr>
</thead>
<tbody>
<?php
$SCS=0;
$query="select c_cvge,
sum(np)
from resumen 
join (select c_cvge,c_cvba,c_cont,
substring_index(group_concat(n_prom order by d_fech desc),',',1) as np 
from historia where d_prom>=curdate() and c_cniv is null and d_fech>last_day(curdate()-interval 1 month)
group by c_cvge,c_cont) as tmp
on c_cont=id_cuenta 
group by c_cvge";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$GESTOR=$row[0];
$MONTO=number_format($row[1],2);
$SCS=$SCS+$row[1];
?>
<tr>
<td><?php echo $GESTOR;?></td>
<td class="numcs"><?php echo $MONTO;?></td>
</tr>
<?php } ?>
<tr>
<th>SUM</th>
<th class="num"><?php echo number_format($SCS,2);?></th>
</tr>
</tbody>
</table>
<h2>Detalles Vigentes</h2>
<table summary="Los detalles">
<thead>
<tr>
<th>Gestor</th>
<th>Cliente</th>
<th>Campa&ntilde;a</th>
<th>Queue</th>
<th>Cuenta</th>
<th>Status Cuenta</th>
<th>Status Gestion</th>
<th>Monto 1</th>
<th>Fecha 1</th>
<th>Monto 2</th>
<th>Fecha 2</th>
<th>Titular</th>
<th>Fecha de Gestion</th>
</tr>
</thead>
<tbody>
<?php
$query="select c_cvge as 'gestor', c_cvba as 'cliente', status_de_credito, 
queue, numero_de_cuenta, status_aarsa as 'status de cuenta', 
c_cvst as 'status de gestion', n_prom1, d_prom1, n_prom2, d_prom2, 
nombre_deudor as 'nombre', d_fech , n_prom3, d_prom3, n_prom4, d_prom4
from resumen 
join historia on c_cont=id_cuenta
join (select c_cont,max(concat(d_fech,c_hrfi)) as dp from historia 
where n_prom>0
and d_prom>last_day(curdate()-interval 1 month)
and d_fech>last_day(curdate()-interval 1 month)
group by c_cont) as tmp on dp=concat(d_fech,c_hrfi) 
left join dictamenes on status_aarsa=dictamen
where d_prom>=curdate()
group by resumen.id_cuenta
order by c_cvge,numero_de_cuenta";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$GESTOR=$row[0];
$CLIENTE=$row[1];
$CAMP=$row[2];
$QUEUE=$row[3];
$CUENTA=$row[4];
$SC=$row[5];
$SG=$row[6];
$MONTO1=number_format($row[7],2);
$FECHA1=$row[8];
$MONTO2=number_format($row[9],2);
$FECHA2=$row[10];
$ASIGNADO=$row[11];
$FECHAG=$row[12];
?>
<tr>
<td><?php echo $GESTOR;?></td>
<td><?php echo $CLIENTE;?></td>
<td><?php echo $CAMP;?></td>
<td><?php echo $QUEUE;?></td>
<td><?php echo $CUENTA;?></td>
<td><?php echo $SC;?></td>
<td><?php echo $SG;?></td>
<td class="numcs"><?php echo $MONTO1;?></td>
<td><?php echo $FECHA1;?></td>
<td class="numcs"><?php echo $MONTO2;?></td>
<td><?php echo $FECHA2;?></td>
<td><?php echo $ASIGNADO;?></td>
<td><?php echo $FOLIO;?></td>
<td><?php echo $FECHAG;?></td>
</tr>
<?php } ?>
</tbody>
</table>
<h2>Detalles Vencidos y Pagados</h2>
<table summary="Los detalles 2">
<thead>
<tr>
<th>Gestor</th>
<th>Cliente</th>
<th>Campa&ntilde;a</th>
<th>Queue</th>
<th>Cuenta</th>
<th>Status Cuenta</th>
<th>Status Gestion</th>
<th>Monto 1</th>
<th>Fecha 1</th>
<th>Monto 2</th>
<th>Fecha 2</th>
<th>Monto 3</th>
<th>Fecha 3</th>
<th>Monto 4</th>
<th>Fecha 4</th>
<th>Titular</th>
<th>Folio</th>
<th>Monto Pago</th>
<th>Monto Confirmado</th>
<th>Fecha de Gestion</th>
</tr>
</thead>
<tbody>
<?php
$query="select c_cvge as 'gestor', c_cvba as 'cliente', status_de_credito, 
queue, numero_de_cuenta, status_aarsa as 'status de cuenta', 
c_cvst as 'status de gestion', n_prom1, d_prom1, n_prom2, d_prom2, 
nombre_deudor as 'nombre', max(folio) as 'folio', 
sum(monto),sum(monto*confirmado), d_fech, n_prom3, d_prom3, n_prom4, d_prom4 
from resumen 
join historia on c_cont=id_cuenta
join (select c_cont,max(auto) as dp from historia 
where n_prom>0
and d_fech>last_day(curdate()-interval 1 month)
group by c_cont) as tmp on dp=auto 
left join dictamenes on status_aarsa=dictamen
left join folios on folios.cuenta=numero_de_cuenta and folios.cliente=resumen.cliente
left join pagos on pagos.id_cuenta=resumen.id_cuenta and pagos.fecha>d_fech
where d_prom<curdate()
group by resumen.id_cuenta
order by c_cvge,numero_de_cuenta";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$GESTOR=$row[0];
$CLIENTE=$row[1];
$CAMP=$row[2];
$QUEUE=$row[3];
$CUENTA=$row[4];
$SC=$row[5];
$SG=$row[6];
$MONTO1=number_format($row[7],2);
$FECHA1=$row[8];
$MONTO2=number_format($row[9],2);
$FECHA2=$row[10];
$ASIGNADO=$row[11];
$FOLIO=$row[12];
$MONTO=number_format($row[13]);
$MONTOC=number_format($row[14]);
$FECHAG=$row[15];
$MONTO3=number_format($row[16],2);
$FECHA3=$row[17];
$MONTO4=number_format($row[18],2);
$FECHA4=$row[19];
?>
<tr>
<td><?php echo $GESTOR;?></td>
<td><?php echo $CLIENTE;?></td>
<td><?php echo $CAMP;?></td>
<td><?php echo $QUEUE;?></td>
<td><?php echo $CUENTA;?></td>
<td><?php echo $SC;?></td>
<td><?php echo $SG;?></td>
<td class="numcs"><?php echo $MONTO1;?></td>
<td><?php echo $FECHA1;?></td>
<td class="numcs"><?php echo $MONTO2;?></td>
<td><?php echo $FECHA2;?></td>
<td class="numcs"><?php echo $MONTO3;?></td>
<td><?php echo $FECHA3;?></td>
<td class="numcs"><?php echo $MONTO4;?></td>
<td><?php echo $FECHA4;?></td>
<td><?php echo $ASIGNADO;?></td>
<td><?php echo $FOLIO;?></td>
<td><?php echo $MONTO;?></td>
<td><?php echo $MONTOC;?></td>
<td><?php echo $FECHAG;?></td>
</tr>
<?php } ?>
</tbody>
</table><?php   
}
}
mysql_close($con);
?>
</body>
</html> 
