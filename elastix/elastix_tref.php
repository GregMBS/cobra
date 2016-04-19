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
$querymain = "(select distinct nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(tel_1_ref_1+0)=8,tel_1_ref_1+0,
    if(length(tel_1_ref_1)=10 and left(tel_1_ref_1,2)=81,right(tel_1_ref_1,8),if(length(tel_1_ref_1)=10,
    concat('01',tel_1_ref_1),if(length(tel_1_ref_1+0)=7,concat('01844',tel_1_ref_1+0),
    tel_1_ref_1)))) as tel_ref,
    saldo_total,id_cuenta,nombre_referencia_1,status_de_credito,
    status_aarsa,subproducto,fecha_ultima_gestion
 from resumen left join historia on c_cont=id_cuenta and right(c_tele,8)=right(tel_1_ref_1,8)
where auto is null and cliente='".$cliente."' 
and status_de_credito not like '%o'
having length(tel_ref) in (8,12))
UNION
(select distinct nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(tel_2_ref_1+0)=8,tel_2_ref_1+0,
    if(length(tel_2_ref_1)=10 and left(tel_2_ref_1,2)=81,right(tel_2_ref_1,8),if(length(tel_2_ref_1)=10,
    concat('01',tel_2_ref_1),if(length(tel_2_ref_1+0)=7,concat('01844',tel_2_ref_1+0),
    tel_2_ref_1)))) as t1_ref_1,
    saldo_total,id_cuenta,nombre_referencia_1,status_de_credito,
    status_aarsa,subproducto,fecha_ultima_gestion
 from resumen left join historia on c_cont=id_cuenta and right(c_tele,8)=right(tel_2_ref_1,8)
where auto is null and cliente='".$cliente."' 
and status_de_credito not like '%o'
having length(t1_ref_1) in (8,12))
UNION
(select distinct nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(tel_1_ref_2+0)=8,tel_1_ref_2+0,
    if(length(tel_1_ref_2)=10 and left(tel_1_ref_2,2)=81,right(tel_1_ref_2,8),if(length(tel_1_ref_2)=10,
    concat('01',tel_1_ref_2),if(length(tel_1_ref_2+0)=7,concat('01844',tel_1_ref_2+0),
    tel_1_ref_2)))) as tel_ref,
    saldo_total,id_cuenta,nombre_referencia_2,status_de_credito,
    status_aarsa,subproducto,fecha_ultima_gestion
 from resumen left join historia on c_cont=id_cuenta and right(c_tele,8)=right(tel_1_ref_2,8)
where auto is null and cliente='".$cliente."' 
and status_de_credito not like '%o'
having length(tel_ref) in (8,12))
UNION
(select distinct nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(tel_2_ref_2+0)=8,tel_2_ref_2+0,
    if(length(tel_2_ref_2)=10 and left(tel_2_ref_2,2)=81,right(tel_2_ref_2,8),if(length(tel_2_ref_2)=10,
    concat('01',tel_2_ref_2),if(length(tel_2_ref_2+0)=7,concat('01844',tel_2_ref_2+0),
    tel_2_ref_2)))) as t1_ref_2,
    saldo_total,id_cuenta,nombre_referencia_2,status_de_credito,
    status_aarsa,subproducto,fecha_ultima_gestion
 from resumen left join historia on c_cont=id_cuenta and right(c_tele,8)=right(tel_2_ref_2,8)
where auto is null and cliente='".$cliente."' 
and status_de_credito not like '%o'
having length(t1_ref_2) in (8,12))
;";
    $result = mysql_query($querymain) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Query Tel Ref para Elastix</title>

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
        $queryc = "SELECT cliente from clientes order by cliente;";
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
<p>TEL 1 REF 1 SIN GESTION</p>
<table>
<tr>
<th>nombre_deudor</th>
<th>numero_de_cuenta</th>
<th>cliente</th>
<th>tt</th>
<th>saldo_total</th>
<th>id_cuenta</th>
<th>enlace</th>
<th>nombre_referencia</th>
<th>status_de_credito</th>
<th>status_aarsa</th>
<th>subproducto</th>
<th>fecha_ultima_gestion</th>
</tr>
<?php    
while ($row = mysql_fetch_row($result)) {
$nombre_deudor=$row[0];
$numero_de_cuenta=$row[1];
$cliente=$row[2];
$t1r1=$row[3];
$saldo_total=$row[4];
$id_cuenta=$row[5];
$enlace="&lt;a href='https://192.168.1.71/elastix-buscar.php?find=".$id_cuenta."' target='_blank'&gt;BUSCAR&lt;/a&gt;";
$nombre_referencia=$row[6];
if(empty($nombre_referencia)) {$nombre_referencia='Referencia 1';}
$status_de_credito=$row[7];
$status_aarsa=$row[8];
$subproducto=$row[9];
$fug=$row[10];
?>
<tr>
<td><?php echo $nombre_deudor; ?></td>
<td><?php echo $numero_de_cuenta; ?></td>
<td><?php echo $cliente; ?></td>
<td><?php echo $t1r1; ?></td>
<td><?php echo $saldo_total; ?></td>
<td><?php echo $id_cuenta; ?></td>
<td><?php echo $enlace; ?></td>
<td><?php echo $nombre_referencia; ?></td>
<td><?php echo $status_de_credito; ?></td>
<td><?php echo $status_aarsa; ?></td>
<td><?php echo $subproducto; ?></td>
<td><?php echo $fug; ?></td>
</tr>
<?php    }
?>
</table>
<?php } ?>
</body>
</html> 
<?php
}
mysql_close($con);
?>
