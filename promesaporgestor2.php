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
<h2>Mes actual</h2>
<table summary="Por gestor este mes">
<thead>
<tr>
<th>Gestor</th>
<th>Credito Si</th>
<th>Prestamo Relampago</th>
<th>Stanhome</th>
<th>Surtidor del Hogar</th>
<th>UR</th>
<th>Vanguardia</th>
</tr>
</thead>
<tbody>
<?php
$SCS=0;
$SSH=0;
$SUR=0;
$SVG=0;
$query="select who(c_cvge),
sum(np*(c_cvba='Credito Si')*(status_de_credito = '270s')), 
sum(np*(c_cvba='Credito Si')*(status_de_credito = '360s')), 
sum(np*(c_cvba='Credito Si')*(status_de_credito = '720s')), 
sum(np*(c_cvba='Credito Si')*(status_de_credito like '%0s')),
sum(np*(c_cvba='Prestamo Relampago')), 
sum(np*(c_cvba='Stanhome')), 
sum(np*(c_cvba='Surtidor del Hogar')), 
sum(np*(c_cvba='UR')), 
sum(np*(c_cvba='Vanguardia'))
from resumen 
join (select c_cvge,c_cvba,c_cont,
substring_index(group_concat(n_prom order by d_fech desc),',',1) as np 
from historia where d_prom>=curdate() and c_cniv is null
and d_fech>last_day(curdate()-interval 38 day)
group by c_cvge,c_cont) as tmp
on c_cont=id_cuenta 
group by c_cvge";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$GESTOR=$row[0];
$MONTOCS270=number_format($row[1],2);
$MONTOCS360=number_format($row[2],2);
$MONTOCS720=number_format($row[3],2);
$MONTOCS=number_format($row[4],2);
$MONTOPR=number_format($row[5],2);
$MONTOSDH=number_format($row[7],2);
$MONTOSH=number_format($row[6],2);
$MONTOUR=number_format($row[8],2);
$MONTOVG=number_format($row[9],2);
$SCS270=$SCS270+$row[1];
$SCS360=$SCS360+$row[2];
$SCS720=$SCS720+$row[3];
$SCS=$SCS+$row[4];
$SPR=$SPR+$row[5];
$SSDH=$SSDH+$row[7];
$SSH=$SSH+$row[6];
$SUR=$SUR+$row[8];
$SVG=$SVG+$row[9];
?>
<tr>
<td><?php echo $GESTOR;?></td>
<!--
<td class="num"><?php echo $MONTOCS270;?></td>
<td class="num"><?php echo $MONTOCS360;?></td>
<td class="num"><?php echo $MONTOCS720;?></td>
-->
<td class="numcs"><?php echo $MONTOCS;?></td>
<td class="numpr"><?php echo $MONTOPR;?></td>
<td class="numw"><?php echo $MONTOSH;?></td>
<td class="numsdh"><?php echo $MONTOSDH;?></td>
<td class="numw"><?php echo $MONTOUR;?></td>
<td class="numw"><?php echo $MONTOVG;?></td>
</tr>
<?php } ?>
<tr>
<th>SUM</th>
<!--
<th class="num"><?php echo number_format($SCS270,2);?></th>
<th class="num"><?php echo number_format($SCS360,2);?></th>
<th class="num"><?php echo number_format($SCS720,2);?></th>
-->
<th class="num"><?php echo number_format($SCS,2);?></th>
<th class="num"><?php echo number_format($SPR,2);?></th>
<th class="num"><?php echo number_format($SSH,2);?></th>
<th class="num"><?php echo number_format($SSDH,2);?></th>
<th class="num"><?php echo number_format($SUR,2);?></th>
<th class="num"><?php echo number_format($SVG,2);?></th>
</tr>
</tbody>
</table>
<h2>Detalles</h2>
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
</tr>
</thead>
<tbody>
<?php
$query="select c_cvge as 'gestor', c_cvba as 'cliente', status_de_credito, 
q(status_aarsa) as queue, cuenta, status_aarsa as 'status de cuenta', 
c_cvst as 'status de gestion', n_prom1, d_prom1, n_prom2, d_prom2 
from historia join resumen on c_cont=id_cuenta 
join lastprom on date(promdate)=d_fech and time(promdate)=c_hrin
and lastprom.c_cont=historia.c_cont
where d_fech>last_day(curdate()-interval 5 week) 
and d_prom>=curdate()
and c_cniv is null
order by c_cvge,CUENTA";
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
</tr>
<?php } ?>
</tbody>
</table>
<?php   
}
}
mysql_close($con);
?>
</body>
</html> 
