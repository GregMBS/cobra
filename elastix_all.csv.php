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
$querymain = "select nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(tel_1+0)=8,tel_1+0,
    if(length(tel_1)=10 and left(tel_1,2)=81,right(tel_1,8),if(length(tel_1)=10,
    concat('01',tel_1),if(length(tel_1+0)=7,concat('01844',tel_1+0),
    tel_1)))) as t1,
    saldo_total,id_cuenta,'XX' as enlace,status_de_credito,status_aarsa,fecha_ultima_gestion
  from resumen use index (queuesort)
left join deadlines on c_tele=tel_1
where cliente='".$cliente."' 
and status_de_credito not like '%o' and c_tele is null
and status_aarsa<>'PAGO TOTAL'
having t1*1>0
    ;";
$querymainl = "select nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(tel_1_laboral+0)=8,tel_1_laboral+0,
    if(length(tel_1_laboral)=10 and left(tel_1_laboral,2)=81,right(tel_1_laboral,8),
    if(length(tel_1_laboral)=10,
    concat('01',tel_1_laboral),if(length(tel_1_laboral+0)=7,concat('01844',tel_1_laboral+0),
    tel_1_laboral)))) as t1,
    saldo_total,id_cuenta,'XX' as enlace,status_de_credito,status_aarsa,fecha_ultima_gestion
  from resumen use index (queuesort)
left join deadlines on c_tele=tel_1_laboral
where cliente='".$cliente."' 
and status_de_credito not like '%o' and c_tele is null
and status_aarsa<>'PAGO TOTAL'
having t1*1>0
    ;";
$querymainr1 = "select nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(tel_1_ref_1+0)=8,tel_1_ref_1+0,
    if(length(tel_1_ref_1)=10 and left(tel_1_ref_1,2)=81,right(tel_1_ref_1,8),
    if(length(tel_1_ref_1)=10,
    concat('01',tel_1_ref_1),if(length(tel_1_ref_1+0)=7,concat('01844',tel_1_ref_1+0),
    tel_1_ref_1)))) as t1,
    saldo_total,id_cuenta,'XX' as enlace,status_de_credito,status_aarsa,fecha_ultima_gestion
  from resumen use index (queuesort)
left join deadlines on c_tele=tel_1_ref_1
where cliente='".$cliente."' 
and status_de_credito not like '%o' and c_tele is null
and status_aarsa<>'PAGO TOTAL'
having t1*1>0
    ;";
$querymainr2 = "select nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(tel_1_ref_2+0)=8,tel_1_ref_2+0,
    if(length(tel_1_ref_2)=10 and left(tel_1_ref_2,2)=81,right(tel_1_ref_2,8),
    if(length(tel_1_ref_2)=10,
    concat('01',tel_1_ref_2),if(length(tel_1_ref_2+0)=7,concat('01844',tel_1_ref_2+0),
    tel_1_ref_2)))) as t1,
    saldo_total,id_cuenta,'XX' as enlace,status_de_credito,status_aarsa,fecha_ultima_gestion
  from resumen use index (queuesort)
left join deadlines on c_tele=tel_1_ref_2
where cliente='".$cliente."' 
and status_de_credito not like '%o' and c_tele is null
and status_aarsa<>'PAGO TOTAL'
having t1*1>0
    ;";
    if (!empty($_GET['go'])) 
    {
    $result = mysql_query($querymain) or die(mysql_error());
    $resultl = mysql_query($querymainl) or die(mysql_error());
    $resultr1 = mysql_query($querymainr1) or die(mysql_error());
    $resultr2 = mysql_query($querymainr2) or die(mysql_error());
}
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
        $queryc = "SELECT * from clientes";
        $resultc = mysql_query($queryc) or die (mysql_error());
        while ($answerc = mysql_fetch_array($resultc)) 
        { ?>
  <option value="<?php echo $answerc[0];?>" style="font-size:120%;">
	<?php echo $answerc[0];?></option>
<?php
        } ?>
</select>
<input type='submit' name='go' value='ELIGIR'>
</form>
<p>
nombre_deudor,numero_de_cuenta,cliente,tt,saldo_total,id_cuenta,enlace,status_de_credito,status_aarsa,fecha_ultima_gestion</th>
<br>
<?php    
while ($row = mysql_fetch_row($result)) {
$nombre_deudor=$row[0];
$numero_de_cuenta=$row[1];
$cliente=$row[2];
$tt=$row[3];
$saldo_total=$row[4];
$id_cuenta=$row[5];
$enlace="&lt;a href='https://192.168.1.71/elastix-buscar.php?find=".$id_cuenta."' target='_blank'&gt;BUSCAR&lt;/a&gt;";
$status_de_credito=$row[7];
$status_aarsa=$row[8];
$fug=$row[9];
?>
&quot;<?php echo $nombre_deudor; ?>&quot;,&quot;<?php echo $numero_de_cuenta; ?>&quot;,&quot;<?php echo $cliente; ?>&quot;,&quot;<?php echo $tt; ?>&quot;,<?php echo $saldo_total; ?>,<?php echo $id_cuenta; ?>,&quot;<?php echo $enlace; ?>&quot;,&quot;<?php echo $status_de_credito; ?>&quot;,&quot;<?php echo $status_aarsa; ?>&quot;,&quot;<?php echo $fug; ?>&quot;
<br>
<?php    }
while ($row = mysql_fetch_row($resultl)) {
$nombre_deudor=$row[0];
$numero_de_cuenta=$row[1];
$cliente=$row[2];
$tt=$row[3];
$saldo_total=$row[4];
$id_cuenta=$row[5];
$enlace="&lt;a href='https://192.168.1.71/elastix-buscar.php?find=".$id_cuenta."' target='_blank'&gt;BUSCAR&lt;/a&gt;";
$status_de_credito=$row[7];
$status_aarsa=$row[8];
$fug=$row[9];
?>
&quot;<?php echo $nombre_deudor; ?>&quot;,&quot;<?php echo $numero_de_cuenta; ?>&quot;,&quot;<?php echo $cliente; ?>&quot;,&quot;<?php echo $tt; ?>&quot;,<?php echo $saldo_total; ?>,<?php echo $id_cuenta; ?>,&quot;<?php echo $enlace; ?>&quot;,&quot;<?php echo $status_de_credito; ?>&quot;,&quot;<?php echo $status_aarsa; ?>&quot;,&quot;<?php echo $fug; ?>&quot;
<br>
<?php    }
while ($row = mysql_fetch_row($resultr1)) {
$nombre_deudor=$row[0];
$numero_de_cuenta=$row[1];
$cliente=$row[2];
$tt=$row[3];
$saldo_total=$row[4];
$id_cuenta=$row[5];
$enlace="&lt;a href='https://192.168.1.71/elastix-buscar.php?find=".$id_cuenta."' target='_blank'&gt;BUSCAR&lt;/a&gt;";
$status_de_credito=$row[7];
$status_aarsa=$row[8];
$fug=$row[9];
?>
&quot;<?php echo $nombre_deudor; ?>&quot;,&quot;<?php echo $numero_de_cuenta; ?>&quot;,&quot;<?php echo $cliente; ?>&quot;,&quot;<?php echo $tt; ?>&quot;,<?php echo $saldo_total; ?>,<?php echo $id_cuenta; ?>,&quot;<?php echo $enlace; ?>&quot;,&quot;<?php echo $status_de_credito; ?>&quot;,&quot;<?php echo $status_aarsa; ?>&quot;,&quot;<?php echo $fug; ?>&quot;
<br>
<?php    }
while ($row = mysql_fetch_row($resultr2)) {
$nombre_deudor=$row[0];
$numero_de_cuenta=$row[1];
$cliente=$row[2];
$tt=$row[3];
$saldo_total=$row[4];
$id_cuenta=$row[5];
$enlace="&lt;a href='https://192.168.1.71/elastix-buscar.php?find=".$id_cuenta."' target='_blank'&gt;BUSCAR&lt;/a&gt;";
$status_de_credito=$row[7];
$status_aarsa=$row[8];
$fug=$row[9];
?>
&quot;<?php echo $nombre_deudor; ?>&quot;,&quot;<?php echo $numero_de_cuenta; ?>&quot;,&quot;<?php echo $cliente; ?>&quot;,&quot;<?php echo $tt; ?>&quot;,<?php echo $saldo_total; ?>,<?php echo $id_cuenta; ?>,&quot;<?php echo $enlace; ?>&quot;,&quot;<?php echo $status_de_credito; ?>&quot;,&quot;<?php echo $status_aarsa; ?>&quot;,&quot;<?php echo $fug; ?>&quot;
<br>
<?php    }
?>
</p>
<?php } ?>
</body>
</html> 
<?php
}
mysql_close($con);
?>
