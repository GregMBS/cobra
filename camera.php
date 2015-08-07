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
<title>Camera de Seguridad</title>
<meta http-equiv="refresh" content="60"/>
			<link rel="stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script> 
			<script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script> 
</head>
<body>
	<script>
		$(function() {
		$( "h1,a,button,#go" ).button();
	})
	</script>
<h2>CAMERA DE SEGURIDAD</h2>
<h3><?php echo date('c'); ?></h3>
<p>
<img src='capture1.jpg'>
</p>
<a href='reports.php?capt=<?php echo $capt; ?>'>Regresa a  reportes</a>
</body>
</html>
<?php
} 
}
mysql_close($con);
?>
