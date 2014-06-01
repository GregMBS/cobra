<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {die($capt.$ticket);}
else {
$cliente='';
    if (!empty($_GET['go'])) 
    {
        $go = mysql_real_escape_string($_GET['go']);
        $cliente = mysql_real_escape_string($_GET['cliente']);
    }
if ($cliente!='TODOS') {
    $querymain2 = "select distinct id_cuenta,
    if(length(c_tele+0)=8,c_tele+0,
    if(length(c_tele)=10 and left(c_tele,2)=81,right(c_tele,8),if(length(c_tele)=10,
    concat('01',c_tele),if(length(c_tele+0)=7,concat('01844',c_tele+0),
    if(left(c_tele,4)='0181',right(c_tele,8),c_tele))))) as tt,
    concat(msg,2),0 as 'turno',1 as 'camp'
 from resumen 
join historia on c_cont=id_cuenta
join robot.msglist on client=cliente
left join deadlines using (c_tele)
where c_carg='' and c_carg is not null and deadlines.c_tele is null
and cliente='".$cliente."'
and c_tele=concat(''*0+c_tele) and c_tele>999 and c_tele*1<440000000000
and status_de_credito not like '%o'
and status_aarsa not like 'PAGO TOTA%'
having length(tt) in (8,12) and tt+1>1

    ;";}
else {
    $querymain2 = "select distinct id_cuenta,
    if(length(c_tele+0)=8,c_tele+0,
    if(length(c_tele)=10 and left(c_tele,2)=81,right(c_tele,8),if(length(c_tele)=10,
    concat('01',c_tele),if(length(c_tele+0)=7,concat('01844',c_tele+0),
    if(left(c_tele,4)='0181',right(c_tele,8),c_tele))))) as tt,
    concat(msg,2),0 as 'turno',1 as 'camp'
 from resumen 
join historia on c_cont=id_cuenta
join robot.msglist on client=cliente
left join deadlines using (c_tele)
where c_carg='' and c_carg is not null and deadlines.c_tele is null
and c_tele=concat(''*0+c_tele) and c_tele>999 and c_tele*1<440000000000
and status_de_credito not like '%o'
and status_aarsa not like 'PAGO TOTAL%'
having length(tt) in (8,12) and tt+1>1

;";
}
if (!empty($_GET['send'])) {
	$queryprep="DELETE FROM robot.calllist WHERE msg IN 
	(SELECT msg FROM robot.msglist WHERE client='".$cliente."');";
if ($cliente!='TODOS') {
$queryprep="TRUNCATE robot.calllist;";
}
//mysql_query($queryprep) or die(mysql_error());
	$querymain='INSERT into robot.calllist (id,tel,msg,turno,camp) '.$querymain2;
    $result = mysql_query($querymain) or die(mysql_error());
	}

    $result2 = mysql_query($querymain2) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Query para Elastix</title>
			<link rel="stylesheet" href="css/redmond/jquery-ui.css" type="text/css" media="all" /> 
			<script src="js/jquery-1.5.1.min.js" type="text/javascript"></script> 
			<script src="js/jquery-ui-1.8.13.custom.min.js" type="text/javascript"></script> 
</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<form action="#" method="get" name="queryparms">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
Cargar<input type="checkbox" name="send">
<p>Cliente:
<select name="cliente">
<?php
        $queryc = "SELECT distinct cliente FROM resumen 
        where fecha_de_actualizacion>last_day(curdate()-interval 1 month)
        or fecha_ultima_gestion>last_day(curdate()-interval 1 month)";
        $resultc = mysql_query($queryc);
        while ($answerc = mysql_fetch_array($resultc)) 
        { ?>
  <option value="<?php echo $answerc[0];?>" style="font-size:120%;">
	<?php echo $answerc[0];?></option>
<?php
        } ?>
<option value="TODOS" style="font-size:120%;">TODOS</option>
</select>
<input type='submit' name='go' value='ELIGIR'>
</form>
<p>CONTACTOS</p>
<table class="ui-widget">
<thead class="ui-widget-header">
<tr>
<?php
$numberfields2 = mysql_num_fields($result2);

   for ($i=0; $i<$numberfields2 ; $i++ ) {
       $var2 = mysql_field_name($result2, $i);
       echo '<th>'.$var2.'</th>';
   }
?>
</tr>
</thead>
<tbody class="ui-widget-content">
<?php    
while ($row2 = mysql_fetch_row($result2)) 
    {
    echo '<tr>';
    foreach ($row2 as $cell2) {
        if ($cell2=='XX') {echo "<td>&lt;a href='https://192.168.1.71/elastix-buscar.php?find=".$id_cuenta."' target='_blank'&gt;BUSCAR&lt;/a&gt;</td>";}
        else {echo '<td>'.$cell2.'</td>';$id_cuenta=$cell2;}
    }
    echo '</tr>';
    }
?>
</tbody>
</table>
<?php } ?>
</body>
</html> 
<?php
}
mysql_close($con);
?>
