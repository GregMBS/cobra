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
$csdc=mysql_real_escape_string($_REQUEST['csdc']);
$csdcs = explode("y", $csdc);
$cliente=$csdcs[0];
$sdc=$csdcs[1];
if ($sdc=='MORA4 ') {$sdc='MORA4+';}
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Sus queues</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 10pt; background-color: #00a0f0; color:#000000;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
       .blocked {font-style:italic; color:#ff0000;}
       #todobar {background-color:#20c0f0}
       td {vertical-align:top; border:1pt black solid;}
 </style>
</head>
<body>
<?php echo $msg; ?>
<div>
<div style='clear:both;border:1pt black solid'>
<form method='get' action='#' name='<?php echo $GESTOR;?>'>
<div style='float:left;width:25%'>
<input name='gestor' type='text' readonly='readonly' value='<?php echo $GESTOR;?>'>
</div>
<div style='float:left;width:40%'>
<br>
<table>
	<tr>
	<td>SEGMENTO<br>
<?php $queryq = "SELECT distinct cliente,sdc
FROM queuelist WHERE gestor = '".$GESTOR."' and bloqueado=0
ORDER BY cliente,sdc;";
$resultq = mysql_query($queryq) or die(mysql_error());
while($rowq = mysql_fetch_row($resultq)) {
$CLIENTE = $rowq[0];
$Ct =$CLIENTE;
if ($Ct=='') {$Ct='TODOS';}
$SDC = $rowq[1];
$SDCt =$SDC;
if ($SDCt=='') {$SDCt='TODOS';}
echo $Ct.' '.$SDCt;?>
<input type='radio' name='csdc' value='<?php echo $CLIENTE.'y'.$SDC; ?>'><br>
 <?php } ?>
 </td>
<td>QUEUE<BR>
<?php $queryq2 = "SELECT distinct status_aarsa
FROM queuelist WHERE gestor = '".$GESTOR."' and bloqueado=0
ORDER BY status_aarsa;";
$resultq2 = mysql_query($queryq2) or die(mysql_error());
while($rowq2 = mysql_fetch_row($resultq2)) {
$QUEUE = $rowq2[0];
echo $QUEUE;?>
<input type='radio' name='queue' value='<?php echo $QUEUE; ?>'><br>
 <?php } ?>
 </td>
	</tr>
</table>
</div>
<div style='float:left;width:30%'>
<input type="submit" name="go" value="INTRO">
</div>
<input type="hidden" name="capt" value="<?php echo $capt ?>"> 
</form>
</div>
<?php } ?>
</div>
<button onclick="window.location='resumen.php?capt=<?php echo $capt;?>'">Cuentas</button>
</body>
</html> 
<?php
mysql_close($con);
?>
