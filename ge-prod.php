<?php
$desp = array("domingo","lunes","martes","miércoles","jueves","viernes","sábado");
include('admin_hdr.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$yr=date('Y');
$mes=date('m');
$dhoy=date('d');
$hoy=date('Y-m-d');
	
$dst='';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Sumerio de Operaciones</title>
<meta http-equiv="refresh" content="900"/>
<style type="text/css">
</style>
</head>
<body>
<table summary="LpH">
<thead>
<tr>
<th colspan=2>PRIMERA ASIG.</th>
<th>1.- DIALER EFICIENCY</th>
<th>   1.0 Total Download</th>
<th>   1.1 Total Dials</th>
<th>   1.2 Total Connects</th>
<th>   1.3 Total RPC's</th>
<th>   1.4 Total PTP´s</th>
<th>   1.5  Total System Hours</th>
<th>   1.6  Penetration Rate</th>
<th>   1.7  Connect  Rate</th>
<th>   1.8 RPC Rate</th>
<th>   1.9 Agentes</th>
<th>2.- DIALER COLLECTOR EFFICIENCY</th>
<th>   2.0 Promise Rate</th>
<th>   2.1 Kept Promise</th>
<th>3.- DOOR TO DOOR</th>
<th>   3.0  Visits</th>
<th>   3.1  Visits/Accs.</th>
<th>   3.2   % RPC/Accs. </th>
<th>   3.3  % PTP/RPC</th>
</tr>
</thead>
<tbody>
<?php 
$querydown='select count(1) from resumen
where cliente="GE Capital" and fecha_de_actualizacion>last_day(curdate()-interval 5 week);';
$resultdown = mysql_query($querydown) or die(mysql_error());
while ($answerdown = mysql_fetch_row($resultdown)) {$download=$answerdown[0];}
$queryop="select d_fech,sum(c_tele is not null) as Dial,sum(c_carg<>'' and c_tele is not null) as Connect, 
sum(c_carg='Deudor' and c_tele is not null) as RPC, sum(n_prom>0 and c_tele is not null) as PTP, 
count(distinct hour(c_hrin),c_cvge) as 'System Hours', 
sum(c_carg<>'' and c_tele is not null)/sum(c_tele is not null) as 'Connect Rate',
sum(c_carg='Deudor' and c_tele is not null)/sum(c_carg<>'' and c_tele is not null) as 'RPC Rate', 
count(distinct c_cvge) as Agentes,
sum(n_prom>0 and c_tele is not null)/sum(c_carg='Deudor' and c_tele is not null) as 'Promise Rate', 
sum(exists (select * from pagos where c_cont=id_cuenta and fecha>last_day(curdate()-interval 5 week)))/sum(n_prom>0 and c_tele is not null),
sum(c_visit is not null) as Visits,
sum(c_carg='Deudor' and c_visit is not null)/sum(c_visit is not null) as vRPC,
sum(n_prom>0 and c_visit is not null)/(sum(c_carg='Deudor' and c_visit is not null)+0.001) as vPTP
from historia
where c_cvba='GE Capital' and d_fech>last_day(curdate()-interval 5 week)
group by d_fech";
$resultop = mysql_query($queryop) or die(mysql_error());
while ($answerop = mysql_fetch_row($resultop)) {
$date = new DateTime($answerop[0]);
$fech=$date->format('d-m');
$dow=$desp[$date->format('w')];
$dial=$answerop[1];
$connect=$answerop[2];
$RPC=$answerop[3];
$PTP=$answerop[4];
$shours=$answerop[5];
$penetration=round($dial/$download*100)."%";
$crate=round($answerop[6]*100)."%";
$rrate=round($answerop[7]*100)."%";
$agentes=$answerop[8];
$prate=round($answerop[9]*100)."%";
$krate=$answerop[10];
$visits=$answerop[11];
$vrate=round($visits/$download*100)."%";
$vRPC=round($answerop[12]*100)."%";
$vPTP=round($answerop[13]*100)."%";
?>
<tr>
<td><?php echo($fech); ?></td>
<td><?php echo($dow); ?></td>
<td>&nbsp;</td>
<td><?php echo($download); ?></td>
<td><?php echo($dial); ?></td>
<td><?php echo($connect); ?></td>
<td><?php echo($RPC); ?></td>
<td><?php echo($PTP); ?></td>
<td><?php echo($shours); ?></td>
<td><?php echo($penetration); ?></td>
<td><?php echo($crate); ?></td>
<td><?php echo($rrate); ?></td>
<td><?php echo($agentes); ?></td>
<td>&nbsp;</td>
<td><?php echo($prate); ?></td>
<td><?php echo($krate); ?></td>
<td>&nbsp;</td>
<td><?php echo($visits); ?></td>
<td><?php echo($vrate); ?></td>
<td><?php echo($vRPC); ?></td>
<td><?php echo($vPTP); ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</body>
</html>
<?php
} 
}
mysql_close($con);
?>
