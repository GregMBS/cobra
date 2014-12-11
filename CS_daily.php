<?php
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");
include('admin_hdr.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Credito Si Auditario</title>
			<link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="vendor/components/jquery/jquery.js" type="text/javascript"></script> 
			<script src="vendor/components/jqueryui/jquery-ui.js" type="text/javascript"></script> 
</head>
<body>
<h2><?php echo date(); ?></h2>
<table summary="LpH" class="ui-widget">
<thead class="ui-widget-header">
<tr>
<th>Gestor</th>
<th>Cliente</th>
<th>Hora</th>
</tr>
</thead>
<tbody class="ui-widget-content">
<?php 
$queryaud="select c_cvge,c_cvba,c_hrin
from historia
where c_cvba like 'credito%'
and d_fech=curdate()
order by c_cvge,c_hrin;";
$resultaud = mysql_query($queryaud) or die(mysql_error());
while ($answeraud = mysql_fetch_row($resultaud)) {
$gestor=$answeraud[0];
$cliente=$answeraud[1];
$hora=$answeraud[2];
?>
<tr>
	<td><?php echo $gestor;?></td>
	<td><?php echo $cliente;?></td>
	<td><?php echo $hora;?></td>
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
