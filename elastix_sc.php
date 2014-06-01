<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {die($capt.$ticket);}
else {
    $querymain2 = "select distinct nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(c_tele+0)=8,c_tele+0,
    if(length(c_tele)=10 and left(c_tele,2)=81,right(c_tele,8),if(length(c_tele)=10,
    concat('01',c_tele),if(length(c_tele+0)=7,concat('01844',c_tele+0),
    if(left(c_tele,4)='0181',right(c_tele,8),c_tele))))) as tt,
    saldo_total,id_cuenta,'XX' as enlace,status_de_credito,status_aarsa,subproducto
 from resumen 
join historia on c_cont=id_cuenta
join dictamenes on dictamen=c_cvst
where status_aarsa in ('TEL OCUPADO','TEL NO CONTESTA',
'TEL OCUPADA O NO CONTESTA','TEL SUSPENDIDO')  
and c_tele+1>999 and c_tele-1<440000000000
and c_cvst=status_aarsa
and status_de_credito not like '%o'
having length(tt) in (8,12)
    ;";
    $result2 = mysql_query($querymain2) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Query SIN CONTACTOS para Elastix</title>

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
<p>PROMESAS</p>
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
