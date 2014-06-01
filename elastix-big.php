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
    $querymain = "select nombre_deudor,numero_de_cuenta,cliente,tel_1,saldo_total,id_cuenta
 from resumen 
where status_aarsa='' and cliente='".$cliente."' 
and fecha_de_actualizacion>last_day(curdate()-interval 1 month)
    ;";
    $result = mysql_query($querymain) or die(mysql_error());
    $querymain2 = "select distinct nombre_deudor,numero_de_cuenta,
    cliente,c_tele,saldo_total,id_cuenta,'XX' as enlace
 from resumen 
join historia on c_cont=id_cuenta
join dictamenes on dictamen=c_cvst
where queue<>'SIN CONTACTOS' 
and queue<>'ILOCALIZABLES' 
and cliente='".$cliente."'
and c_tele+0>999
and status_de_credito not like '%o'
and (fecha_de_actualizacion>last_day(curdate()-interval 1 month)
or fecha_ultima_gestion>last_day(curdate()-interval 1 month))
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
<form action="elastix.php" method="get" name="queryparms">
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
<p>SIN GESTION</p>
<table>
<tr>
<?php
$numberfields = mysql_num_fields($result);

   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
       echo '<th>'.$var.'</th>';
   }
?>
</tr>
<?php    
while ($row = mysql_fetch_row($result)) 
    {
    echo '<tr>';
    foreach ($row as $cell) {
        echo '<td>'.$cell.'</td>';
    }
    echo '</tr>';
    }
?>
</table>
<p>CONTACTOS</p>
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
