<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$go=mysql_real_escape_string($_REQUEST['go']);
if ($go=='INTRO') {
$CAMP=mysql_real_escape_string($_REQUEST['camp']);
$GESTOR=mysql_real_escape_string($_REQUEST['gestor']);
$queryupd="UPDATE nombres SET camp='".$CAMP."' where iniciales='".$GESTOR."';";
mysql_query($queryupd) or die(mysql_error());
};
if ($go=='BLOQUEAR') {
$CAMP=mysql_real_escape_string($_REQUEST['camp']);
$GESTOR=mysql_real_escape_string($_REQUEST['gestor']);
$queryupd="UPDATE queuelist SET bloqueado=1 
WHERE gestor='".$GESTOR."'
AND camp='".$CAMP."' 
;";
mysql_query($queryupd) or die(mysql_error());
};
if ($go=='DESBLOQUEAR') {
$CAMP=mysql_real_escape_string($_REQUEST['camp']);
$GESTOR=mysql_real_escape_string($_REQUEST['gestor']);
$queryupd="UPDATE queuelist SET bloqueado=0 
WHERE gestor='".$GESTOR."'
AND camp='".$CAMP."' 
;";
mysql_query($queryupd) or die(mysql_error());
};
if ($go=='INTRO TODOS') {
$QUEUE=mysql_real_escape_string($_REQUEST['queue']);
$queryupd="UPDATE nombres,queuelist SET nombres.camp=queuelist.camp 
where iniciales=gestor and concat_ws(',',cliente,sdc,status_aarsa)='".$QUEUE."';";
mysql_query($queryupd) or die(mysql_error());
};
if ($go=='BLOQUEAR TODOS') {
$QUEUE=mysql_real_escape_string($_REQUEST['queue']);
$queryupd="UPDATE queuelist SET bloqueado=1 
where concat_ws(',',cliente,sdc,status_aarsa)='".$QUEUE."';";
mysql_query($queryupd) or die(mysql_error());
};
if ($go=='DESBLOQUEAR TODOS') {
$QUEUE=mysql_real_escape_string($_REQUEST['queue']);
$queryupd="UPDATE queuelist SET bloqueado=0 
where concat_ws(',',cliente,sdc,status_aarsa)='".$QUEUE."';";
mysql_query($queryupd) or die(mysql_error());
};
$oldgestor='';
$querylist = "SELECT distinct gestor,tipo,nombres.camp FROM queuelist 
JOIN nombres ON gestor=iniciales 
WHERE tipo <> ''
ORDER BY gestor";
$resultlist = mysql_query($querylist) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Administraci&oacute;n de los queues</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 10pt; background-color: #00a0f0; color:#000000;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
       .blocked {font-style:italic; color:#ff0000;}
       #todobar {background-color:#20c0f0}
 </style>
</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<div style='clear:both;background-color:#ffffff;width:100%'>
<div style='float:left;width:25%'>Gestor</div>
<div style='float:left;width:50%'>Queue</div>
</div>
<div>
<div style='clear:both;border:1pt black solid'>
<form method='get' action='queues.php' name='todos'>
<div style='float:left;width:25%'>
<input name='gestor' type='text' readonly='readonly' value='todos'>
</div>
<div style='float:left;width:40%'>
<?php 
$queryq = "SELECT distinct cliente,sdc,status_aarsa,bloqueado
FROM queuelist
ORDER BY cliente,sdc,camp;";
$resultq = mysql_query($queryq) or die(mysql_error());
while($rowq = mysql_fetch_row($resultq)) {
$CLIENTE = $rowq[0];
$SDC = $rowq[1];
$CR = $rowq[2];
if ($CR=='.') {$CR='todos';};
$bloqueado = $rowq[3];
$campsel='';
?>
<input type='radio' name='queue' value='<?php echo $CLIENTE.','.$SDC.','.$CR;;?>' <?php if ($bloqueado==1) {echo "class='blocked'";}?>><?php echo $CLIENTE.'-'.$SDC.'-'.$CR;?><br>
<?php } ?>
</div>
<div style='float:left;width:30%'>
<input type="submit" name="go" value="INTRO TODOS"><br>
<input type="submit" name="go" value="BLOQUEAR TODOS"><br>
<input type="submit" name="go" value="DESBLOQUEAR TODOS">
</div>
<input type="hidden" name="capt" value="<?php echo $capt ?>"> 
</form>
</div>
<?php } ?>
</div>
<div>
<?php
while($rowlist = mysql_fetch_row($resultlist)) {
$GESTOR = $rowlist[0];
$tipo = $rowlist[1];
$campnow = $rowlist[2];
?>
<div style='clear:both;border:1pt black solid'>
<form method='get' action='queues.php' name='<?php echo $GESTOR;?>'>
<div style='float:left;width:25%'>
<input name='gestor' type='text' readonly='readonly' value='<?php echo $GESTOR;?>'>
</div>
<div style='float:left;width:40%'>
<?php 
$queryqc = "SELECT cliente,sdc,status_aarsa,nombres.camp
FROM queuelist,nombres 
WHERE gestor = '".$GESTOR."' and gestor=iniciales and nombres.camp=queuelist.camp
ORDER BY cliente,sdc,camp;";
$resultqc = mysql_query($queryqc) or die(mysql_error());
while($rowqc = mysql_fetch_row($resultqc)) {
$CLIENTEc = $rowqc[0];
$SDCc = $rowqc[1];
$CRc = $rowqc[2];
if ($CRc=='.') {$CRc='todos';};
$CAMPc = $rowqc[3];
echo $CLIENTEc.'-'.$SDCc.'-'.$CRc;
}
?>
<br>
<select name='camp'>
<?php 
$queryq = "SELECT cliente,sdc,status_aarsa,camp,bloqueado
FROM queuelist WHERE gestor = '".$GESTOR."'
ORDER BY cliente,sdc,camp;";
$resultq = mysql_query($queryq) or die(mysql_error());
while($rowq = mysql_fetch_row($resultq)) {
$CLIENTE = $rowq[0];
$SDC = $rowq[1];
$CR = $rowq[2];
if ($CR=='.') {$CR='todos';};
$CAMP = $rowq[3];
$bloqueado = $rowq[4];
$campsel='';
?>
<option value='<?php echo $CAMP;?>' <?php if ($bloqueado==1) {echo "class='blocked'";}?>><?php echo $CLIENTE.'-'.$SDC.'-'.$CR;?></option>
<?php } ?>
</select>
</div>
<div style='float:left;width:30%'>
<input type="submit" name="go" value="INTRO">
<input type="submit" name="go" value="BLOQUEAR">
<input type="submit" name="go" value="DESBLOQUEAR">
</div>
<input type="hidden" name="capt" value="<?php echo $capt ?>"> 
</form>
</div>
<?php } ?>
</div>
</body>
</html> 
<?php
}
mysql_close($con);
?>
