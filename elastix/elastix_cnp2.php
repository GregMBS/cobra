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
    $querymain2 = "select distinct nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(c_tele+0)=8,c_tele+0,
    if(length(c_tele)=10 and left(c_tele,2)=81,right(c_tele,8),if(length(c_tele)=10,
    concat('01',c_tele),if(length(c_tele+0)=7,concat('01844',c_tele+0),
    if(left(c_tele,4)='0181',right(c_tele,8),
if(length(c_tele)=12 and left(c_tele,1)=4,concat('0',c_tele),c_tele)))))) as tt,
    saldo_total,id_cuenta,'XX' as enlace,status_de_credito,status_aarsa,
    estado_deudor,ciudad_deudor,c_obse1
 from resumen 
join historia on c_cont=id_cuenta
where c_carg<>'' 
and status_de_credito not like '%o'
    and status_aarsa='CLIENTE NEGOCIANDO'
    and c_cvst='CLIENTE NEGOCIANDO'
    and d_fech>last_day(curdate()-interval 5 week)
    and cliente='Surtidor del Hogar'
order by tt+1
    ;";
    $result2 = mysql_query($querymain2) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Query para Elastix</title>

<style type="text/css">
       body {font-family: arial, helvetica, sans-serif; font-size: 8pt; background-color: #00a0f0; color:#000000;}
       table {border: 1pt solid #000000;background-color: #c0c0c0;}
     tr:hover {background-color: #ff0000;}
       th {border: 1pt solid #000000;background-color: #c0c0c0;}
	.loud {text-align:center; font-weight:bold; color:red;}  
	.num {text-align:right;}
 </style>
</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<form action="#" method="get" name="queryparms">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
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
</select>
<input type='submit' name='go' value='ELIGIR'>
</form>
<p>CLIENTES NEGOCIANDOS Y PROMESAS</p>
<table>
<tr>
<?php
$numberfields2 = mysql_num_fields($result2);

   for ($i=0; $i<$numberfields2 ; $i++ ) {
       $var2 = mysql_field_name($result2, $i);
       echo '<th>'.$var2.'</th>';
   }
?>
</tr>
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
</table>
<?php } ?>
</body>
</html> 
<?php
}
mysql_close($con);
?>