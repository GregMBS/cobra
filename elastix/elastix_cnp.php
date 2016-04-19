<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {die($capt.$ticket);}
else {
    $querymain2 = "select nombre_deudor,numero_de_cuenta,
    resumen.cliente,
    if(length(trim(h.c_tele)+0)=8,trim(h.c_tele)+0,
    if(estado_deudor like 'N%',right(trim(h.c_tele),8),
    if(length(h.c_tele)=10,
    concat('01',trim(h.c_tele)),if(length(trim(h.c_tele)+0)=7,
    concat('01844',trim(h.c_tele)+0),
    if(length(trim(h.c_tele))=12 and left(trim(h.c_tele),1)=4,
    concat('0',trim(h.c_tele)),trim(h.c_tele)))))) as tt,
    saldo_total,resumen.id_cuenta,'XX' as enlace,status_de_credito,status_aarsa,subproducto,
    estado_deudor,ciudad_deudor,fecha_ultima_gestion,max(d_prom)
 from resumen 
join historia h on c_cont=resumen.id_cuenta
join dictamenes d1 on status_aarsa=d1.dictamen
join dictamenes d2 on c_cvst=d2.dictamen
left join pagos on c_cont=pagos.id_cuenta and fecha>=last_day(curdate()-interval 1 month)
where c_carg<>'' and pagos.auto is null
and h.c_tele*1>999 and h.c_tele not like '04%'
and status_de_credito not like '%o'
    and d1.queue in ('CLIENTE NEGOCIANDO','PROMESAS INCUMPLIDAS')
    and d2.queue in ('PROMESAS','CLIENTE NEGOCIANDO','MENSAJES DIRECTOS')
    and d_fech>last_day(curdate()-interval 2 month)
    group by c_cont,tt
having length(tt) in (8,12) and tt+1>1
order by (resumen.cliente regexp 'credito'),saldo_total desc,id_cuenta
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
