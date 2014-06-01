<?php
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pwd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$capt=mysql_real_escape_string($_GET['capt']);
setcookie('capt',$capt);
     $local=explode('.',gethostbyaddr($_SERVER['REMOTE_ADDR']));
	$queryl="delete from userlog where usuario='".$local[0]."';";
	$resultl = mysql_query($queryl) or die("ERROR BM1 - ".mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Breaks del Hoy</title>
<meta http-equiv="refresh" content="15"/>
			<link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="js/jquery-1.5.1.min.js" type="text/javascript"></script> 
			<script src="js/jquery-ui-1.8.13.custom.min.js" type="text/javascript"></script> 
			<script src="DT/media/js/jquery.dataTables.min.js" type="text/javascript"></script> 
</head>
<body>
<script>
	$(function() {
		$( "button" ).button();
		$( "button" ).width("5cm");
		$( "button" ).height("2cm");
		$( "button" ).css("vertical-align", "bottom")
		$( "body" ).css("font-size", "10pt")
		$( "body" ).css("text-align", "center")
		$('#breakstab').dataTable({
			"sAjaxSource": "breaks_ajax.php",
			"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			if (aData[5]) {
				$('td', nRow).css( 'font-weight','normal' );
			}
			else {
				$('td', nRow).css( 'font-weight','bold' );
			}
			return nRow;
		},
			"bJQueryUI": true
			});
	});
</script>
<button onclick="window.location='index.php'">LOGIN</button><br>
<table summary="Braeks" id='breakstab'>
<thead>
<tr>
<th>Gestor</th>
<th>Tipo</th>
<th>de</th>
<th>a</th>
<th>Minutes</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
</body>
</html>
<?php   
mysql_close($con);
?>
