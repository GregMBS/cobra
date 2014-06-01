<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {die($capt.$ticket);}
else {
$cliente='';
    if (!empty($_GET['go'])) 
    {
        $go = mysql_real_escape_string($_GET['go']);
        $cs = mysql_real_escape_string($_GET['cliente']);
        $cse = explode('-',$cs);
        $cliente=$cse[0];
        $sdc=$cse[1];
    }
if ($cliente!='TODOS') {
    $querymain2 = "select distinct nombre_deudor,numero_de_cuenta,
    cliente,
    if((length(c_tele)=10) and (left(c_tele,2)<>'81'),concat('01',c_tele),right(c_tele,8)) as tt,
    saldo_total,id_cuenta,'XX' as enlace,
    if(isnull(if(right(c_tele,8)=right(tel_1,8),'deudor',
    if(right(c_tele,8)=right(tel_3,8),'deudor',
    if(right(c_tele,8)=right(tel_4,8),'deudor',
    if(right(c_tele,8)=right(tel_1_ref_1,8),nombre_referencia_1,
    if(right(c_tele,8)=right(tel_1_ref_2,8),nombre_referencia_2,
    if(right(c_tele,8)=right(tel_1_ref_3,8),nombre_referencia_3,
    if(right(c_tele,8)=right(tel_1_ref_4,8),nombre_referencia_4,
    if(right(c_tele,8)=right(tel_1_laboral,8),empresa,c_carg))))))))),c_carg,if(right(c_tele,8)=right(tel_1,8),'deudor',
    if(right(c_tele,8)=right(tel_3,8),'deudor',
    if(right(c_tele,8)=right(tel_4,8),'deudor',
    if(right(c_tele,8)=right(tel_1_ref_1,8),nombre_referencia_1,
    if(right(c_tele,8)=right(tel_1_ref_2,8),nombre_referencia_2,
    if(right(c_tele,8)=right(tel_1_ref_3,8),nombre_referencia_3,
    if(right(c_tele,8)=right(tel_1_ref_4,8),nombre_referencia_4,
    if(right(c_tele,8)=right(tel_1_laboral,8),empresa,max(c_carg)))))))))) as contacto,
    status_de_credito,status_aarsa,subproducto,
    ciudad_deudor,estado_deudor,fecha_ultima_gestion
 from resumen 
join historia on c_cont=id_cuenta
join dictamenes d1 on c_cvst=d1.dictamen
join dictamenes d2 on status_aarsa=d2.dictamen
left join deadlines using (c_tele)
where c_cont=id_cuenta
and cliente='".$cliente."' and status_de_credito='".$sdc."' 
and d_fech>last_day(curdate()-interval 1 month)
and status_de_credito not like '%o'
and c_tele>999
and deadlines.c_tele is null
and d1.queue in 
('MENSAJES DIRECTOS','MENSAJES INDIRECTOS')
and d2.queue in 
('MENSAJES DIRECTOS','MENSAJES INDIRECTOS')
group by id_cuenta,tt
having length(tt) in (8,12) and tt+1>1
order by fecha_ultima_gestion
    ;";}
else {
    $querymain2 = "select distinct nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(c_tele+0)=8,c_tele+0,
    if(length(c_tele)=10 and left(c_tele,2)=81,right(c_tele,8),if(length(c_tele)=10,
    concat('01',c_tele),if(length(c_tele+0)=7,concat('01844',c_tele+0),
    if(left(c_tele,4)='0181',right(c_tele,8),c_tele))))) as tt,
    saldo_total,id_cuenta,'XX' as enlace,
    if(isnull(if(right(c_tele,8)=right(tel_1,8),'deudor',
    if(right(c_tele,8)=right(tel_3,8),'deudor',
    if(right(c_tele,8)=right(tel_4,8),'deudor',
    if(right(c_tele,8)=right(tel_1_ref_1,8),nombre_referencia_1,
    if(right(c_tele,8)=right(tel_1_ref_2,8),nombre_referencia_2,
    if(right(c_tele,8)=right(tel_1_ref_3,8),nombre_referencia_3,
    if(right(c_tele,8)=right(tel_1_ref_4,8),nombre_referencia_4,
    if(right(c_tele,8)=right(tel_1_laboral,8),empresa,c_carg))))))))),c_carg,if(right(c_tele,8)=right(tel_1,8),'deudor',
    if(right(c_tele,8)=right(tel_3,8),'deudor',
    if(right(c_tele,8)=right(tel_4,8),'deudor',
    if(right(c_tele,8)=right(tel_1_ref_1,8),nombre_referencia_1,
    if(right(c_tele,8)=right(tel_1_ref_2,8),nombre_referencia_2,
    if(right(c_tele,8)=right(tel_1_ref_3,8),nombre_referencia_3,
    if(right(c_tele,8)=right(tel_1_ref_4,8),nombre_referencia_4,
    if(right(c_tele,8)=right(tel_1_laboral,8),empresa,max(c_carg)))))))))) as contacto,
    status_de_credito,status_aarsa,subproducto,
    ciudad_deudor,estado_deudor
 from resumen 
join historia on c_cont=id_cuenta
join dictamenes d1 on c_cvst=d1.dictamen
join dictamenes d2 on status_aarsa=d2.dictamen
left join deadlines using (c_tele)
where c_carg<>'' and c_carg is not null and deadlines.c_tele is null
and c_tele=concat(''*0+c_tele) and c_tele>999 and c_tele*1<440000000000
and d_fech>last_day(curdate()-interval 1 month)
and status_de_credito not like '%o'
and d1.queue in 
('MENSAJES DIRECTOS','MENSAJES INDIRECTOS')
and d2.queue in 
('MENSAJES DIRECTOS','MENSAJES INDIRECTOS')
group by id_cuenta,tt
having length(tt) in (8,12) and tt+1>1
;";
}
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
<form action="elastix_fresh.php" method="get" name="queryparms">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<p>Cliente:
<select name="cliente">
<?php
        $queryc = "SELECT distinct cliente,status_de_credito FROM resumen 
        where status_de_credito not like '%o' order by cliente,status_de_credito";
        $resultc = mysql_query($queryc);
        while ($answerc = mysql_fetch_array($resultc)) 
        { ?>
  <option value="<?php echo $answerc[0].'-'.$answerc[1];?>" style="font-size:120%;">
	<?php echo $answerc[0].'-'.$answerc[1];?></option>
<?php
        } ?>
<option value="TODOS" style="font-size:120%;">TODOS</option>
</select>
<input type='submit' name='go' value='ELIGIR'>
</form>
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
