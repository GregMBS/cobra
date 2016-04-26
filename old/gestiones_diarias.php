<?php
$host = "localhost";
$user = "root";
$pwd = "DeathSta1";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_GET['capt']);
$updown='';
	 set_time_limit(300);
$querycheck="SELECT count(1) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."' AND tipo='admin';";
$resultcheck=mysql_query($querycheck);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$go='';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Reporte diario de Gestion</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#000000;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;border-collapse: collapse;}
     tr:hover {background-color: #ff0000;}
       th {border: 2pt solid #000000;background-color: #c0c0c0;}
       td {border: 1pt solid #000000;background-color: #c0c0c0;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
 </style>

</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<h2>GENERAL</h2>
<table summary="General">
<thead>
<tr>
<th>Ejecutivo</th>
<th>Horario</th>
<th>Gestiones Totales</th>
<th>Contactos</th>
<th>No contactos</th>
<th>% de Penetraci&oacute;n</th>
<th>PTP</th>
<th>% PTP</th>
</tr>
</thead>
<tbody>
<?php
$CG=0;
$SG=0;
$SC=0;
$SNC=0;
$SPTP=0;
$CT=3;
$query="select usuaria as 'Ajecutivo',turno as 'Horario',
count(1) as 'Gestiones Totales',sum(c_carg<>'') as 'Contactos',
sum(c_carg='') as 'No Contactos',sum(c_carg<>'')/count(1) as '% de Penetracion',
sum(q(c_cvst) like 'PR%') as 'PTP', 
sum(q(c_cvst) like 'PR%')/sum(c_carg<>'') as '% PTP'
from historia 
join nombres on c_cvge=iniciales
where week(d_fech)=week(curdate()-interval 1 week) 
and year(d_fech)=year(curdate()-interval 1 week) 
and c_cont>0 group by usuaria";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$GESTOR=$row[0];$CG++;
$TURNO=$row[1];
$GESTIONES=$row[2];$SG=$SG+$GESTIONES;
$CONTACTOS=$row[3];$SC=$SC+$CONTACTOS;
$NOCONTACTOS=$row[4];$SNC=$SNC+$NOCONTACTOS;
$PCP=number_format($row[5]*100,0);$SPCP=number_format($SC/$SG*100,0);
$PTP=$row[6];$SPTP=$SPTP+$PTP;
$PCPTP=number_format($row[7]*100,0);$SPCPTP=number_format($SPTP/$SC*100,0);
?>
<tr>
<td><?php echo $GESTOR;?></td>
<td><?php echo $TURNO;?></td>
<td class="num"><?php echo $GESTIONES;?></td>
<td class="num"><?php echo $CONTACTOS;?></td>
<td class="num"><?php echo $NOCONTACTOS;?></td>
<td class="num">%<?php echo $PCP;?></td>
<td class="num"><?php echo $PTP;?></td>
<td class="num">%<?php echo $PCPTP;?></td>
</tr>
<?php } ?>
<tr>
<th><?php echo $CG;?> GESTORES</th>
<th><?php echo $CT;?> TURNOS</th>
<th class="num"><?php echo $SG;?></th>
<th class="num"><?php echo $SC;?></th>
<th class="num"><?php echo $SNC;?></th>
<th class="num">%<?php echo $SPCP;?></th>
<th class="num"><?php echo $SPTP;?></th>
<th class="num">%<?php echo $SPCPTP;?></th>
</tr>
</tbody>
</table>
<h2>CR&Eacute;DITO S&Iacute;</h2>
<table summary="Credito Si">
<thead>
<tr>
<th>Ejecutivo</th>
<th>Horario</th>
<th>Gestiones Totales</th>
<th>Contactos</th>
<th>No contactos</th>
<th>% de Penetraci&oacute;n</th>
<th>PTP</th>
<th>% PTP</th>
</tr>
</thead>
<tbody>
<?php
$CG=0;
$SG=0;
$SC=0;
$SNC=0;
$SPTP=0;
$CT=3;
$query="select usuaria as 'Ajecutivo',turno as 'Horario',
count(1) as 'Gestiones Totales',sum(c_carg<>'') as 'Contactos',
sum(c_carg='') as 'No Contactos',sum(c_carg<>'')/count(1) as '% de Penetracion',
sum(q(c_cvst) like 'PR%') as 'PTP', 
sum(q(c_cvst) like 'PR%')/sum(c_carg<>'') as '% PTP'
from historia 
join nombres on c_cvge=iniciales
where week(d_fech)=week(curdate()-interval 1 week) 
and year(d_fech)=year(curdate()-interval 1 week) 
and c_cont>0 
and c_cvba='Credito Si'
group by usuaria";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$GESTOR=$row[0];$CG++;
$TURNO=$row[1];
$GESTIONES=$row[2];$SG=$SG+$GESTIONES;
$CONTACTOS=$row[3];$SC=$SC+$CONTACTOS;
$NOCONTACTOS=$row[4];$SNC=$SNC+$NOCONTACTOS;
$PCP=number_format($row[5]*100,0);$SPCP=number_format($SC/$SG*100,0);
$PTP=$row[6];$SPTP=$SPTP+$PTP;
$PCPTP=number_format($row[7]*100,0);$SPCPTP=number_format($SPTP/$SC*100,0);
?>
<tr>
<td><?php echo $GESTOR;?></td>
<td><?php echo $TURNO;?></td>
<td class="num"><?php echo $GESTIONES;?></td>
<td class="num"><?php echo $CONTACTOS;?></td>
<td class="num"><?php echo $NOCONTACTOS;?></td>
<td class="num">%<?php echo $PCP;?></td>
<td class="num"><?php echo $PTP;?></td>
<td class="num">%<?php echo $PCPTP;?></td>
</tr>
<?php } ?>
<tr>
<th><?php echo $CG;?> GESTORES</th>
<th><?php echo $CT;?> TURNOS</th>
<th class="num"><?php echo $SG;?></th>
<th class="num"><?php echo $SC;?></th>
<th class="num"><?php echo $SNC;?></th>
<th class="num">%<?php echo $SPCP;?></th>
<th class="num"><?php echo $SPTP;?></th>
<th class="num">%<?php echo $SPCPTP;?></th>
</tr>
</tbody>
</table>
<h2>PR&Eacute;STAMO REL&Aacute;MPAGO</h2>
<table summary="Prestamo Relampago">
<thead>
<tr>
<th>Ejecutivo</th>
<th>Horario</th>
<th>Gestiones Totales</th>
<th>Contactos</th>
<th>No contactos</th>
<th>% de Penetraci&oacute;n</th>
<th>PTP</th>
<th>% PTP</th>
</tr>
</thead>
<tbody>
<?php
$CG=0;
$SG=0;
$SC=0;
$SNC=0;
$SPTP=0;
$CT=2;
$query="select usuaria as 'Ajecutivo',turno as 'Horario',
count(1) as 'Gestiones Totales',sum(c_carg<>'') as 'Contactos',
sum(c_carg='') as 'No Contactos',sum(c_carg<>'')/count(1) as '% de Penetracion',
sum(q(c_cvst) like 'PR%') as 'PTP', 
sum(q(c_cvst) like 'PR%')/sum(c_carg<>'') as '% PTP'
from historia 
join nombres on c_cvge=iniciales
where week(d_fech)=week(curdate()-interval 1 week) 
and year(d_fech)=year(curdate()-interval 1 week) 
and c_cont>0 
and c_cvba='Prestamo Relampago'
group by usuaria";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$GESTOR=$row[0];$CG++;
$TURNO=$row[1];
$GESTIONES=$row[2];$SG=$SG+$GESTIONES;
$CONTACTOS=$row[3];$SC=$SC+$CONTACTOS;
$NOCONTACTOS=$row[4];$SNC=$SNC+$NOCONTACTOS;
$PCP=number_format($row[5]*100,0);$SPCP=number_format($SC/$SG*100,0);
$PTP=$row[6];$SPTP=$SPTP+$PTP;
$PCPTP=number_format($row[7]*100,0);$SPCPTP=number_format($SPTP/$SC*100,0);
?>
<tr>
<td><?php echo $GESTOR;?></td>
<td><?php echo $TURNO;?></td>
<td class="num"><?php echo $GESTIONES;?></td>
<td class="num"><?php echo $CONTACTOS;?></td>
<td class="num"><?php echo $NOCONTACTOS;?></td>
<td class="num">%<?php echo $PCP;?></td>
<td class="num"><?php echo $PTP;?></td>
<td class="num">%<?php echo $PCPTP;?></td>
</tr>
<?php } ?>
<tr>
<th><?php echo $CG;?> GESTORES</th>
<th><?php echo $CT;?> TURNOS</th>
<th class="num"><?php echo $SG;?></th>
<th class="num"><?php echo $SC;?></th>
<th class="num"><?php echo $SNC;?></th>
<th class="num">%<?php echo $SPCP;?></th>
<th class="num"><?php echo $SPTP;?></th>
<th class="num">%<?php echo $SPCPTP;?></th>
</tr>
</tbody>
</table>
<h2>SURTIDOR DEL HOGAR</h2>
<table summary="Surtidor del Hogar">
<thead>
<tr>
<th>Ejecutivo</th>
<th>Horario</th>
<th>Gestiones Totales</th>
<th>Contactos</th>
<th>No contactos</th>
<th>% de Penetraci&oacute;n</th>
<th>PTP</th>
<th>% PTP</th>
</tr>
</thead>
<tbody>
<?php
$CG=0;
$SG=0;
$SC=0;
$SNC=0;
$SPTP=0;
$CT=2;
$query="select usuaria as 'Ajecutivo',turno as 'Horario',
count(1) as 'Gestiones Totales',sum(c_carg<>'') as 'Contactos',
sum(c_carg='') as 'No Contactos',sum(c_carg<>'')/count(1) as '% de Penetracion',
sum(q(c_cvst) like 'PR%') as 'PTP', 
sum(q(c_cvst) like 'PR%')/sum(c_carg<>'') as '% PTP'
from historia 
join nombres on c_cvge=iniciales
where week(d_fech)=week(curdate()-interval 1 week) 
and year(d_fech)=year(curdate()-interval 1 week) 
and c_cont>0 
and c_cvba='Surtidor del Hogar'
group by usuaria";
$result=mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_row($result)) {
$GESTOR=$row[0];$CG++;
$TURNO=$row[1];
$GESTIONES=$row[2];$SG=$SG+$GESTIONES;
$CONTACTOS=$row[3];$SC=$SC+$CONTACTOS;
$NOCONTACTOS=$row[4];$SNC=$SNC+$NOCONTACTOS;
$PCP=number_format($row[5]*100,0);$SPCP=number_format($SC/$SG*100,0);
$PTP=$row[6];$SPTP=$SPTP+$PTP;
$PCPTP=number_format($row[7]*100,0);$SPCPTP=number_format($SPTP/$SC*100,0);
?>
<tr>
<td><?php echo $GESTOR;?></td>
<td><?php echo $TURNO;?></td>
<td class="num"><?php echo $GESTIONES;?></td>
<td class="num"><?php echo $CONTACTOS;?></td>
<td class="num"><?php echo $NOCONTACTOS;?></td>
<td class="num">%<?php echo $PCP;?></td>
<td class="num"><?php echo $PTP;?></td>
<td class="num">%<?php echo $PCPTP;?></td>
</tr>
<?php } ?>
<tr>
<th><?php echo $CG;?> GESTORES</th>
<th><?php echo $CT;?> TURNOS</th>
<th class="num"><?php echo $SG;?></th>
<th class="num"><?php echo $SC;?></th>
<th class="num"><?php echo $SNC;?></th>
<th class="num">%<?php echo $SPCP;?></th>
<th class="num"><?php echo $SPTP;?></th>
<th class="num">%<?php echo $SPCPTP;?></th>
</tr>
</tbody>
</table>
<?php   
}
}
mysql_close($con);
?>
</body>
</html> 
