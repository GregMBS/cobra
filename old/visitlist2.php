<?php 
$host = "localhost";
$user = "root";
$pwd = "DeathSta1";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = (mysql_connect($host, $user, $pwd)) or die ("Could not connect to MySQL");
mysql_query("USE $db") or die ("Could not select $db database");
	 set_time_limit(300);
$ticket=mysql_real_escape_string($_COOKIE['auth']);
$capt=mysql_real_escape_string($_GET['capt']);
$id_cuenta=mysql_real_escape_string($_GET['id_cuenta']);
setcookie('id_cuenta',$id_cuenta);
$queryg = "SELECT usuaria,tipo FROM nombres join grupos on tipo=grupo 
WHERE iniciales = '".$capt."';";
$resultg = mysql_query($queryg) or die(mysql_error());
while($answerg = mysql_fetch_row($resultg)) {$mynombre=$answerg[0];$mytipo=$answerg[1];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Visitas</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<link rel="stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script> 
			<script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script> 
			<script src="bower_components/datatables/media/js/jquery.dataTables.min.js" type="text/javascript"></script> 
<style>
tr.odd { background-color: white }
tr.even { background-color: #dddddd }
</style>
</head>
<body>
<script LANGUAGE="JavaScript" TYPE="text/JavaScript">
	$(function() {
		$( "input:submit, a, button" ).button();
		$('#historyhead').dataTable({
			"sAjaxSource": "visitlist_ajax.php",
			"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
				$('td:eq(1)', nRow).html(aData[1]+' '+aData[5]);
				$('td:eq(3)', nRow).attr('title',aData[4]);
				return nRow;
			},
			"bJQueryUI": true
				})
		});	
</script>
<div id="historybox">
<table summary="historiahead" id="historyhead">
<thead>
<tr>
<th>Status</th>
<th>Fecha/Hora</th>
<th>Visitador</th>
<th>Gestion</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
<button onClick='window.close()'>CIERRA</button>
<?php   
mysql_close($con);
?>
</body>
</html> 


