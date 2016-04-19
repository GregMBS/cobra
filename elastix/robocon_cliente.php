<?php
include('cliente_hdr.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$mytipo=$answercheck[1];
if (!empty($_GET['auto'])) {
$auto=mysql_real_escape_string($_GET['auto']);
$lineas=mysql_real_escape_string($_GET['lineas']);
$queryu="UPDATE robot.msglist 
SET lineas=".($lineas+0.0)."
WHERE (client='".$capt."' or '".$mytipo."'='admin'  
AND auto=".$auto;
mysql_query($queryu) or die(mysql_error());
}
$querya="select client,count(distinct id),count(distinct tel), lineas, 
sum(turno>0)/count(1)*100, count(1)
from robot.calllist join robot.msglist using (msg)
where camp=1 and (client='".$capt."' or '".$mytipo."'='admin')
group by msg";
$resulta=mysql_query($querya) or die(mysql_error());
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>ROBOT Control</title>
<style>
    body {background-color:blue;}
    .num {text-align:right}
    table, tr, td {background-color:white;}
    table {margin-left:auto;margin-right:auto;}
    th {background-color:gray;}
</style>
</head>
<body>
<button onclick="window.location='robot_cliente.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<table summary='ACTUAL'>
<tr>
<th>Cliente</th>
<th>Cuentas</th>
<th>Teléfonos</th>
<th>Registros</th>
<th>Lineas</th>
<th>% Marcado</th>
<th>Horas rest.</th>
</tr>
<?php 
while ($rowa=mysql_fetch_row($resulta)) {
$client=$rowa[0];
$ctas=$rowa[1];
$tels=$rowa[2];
$lins=$rowa[3];
$regs=$rowa[5];
$pc=round($rowa[4])."%";
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
</table>
<br>
<table summary='CHANGE'>
<tr>
<th>Cliente</th>
<th>Lineas</th>
</tr>
<?php 
$query="SELECT client,lineas,auto FROM robot.msglist 
WHERE (client='".$capt."' or '".$mytipo."'='admin')
ORDER BY client";
$result=mysql_query($query) or die(mysql_error());
while ($row=mysql_fetch_row($result)) {
$cliente=$row[0];
$lineas=$row[1];
$auto=$row[2];
?>
<form action='#' method='get' name='<?php echo $cliente; ?>'>
<input type='hidden' name='auto' value='<?php echo $auto; ?>'>
<input type='hidden' name='capt' value='<?php echo $capt; ?>'>
<tr>
<td><?php echo $cliente; ?></td>
<td>
<select name="lineas">
<?php
        for ($i=0;$i<13;$i++) 
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
<td><input type='submit' value='CAMBIAR'></td>
</tr>
</form>
<?php } ?>
</table>
    </body>
    </html>
<?php 
}
}
mysql_close($con);
?>
