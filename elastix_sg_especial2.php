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
    if(left(tel_1,4)='0181',right(tel_1,8),tel_1))))) as t1,
    saldo_total,id_cuenta,'XX' as enlace,status_de_credito,status_aarsa
 from resumen use index (queuesort)
where cliente='".$cliente."' 
and status_de_credito not like '%o'
and not exists (select * from historia where c_tele=tel_1 and c_msge is null)
and tel_1+0>0
UNION
select nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(tel_1_verif+0)=8,tel_1_verif+0,
    if(length(tel_1_verif)=10 and left(tel_1_verif,2)=81,right(tel_1_verif,8),
    if(length(tel_1_verif)=10,
    concat('01',tel_1_verif),if(length(tel_1_verif+0)=7,concat('01844',tel_1_verif+0),
    if(left(tel_1_verif,4)='0181',right(tel_1_verif,8),tel_1_verif))))) as t1,
    saldo_total,id_cuenta,'XX' as enlace,status_de_credito,status_aarsa
 from resumen use index (queuesort)
where cliente='".$cliente."' 
and status_de_credito not like '%o'
and not exists (select * from historia where c_tele=tel_1_verif and c_msge is null)
and tel_1_verif+0>0
UNION
select nombre_deudor,numero_de_cuenta,
    cliente,
    if(length(tel_2_verif+0)=8,tel_2_verif+0,
    if(length(tel_2_verif)=10 and left(tel_2_verif,2)=81,right(tel_2_verif,8),
    if(length(tel_2_verif)=10,
    concat('01',tel_2_verif),if(length(tel_2_verif+0)=7,concat('01844',tel_2_verif+0),
    if(left(tel_2_verif,4)='0181',right(tel_2_verif,8),tel_2_verif))))) as t1,
    saldo_total,id_cuenta,'XX' as enlace,status_de_credito,status_aarsa
 from resumen use index (queuesort)
where cliente='".$cliente."' 
and status_de_credito not like '%o'
and not exists (select * from historia where c_tele=tel_2_verif and c_msge is null)
and tel_2_verif+0>0
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
<form action="#" method="get" name="queryparms">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<p>Cliente:
<select name="cliente">
<?php
        $queryc = "SELECT * FROM clientes";
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
<th>nombre_deudor</th>
<th>numero_de_cuenta</th>
<th>cliente</th>
<th>tt</th>
<th>saldo_total</th>
<th>id_cuenta</th>
<th>enlace</th>
<th>status_de_credito</th>
<th>status_aarsa</th>
</tr>
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
?>
<tr>
<td><?php echo $nombre_deudor; ?></td>
<td><?php echo $numero_de_cuenta; ?></td>
<td><?php echo $cliente; ?></td>
<td><?php echo $tt; ?></td>
<td><?php echo $saldo_total; ?></td>
<td><?php echo $id_cuenta; ?></td>
<td><?php echo $enlace; ?></td>
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
