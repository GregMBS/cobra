<?php
//require "AsteriskManager.php";
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
if (!empty($_GET['killall'])) {
$queryk="UPDATE robot.msglist 
SET lineas=0";
mysql_query($queryk) or die(mysql_error());
}
if (!empty($_GET['cleanslate'])) {
$queryk="truncate robot.calllist";
mysql_query($queryk) or die(mysql_error());
}
if (!empty($_GET['countreset'])) {
$queryk="UPDATE robot.calllist 
SET turno=0";
mysql_query($queryk) or die(mysql_error());
}
if (!empty($_GET['auto'])) {
	$process=$_GET['lines'];
	if ($process=='CAMBIAR') {
		$auto=mysql_real_escape_string($_GET['auto']);
		$lineas=mysql_real_escape_string($_GET['lineas']);
		$queryu="UPDATE robot.msglist 
		SET lineas=".($lineas+0.0)."
		WHERE auto=".$auto;
		mysql_query($queryu) or die(mysql_error());
	}
        if ($process=='BORRAR') {
                $msg=mysql_real_escape_string($_GET['auto']);
                $queryd="DELETE FROM robot.calllist
                WHERE msg='".$msg."';";
                mysql_query($queryd) or die(mysql_error());
        }

}
$querya="select rc.msg,count(distinct trim(id)),count(distinct tel), lineas, 
sum(turno>0)/count(1)*100, sum(1)
from robot.calllist rc ignore index (callfile) join robot.msglist rm 
on rc.msg regexp rm.msg
group by rc.msg";
$resulta=mysql_query($querya) or die(mysql_error());
$params = array('server' => '192.168.0.102', 'port' => '5038');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>ROBOT Control</title>
			<link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="js/jquery-1.5.1.min.js" type="text/javascript"></script> 
			<script src="js/jquery-ui-1.8.13.custom.min.js" type="text/javascript"></script> 
<style>
	div {float:left;}
</style>
</head>
<body>
<script>
	$(function() {
		$( "button" ).button();
		$( "input[type=submit]" ).button();
	});
</script>	
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<div>
<table summary='ACTUAL' class="ui-widget">
<thead class="ui-widget-header">
<tr>
<th>Cliente</th>
<th>Cuentas</th>
<th>Tel&eacute;fonos</th>
<th>Registros</th>
<th>Lineas</th>
<th>% Marcado</th>
<th>Horas rest.</th>
</tr>
</thead>
<tbody class="ui-widget-content">
	<?php 
while ($rowa=mysql_fetch_row($resulta)) {
$client=$rowa[0];
$ctas=$rowa[1];
$tels=$rowa[2];
$lins=$rowa[3];
$regs=$rowa[5];
$pc=$rowa[4]."%";
$rest='0';
$tiempo='N/A';
if ($lins>0) {
$rest=(100-$rowa[4])/100*$regs/60/$lins;
$resth=floor($rest);
$restm=sprintf('%02d',round(($rest-$resth)*60));
$tiempo=$resth.":".$restm;
}
?>
<tr>
<td><?php echo $client; ?></td>
<td class="num"><?php echo $ctas; ?></td>
<td class="num"><?php echo $tels; ?></td>
<td class="num"><?php echo $regs; ?></td>
<td class="num"><?php echo $lins; ?></td>
<td class="num"><?php echo $pc; ?></td>
<td class="num"><?php echo $tiempo; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<div>
<form action='#' method='get' name='kills'>
<input type='hidden' name='capt' value='<?php echo $capt; ?>'>
<input type='submit' name='killall' value='PARAR TODOS'>
</form>
<form action='#' method='get' name='resets'>
<input type='hidden' name='capt' value='<?php echo $capt; ?>'>
<input type='submit' name='countreset' value='CERO CONTADORES'>
</form>
<form action='#' method='get' name='cleans'>
<input type='hidden' name='capt' value='<?php echo $capt; ?>'>
<input type='submit' name='cleanslate' value='VACIAR LISTA'>
</form>
<form action='roboclean.php' method='get' name='prepare'>
<input type='hidden' name='capt' value='<?php echo $capt; ?>'>
<input type='submit' name='prepares' value='PREPARAR LISTA'>
</form>
<button onclick="window.location='robocon.php?capt=<?php echo $capt; ?>'">RECARGA PAGINA</button>
</div>
<div>
<table>
<tr>
<td>
<table summary='CHANGE' class="ui-widget">
<tr>
<th>Grabaci&oacute;n</th>
<th>Lineas</th>
</tr>
<?php 
$query="SELECT msg,lineas,auto FROM robot.msglist 
ORDER BY msg";
$result=mysql_query($query) or die(mysql_error());
while ($row=mysql_fetch_row($result)) {
$msg=$row[0];
$lineas=$row[1];
$auto=$row[2];
?>
<form action='#' method='get' name='<?php echo $msg; ?>'>
<input type='hidden' name='capt' value='<?php echo $capt; ?>'>
<input type='hidden' name='auto' value='<?php echo $auto; ?>'>
<tr>
<td><?php echo $msg; ?></td>
<td>
<select name="lineas">
<?php
        for ($i=0;$i<15;$i++) 
        { ?>
  <option value="<?php echo $i; ?>" style="font-size:120%;" <?php 
            if ($i == strtolower($lineas)) 
            {
                echo "selected='selected'";
            } ?>>
	<?php 
            echo $i;
            } ?></option>
</select>
</td>
<td><input type='submit' name='lines' value='CAMBIAR'></td>
<td><input type='submit' name='lines' value='BORRAR'></td>
</tr>
</form>
<?php } ?>
</table>
</td>
<!--
<td>
<table class="ui-widget">
<tr>
<th>Cliente</th>
<th>Gestores</th>
<th>&nbsp;</th>
</tr>
<tr>
<td>Credito Si</td>
<td><?php 
//echo $CS;
?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Provident</td>
<td><?php 
//echo $PRO;
?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>GE</td>
<td><?php 
//echo $GE;
?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>CrediClub</td>
<td><?php 
//echo $CC;
?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Especial</td>
<td><?php 
//echo $PN;
?></td>
<td><?php 
//echo $ESP2;
?></td>
</tr>
</table>
</td>
-->
</tr>
</table>
</div>
    </body>
    </html>
<?php 
}
}
mysql_close($con);
?>
