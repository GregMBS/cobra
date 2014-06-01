<?php
include('usuario_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$mytipo=$answercheck[1];
$go=mysql_real_escape_string($_REQUEST['go']);
$GESTOR=mysql_real_escape_string($_REQUEST['capt']);
$msg="";
if ($go=='INTRO') {
$camp=-1;
$cliente=mysql_real_escape_string($_REQUEST['cliente']);
$sdc=mysql_real_escape_string($_REQUEST['segmento']);
if (empty($sdc)) {$sdc='';}
$queue=mysql_real_escape_string($_REQUEST['queue']);
$queryqueue="select camp from queuelist 
where cliente='".$cliente."' 
and status_aarsa='".$queue."' 
and sdc='".$sdc."' 
and gestor='".$GESTOR."' 
and bloqueado=0 limit 1
";
$resultqueue=mysql_query($queryqueue) or die(mysql_error());
while($answerqueue = mysql_fetch_row($resultqueue)) {$camp=$answerqueue[0];}
if ($camp>=0) {	
$queryupd="UPDATE nombres SET camp='".$camp."' where iniciales='".$GESTOR."';";
mysql_query($queryupd) or die(mysql_error());
$msg="<h2>Se elige queue ".$cliente." ".$sdc." ".$queue."</h2>";}
}
else {$msg="<h2>Se elige queue bloqueado o equivocado.</h2>";}
}
$arrayc='[';
$arrays='[';
$arrayq='[';
$queryc = "SELECT distinct cliente
FROM queuelist where cliente<>''
ORDER BY cliente;";
$resultc = mysql_query($queryc) or die(mysql_error());
while($rowc = mysql_fetch_array($resultc)) {
	$arrayc=$arrayc.'"';
	$arrayc=$arrayc.$rowc[0].'",';
	}; 
$arrayc=$arrayc.']';	
$querys = "SELECT distinct sdc,cliente
FROM queuelist WHERE gestor = '".$GESTOR."' and bloqueado=0 and cliente<>''
ORDER BY cliente,sdc,status_aarsa;";
$results = mysql_query($querys) or die(mysql_error());
while($rows = mysql_fetch_array($results)) {
	$arrays=$arrays.'["';
	$arrays=$arrays.$rows[0].'","'.$rows[1].'"],';
	}; 
$arrays=rtrim($arrays,',').']';	
$queryq = "SELECT distinct status_aarsa,sdc,cliente
FROM queuelist WHERE gestor = '".$GESTOR."' and bloqueado=0
ORDER BY cliente,sdc,status_aarsa;";
$resultq = mysql_query($queryq) or die(mysql_error());
while($rowq = mysql_fetch_row($resultq)) {
	$arrayq=$arrayq.'["';
	$arrayq=$arrayq.$rowq[0].'","'.$rowq[1].'","'.$rowq[2].'"],';
	}; 
$arrayq=rtrim($arrayq,',').']';	
}
mysql_close($con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Sus queues</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
			<link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="js/jquery-1.5.1.min.js" type="text/javascript"></script> 
			<script src="js/jquery-ui-1.8.13.custom.min.js" type="text/javascript"></script> 
			<script src="DT/media/js/jquery.dataTables.min.js" type="text/javascript"></script> 
</head>
<body>
<script>
	$(function() {
		$( "button" ).button();
		$( "#intro" ).button();
		$( "#cliente" ).empty();
		$( "#segmento" ).empty();
		$( "#queue" ).empty();
		$( "body" ).css("font-size", "10pt");
		$( "body" ).css("text-align", "center");
		$( "#cliente" ).css("text-align", "left");
		$( "div" ).css("float", "left");
		$( ".introb" ).css("clear", "left");
		$.each(<?php echo $arrayc; ?>, function(index, value) { 
			var data='<div class="column"><input class="columnc" type="radio" name="cliente" value="'+value+'" />'+value+'</div>';
			$('#cliente').append(data); 
		});
		$("#cliente").change(function() {
		$( "#segmento" ).empty();
		$( "#queue" ).empty();
			var data2=$('input[name=cliente]:checked').val();
			$.each(<?php echo $arrays; ?>, function(index, sdc) { 
			if (sdc[1]==data2) {
				var st=sdc[0];
				if (st=='') {st='TODOS';}
				data3='<div class="column"><input class="columns" type="radio" name="segmento" value="'+sdc[0]+'" />'+st+'</div>';
				$('#segmento').append(data3); 
			}})
		$( "#segmento" ).css("text-align", "left");
		});
		$("#segmento").change(function() {
		$( "#queue" ).empty();
			var data2=$('input[name=cliente]:checked').val();
			var data4=$('input[name=segmento]:checked').val();
			$.each(<?php echo $arrayq; ?>, function(index, que) { 
			if ((que[1]+que[2])==(data4+data2)) {
				var qt=que[0];
				if (qt=='') {qt='TODOS';}
				data5='<div class="column"><input class="columnq" type="radio" name="queue" value="'+que[0]+'" />'+qt+'</div>';
				$('#queue').append(data5); 
			}})
		$( "#queue" ).css("text-align", "left");
		});
});
</script>
<?php echo $msg; ?>
<div>
<form method='get' action='#' name='<?php echo $GESTOR;?>'>
<div>
<input name='gestor' type='text' readonly='readonly' value='<?php echo $GESTOR;?>'>
</div>
<div>
<br>
<div>CLIENTE<br>
<div id='cliente'>
 </div>
 </div>
 <div>SEGMENTO<BR>
<div id='segmento'>
 </div>
 </div>
<div>QUEUE<BR>
<div id='queue'>
</div>
</div>
<div class='introb'>
<input type="submit" name="go" id="intro" value="INTRO">
</div>
<input type="hidden" name="capt" value="<?php echo $capt ?>"> 
</form>
</div>
</div>
<div class='introb'>
<button onclick="window.location='resumen.php?capt=<?php echo $capt;?>'">Cuentas</button>
</div>
</body>
</html> 
