<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_GET['capt']);
setcookie('capt',$capt);
set_time_limit(300);
$querycheck="SELECT count(1),max(tipo) FROM nombres WHERE ticket='".$ticket."' AND iniciales='".$capt."';";
$resultcheck=mysql_query($querycheck) or die("ERROR UM1 - ".mysql_error());
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {
        $redirector = "Location: index.php";
        header($redirector);
}
else {
$mytipo=$answercheck[1];
$field=mysql_real_escape_string ($_GET['field']);
setcookie('field',$field);
$find=mysql_real_escape_string ($_GET['find']);
setcookie('find',$find);
$from=mysql_real_escape_string ($_GET['from']);
if (!empty($_GET['C_CONT'])) {
$C_CONT=mysql_real_escape_string ($_GET['C_CONT']);
}
$CLIENTE=mysql_real_escape_string ($_GET['cliente']);
setcookie('cliente',$CLIENTE);
$querymain="select c_cvba,mdf,sum(gest),sum(contact),sum(prom),count(distinct c_cvge),count(distinct c_cvge,hour(c_hrin))
from (
select c_cvba,month(d_fech) as mdf,c_cont,1 as tot,
max(if(c_msge is null,1,0)) as gest,
max(if(c_carg <>'',1,0)) as contact,
max(if(n_prom >0,1,0)) as prom,c_cvge,c_hrin
from historia where d_fech>=curdate()-interval 3 month 
and day(d_fech)<day(curdate())
and c_cont>0
group by c_cont,mdf) as tmp
group by c_cvba,mdf;
";
$result=mysql_query($querymain) or die(mysql_error);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Comparativo de 3 Meses</title>

			<link rel="stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script> 
			<script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script> 
			<script src="bower_components/datatables/media/js/jquery.dataTables.min.js" type="text/javascript"></script> 
<style>
tr.odd { background-color: white }
tr.even { background-color: #dddddd }
tr.now { background-color: yellow }
</style>

</head>
<body>
<script LANGUAGE="JavaScript" TYPE="text/JavaScript">
	$(function() {
		$( "input:submit, a, button" ).button();
		$( "body" ).css("font-size", "10pt")
		});	
</script>
<h1>COMPARATIVO</h1>
<button onClick="window.location='reports.php?capt=<?php echo $capt;?>'">Regresar al administraci&oacute;n</button>
<table summary="Cuentas" id='buscartab' class='ui-widget'>
<thead class='ui-widget-header'>
<tr>
<th>CLIENTE</th>
<th>MES</th>
<th>GESTIONES</th>
<th>CONTACTOS</th>
<th>% CONTACT</th>
<th>PROMESAS</th>
<th>% PROMESAS POR CONTACT</th>
<th>GESTORES</th>
<th>HORAS-HOMBRES</th>
</tr>
</thead>
<tbody class='ui-widget-content'>
<?php 
$class=array('now','odd','even');
$i=0;
while ($answer=mysql_fetch_row($result)) {
	$i=($i+1) % 3;
	$cliente=$answer[0];
	$mes=$answer[1];
	$gestiones=$answer[2];
	$contactos=$answer[3];
	$pc=round($contactos/$gestiones*100);
	$promesas=$answer[4];
	$pp=round($promesas/$contactos*100);
	$gestores=$answer[5];
	$manhours=$answer[6]; 
	?>
	<tr class='<?php echo $class[$i];?>'>
	<td><?php echo $cliente;?></td>
	<td><?php echo $mes;?></td>
	<td><?php echo $gestiones;?></td>
	<td><?php echo $contactos;?></td>
	<td><?php echo $pc;?>%</td>
	<td><?php echo $promesas;?></td>
	<td><?php echo $pp;?>%</td>
	<td><?php echo $gestores;?></td>
	<td><?php echo $manhours;?></td>
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
