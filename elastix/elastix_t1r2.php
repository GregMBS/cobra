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
$querymain = "select distinct nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(tel_1_ref_2+0)=8,tel_1_ref_2+0,
    if(length(tel_1_ref_2)=10 and left(tel_1_ref_2,2)=81,right(tel_1_ref_2,8),if(length(tel_1_ref_2)=10,
    concat('01',tel_1_ref_2),if(length(tel_1_ref_2+0)=7,concat('01844',tel_1_ref_2+0),
    tel_1_ref_2)))) as t1_ref_2,
    saldo_total,id_cuenta,nombre_referencia_2,status_de_credito,status_aarsa
 from resumen left join historia on c_cont=id_cuenta and right(c_tele,8)=right(tel_1_ref_2,8)
where auto is null and cliente='".$cliente."' 
and status_de_credito not like '%o'
having length(t1_ref_2) in (8,12)
    ;";
    $result = mysql_query($querymain) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Query T1R2 para Elastix</title>

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
<p>TEL 1 REF 2 SIN GESTION</p>
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
</tr>
<?php    
while ($row = mysql_fetch_row($result)) {
$nombre_deudor=$row[0];
$numero_de_cuenta=$row[1];
$cliente=$row[2];
$t1r2=$row[3];
$saldo_total=$row[4];
$id_cuenta=$row[5];
$enlace="&lt;a href='https://192.168.1.71/elastix-buscar.php?find=".$id_cuenta."' target='_blank'&gt;BUSCAR&lt;/a&gt;";
$nombre_referencia=$row[6];
if(empty($nombre_referencia)) {$nombre_referencia='Referencia 2';}
$status_de_credito=$row[7];
$status_aarsa=$row[8];
?>
<tr>
<td><?php echo $nombre_deudor; ?></td>
<td><?php echo $numero_de_cuenta; ?></td>
<td><?php echo $cliente; ?></td>
<td><?php echo $t1r2; ?></td>
<td><?php echo $saldo_total; ?></td>
<td><?php echo $id_cuenta; ?></td>
<td><?php echo $enlace; ?></td>
<td><?php echo $nombre_referencia; ?></td>
<td><?php echo $status_de_credito; ?></td>
<td><?php echo $status_aarsa; ?></td>
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