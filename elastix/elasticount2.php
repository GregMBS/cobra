<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {mysql_close($con);}
else {
	$fout=9999;
$queryfout="select count(distinct folio)
from folios  
where usado=0 
and enviado=0 and cliente like 'Credito Si%' 
;";
$resultfout=mysql_query($queryfout) or die (mysql_error());
while ($answerfout=mysql_fetch_row($resultfout)) {$fout=$answerfout[0];}
mysql_close($con);
$host = "192.168.1.60:13306";
$user = "root";
$pswd = "eLaStIx.2oo7";
$db = "call_center";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pswd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$querya="SELECT queue,count(distinct phone),count(1),sum(fecha_llamada is not null),
estatus,sum(fecha_llamada>now()-interval 5 minute),sum(end_time>start_time),name,id_campaign
FROM calls,campaign,call_attribute
where campaign.id=id_campaign and datetime_end>=curdate() and calls.id=id_call 
and estatus='A'
group by id_campaign order by estatus,script";
//$resulta=mysql_query($querya) or die(mysql_error());
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>Elastix Queues</title>
			<link rel="stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script> 
			<script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script> 
			<script src="bower_components/datatables/media/js/jquery.dataTables.min.js" type="text/javascript"></script> 
<script  LANGUAGE="JavaScript" TYPE="text/JavaScript">
function foutpop() 
{
 alert('<?php echo 'Solo tenemos '.$fout.' folios disponible para Credito Si';?>');
}
</script>
</head>
<body onLoad="<?php if ($fout<10) {echo 'foutpop();';} ?>">
<script>
	var queue = new Array();
	queue[830]=1300;
	queue[831]=1500;
	queue[832]=2500;
	queue[833]=1100;
	queue[834]=1200;
	queue[836]=1400;
	queue[837]=1700;
	queue[838]=1800;
	queue[839]=1900;
	queue[841]=1000;
	queue[842]=2000;
	queue[843]=3000;
	queue[844]=4000;
	queue[845]=5000;
	queue[846]=6000;
	queue[847]=7000;
	queue[848]=8000;
	queue[849]=9000;
	$(function() {
		$( "#tabs" ).tabs();
		$( "button" ).button();
		$( "button" ).width("5cm");
		$( "button" ).height("2cm");
		$( "button" ).css("vertical-align", "bottom")
		$("#queues").dataTable({
				"sAjaxSource": "elasticount_ajax.php",
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
				$('td:eq(0)', nRow).html( queue[aData[0]] );
				$('td:eq(2)', nRow).css( 'text-align','right' );
				$('td:eq(3)', nRow).css( 'text-align','right' );
				$('td:eq(4)', nRow).css( 'text-align','right' );
				$('td:eq(5)', nRow).css( 'text-align','right' );
				$('td:eq(6)', nRow).css( 'text-align','right' );
			return nRow;
		},
				"bJQueryUI": true})
	});
</script>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<table summary='ACTUAL' id='queues'>
<thead>
<tr>
<th>Queue</th>
<th>Campa&ntilde;a</th>
<th>Tel&eacute;fonos</th>
<th>Cuentas</th>
<th>% Marcado</th>
<th>% Conectado</th>
<th>Status</th>
</tr>
</thead>
<tbody>
</tbody>
</table>

    </body>
    </html>
<?php 
}
}
mysql_close($con);
?>
