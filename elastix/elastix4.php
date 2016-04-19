<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {die($capt.$ticket);}
else {
$querymain = "select distinct nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(tel_1+0)=8,tel_1+0,
    if(length(tel_1)=10 and left(tel_1,2)=81,right(tel_1,8),if(length(tel_1)=10,
    concat('01',tel_1),if(length(tel_1+0)=7,concat('01844',tel_1+0),
    if(left(tel_1,4)='0181',right(tel_1,8),tel_1))))) as tt,
    saldo_total,id_cuenta,'XX' as enlace,status_de_credito,status_aarsa
 from resumen left join historia on c_tele=tel_1
where auto is null and cliente='Credito Si' 
and status_de_credito = '720s_fallida'
UNION
select distinct nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(tel_1_ref_1+0)=8,tel_1_ref_1+0,
    if(length(tel_1_ref_1)=10 and left(tel_1_ref_1,2)=81,right(tel_1_ref_1,8),if(length(tel_1_ref_1)=10,
    concat('01',tel_1_ref_1),if(length(tel_1_ref_1+0)=7,concat('01844',tel_1_ref_1+0),
    if(left(tel_1_ref_1,4)='0181',right(tel_1_ref_1,8),tel_1_ref_1))))) as tt,
    saldo_total,id_cuenta,'XX' as enlace,status_de_credito,status_aarsa
 from resumen left join historia on c_tele=tel_1_ref_1
where auto is null and cliente='Credito Si' 
and status_de_credito = '720s_fallida'
UNION
select distinct nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(tel_1_ref_2+0)=8,tel_1_ref_2+0,
    if(length(tel_1_ref_2)=10 and left(tel_1_ref_2,2)=81,right(tel_1_ref_2,8),if(length(tel_1_ref_2)=10,
    concat('01',tel_1_ref_2),if(length(tel_1_ref_2+0)=7,concat('01844',tel_1_ref_2+0),
    if(left(tel_1_ref_2,4)='0181',right(tel_1_ref_2,8),tel_1_ref_2))))) as tt,
    saldo_total,id_cuenta,'XX' as enlace,status_de_credito,status_aarsa
 from resumen left join historia on c_tele=tel_1_ref_2
where auto is null and cliente='Credito Si' 
and status_de_credito = '720s_fallida'
UNION
select distinct nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(tel_1_ref_3+0)=8,tel_1_ref_3+0,
    if(length(tel_1_ref_3)=10 and left(tel_1_ref_3,2)=81,right(tel_1_ref_3,8),if(length(tel_1_ref_3)=10,
    concat('01',tel_1_ref_3),if(length(tel_1_ref_3+0)=7,concat('01844',tel_1_ref_3+0),
    if(left(tel_1_ref_3,4)='0181',right(tel_1_ref_3,8),tel_1_ref_3))))) as tt,
    saldo_total,id_cuenta,'XX' as enlace,status_de_credito,status_aarsa
 from resumen left join historia on c_tele=tel_1_ref_3
where auto is null and cliente='Credito Si' 
and status_de_credito = '720s_fallida'

    ;";
    $result = mysql_query($querymain) or die(mysql_error());
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
    foreach ($row as $cell2) {
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
