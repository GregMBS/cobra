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
    if(length(tel_1+0)=8,tel_1+0,
    if(length(tel_1)=10 and left(tel_1,2)=81,right(tel_1,8),if(length(tel_1)=10,
    concat('01',tel_1),if(length(tel_1+0)=7,concat('01844',tel_1+0),
    if(left(tel_1,4)='0181',right(tel_1,8),tel_1))))) as t1,
    if(length(tel_3+0)=8,tel_3+0,
    if(length(tel_3)=10 and left(tel_3,2)=81,right(tel_3,8),if(length(tel_3)=10,
    concat('01',tel_3),if(length(tel_3+0)=7,concat('01844',tel_3+0),
    if(left(tel_3,4)='0181',right(tel_3,8),tel_3))))) as t3,
    if(length(tel_4+0)=8,tel_4+0,
    if(length(tel_4)=10 and left(tel_4,2)=81,right(tel_4,8),if(length(tel_4)=10,
    concat('01',tel_4),if(length(tel_4+0)=7,concat('01844',tel_4+0),
    if(left(tel_4,4)='0181',right(tel_4,8),tel_4))))) as t4,
    if(length(tel_1_ref_1+0)=8,tel_1_ref_1+0,
    if(length(tel_1_ref_1)=10 and left(tel_1_ref_1,2)=81,right(tel_1_ref_1,8),if(length(tel_1_ref_1)=10,
    concat('01',tel_1_ref_1),if(length(tel_1_ref_1+0)=7,concat('01844',tel_1_ref_1+0),
    if(left(tel_1_ref_1,4)='0181',right(tel_1_ref_1,8),tel_1_ref_1))))) as t1_ref_1,
    if(length(tel_1_ref_2+0)=8,tel_1_ref_2+0,
    if(length(tel_1_ref_2)=10 and left(tel_1_ref_2,2)=81,right(tel_1_ref_2,8),if(length(tel_1_ref_2)=10,
    concat('01',tel_1_ref_2),if(length(tel_1_ref_2+0)=7,concat('01844',tel_1_ref_2+0),
    if(left(tel_1_ref_2,4)='0181',right(tel_1_ref_2,8),tel_1_ref_2))))) as t1_ref_2,
    if(length(tel_1_laboral+0)=8,tel_1_laboral+0,
    if(length(tel_1_laboral)=10 and left(tel_1_laboral,2)=81,right(tel_1_laboral,8),if(length(tel_1_laboral)=10,
    concat('01',tel_1_laboral),if(length(tel_1_laboral+0)=7,concat('01844',tel_1_laboral+0),
    if(left(tel_1_laboral,4)='0181',right(tel_1_laboral,8),tel_1_laboral))))) as t2_ref_1,
    if(length(tel_2_laboral+0)=8,tel_2_laboral+0,
    if(length(tel_2_laboral)=10 and left(tel_2_laboral,2)=81,right(tel_2_laboral,8),if(length(tel_2_laboral)=10,
    concat('01',tel_2_laboral),if(length(tel_2_laboral+0)=7,concat('01844',tel_2_laboral+0),
    if(left(tel_2_laboral,4)='0181',right(tel_2_laboral,8),tel_2_laboral))))) as t2_ref_2,
    saldo_total,id_cuenta,'XX' as enlace,status_de_credito,status_aarsa,subproducto
 from resumen use index (queuesort)
where status_aarsa='' and cliente='".$cliente."' 
and status_de_credito not like '%o'
    ;";
    $result = mysql_query($querymain) or die(mysql_error());
$queryc="select count(1) from resumen 
where cliente='".$cliente."'
and status_de_credito not like '%o'
and fecha_ultima_gestion<=last_day(curdate()-interval 1 month)
";
    $resultc = mysql_query($queryc) or die("resultc-".mysql_error());
while ($rowc=mysql_fetch_row($resultc)) {$numc=$rowc[0];}
    $querymain2 = "select distinct nombre_deudor,numero_de_cuenta,cliente,
    if(length(tel_1+0)=8,tel_1+0,
    if(length(tel_1)=10 and left(tel_1,2)=81,right(tel_1,8),if(length(tel_1)=10,
    concat('01',tel_1),if(length(tel_1+0)=7,concat('01844',tel_1+0),
    if(left(tel_1,4)='0181',right(tel_1,8),tel_1))))) as t1,
    if(length(tel_3+0)=8,tel_3+0,
    if(length(tel_3)=10 and left(tel_3,2)=81,right(tel_3,8),if(length(tel_3)=10,
    concat('01',tel_3),if(length(tel_3+0)=7,concat('01844',tel_3+0),
    if(left(tel_3,4)='0181',right(tel_3,8),tel_3))))) as t3,
    if(length(tel_4+0)=8,tel_4+0,
    if(length(tel_4)=10 and left(tel_4,2)=81,right(tel_4,8),if(length(tel_4)=10,
    concat('01',tel_4),if(length(tel_4+0)=7,concat('01844',tel_4+0),
    if(left(tel_4,4)='0181',right(tel_4,8),tel_4))))) as t4,
    if(length(tel_1_ref_1+0)=8,tel_1_ref_1+0,
    if(length(tel_1_ref_1)=10 and left(tel_1_ref_1,2)=81,right(tel_1_ref_1,8),if(length(tel_1_ref_1)=10,
    concat('01',tel_1_ref_1),if(length(tel_1_ref_1+0)=7,concat('01844',tel_1_ref_1+0),
    if(left(tel_1_ref_1,4)='0181',right(tel_1_ref_1,8),tel_1_ref_1))))) as t1_ref_1,
    if(length(tel_1_ref_2+0)=8,tel_1_ref_2+0,
    if(length(tel_1_ref_2)=10 and left(tel_1_ref_2,2)=81,right(tel_1_ref_2,8),if(length(tel_1_ref_2)=10,
    concat('01',tel_1_ref_2),if(length(tel_1_ref_2+0)=7,concat('01844',tel_1_ref_2+0),
    if(left(tel_1_ref_2,4)='0181',right(tel_1_ref_2,8),tel_1_ref_2))))) as t1_ref_2,
    if(length(tel_1_laboral+0)=8,tel_1_laboral+0,
    if(length(tel_1_laboral)=10 and left(tel_1_laboral,2)=81,right(tel_1_laboral,8),if(length(tel_1_laboral)=10,
    concat('01',tel_1_laboral),if(length(tel_1_laboral+0)=7,concat('01844',tel_1_laboral+0),
    if(left(tel_1_laboral,4)='0181',right(tel_1_laboral,8),tel_1_laboral))))) as t2_ref_1,
    if(length(tel_2_laboral+0)=8,tel_2_laboral+0,
    if(length(tel_2_laboral)=10 and left(tel_2_laboral,2)=81,right(tel_2_laboral,8),if(length(tel_2_laboral)=10,
    concat('01',tel_2_laboral),if(length(tel_2_laboral+0)=7,concat('01844',tel_2_laboral+0),
    if(left(tel_2_laboral,4)='0181',right(tel_2_laboral,8),tel_2_laboral))))) as t2_ref_2,
    saldo_total,id_cuenta,'XX',status_de_credito,status_aarsa,dias_vencidos,fecha_ultima_gestion
 from resumen  
where cliente='".$cliente."'
and status_de_credito not like '%o' 
;";
    $result2 = mysql_query($querymain2) or die("result2-".mysql_error());
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
<form action="elastix_all_sg.php" method="get" name="queryparms">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<p>Cliente:
<select name="cliente">
<?php
        $queryc = "SELECT distinct cliente FROM resumen 
        where fecha_de_actualizacion>last_day(curdate()-interval 1 month)
        or fecha_ultima_gestion>last_day(curdate()-interval 1 month) limit 50";
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
<th>subproducto</th>
<th>i</th>
</tr>
<?php    
while ($row = mysql_fetch_row($result)) {
$nombre_deudor=$row[0];
$numero_de_cuenta=$row[1];
$cliente=$row[2];
$t1=$row[3];
$t3=$row[4];
$t4=$row[5];
$t1r1=$row[6];
$t1r2=$row[7];
$t1l=$row[8];
$t2l=$row[9];
$saldo_total=$row[10];
$id_cuenta=$row[11];
$enlace="&lt;a href='https://192.168.1.71/elastix-buscar.php?find=".$id_cuenta."' target='_blank'&gt;BUSCAR&lt;/a&gt;";
$status_de_credito=$row[13];
$status_aarsa=$row[14];
$subproducto=$row[15];
$tt=0;
for ($i=3;$i<10;$i++) {
$tt=$row[$i];
if ((strlen($tt)==8)||(strlen($tt)==12)) {
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
<td><?php echo $subproducto; ?></td>
<td><?php echo $i; ?></td>
</tr>
<?php    }}}
?>
</table>
<p>SIN GESTION ESTE MES</p>
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
<th>subproducto</th>
<th>fecha_ultima_gestion</th>
</tr>
<?php    
while ($row2 = mysql_fetch_row($result2)) 
    {
$nombre_deudor=$row2[0];
$numero_de_cuenta=$row2[1];
$cliente=$row2[2];
$t1=$row2[3];
$t3=$row2[4];
$t4=$row2[5];
$t1r1=$row2[6];
$t1r2=$row2[7];
$t2r1=$row2[8];
$t2r2=$row2[9];
$saldo_total=$row2[10];
$id_cuenta=$row2[11];
$enlace="&lt;a href='https://192.168.1.71/elastix-buscar.php?find=".$id_cuenta."' target='_blank'&gt;BUSCAR&lt;/a&gt;";
$status_de_credito=$row2[13];
$status_aarsa=$row2[14];
$subproducto=$row2[15];
$fecha_ultima_gestion=$row2[16];
$tt=$t1;
for ($i=3;$i<10;$i++) {
$tt=$row2[$i];	
if((strlen($tt)!=8)&&(strlen($tt)!=12)) {$tt=0;}
else {
$querydc="select c_tele from deadlines where c_tele=right('".$tt."',8);";
$resultdc=mysql_query($querydc) or die(mysql_error());
while($answerdc) {$tt=0;}
$queryh="select c_tele from historia where c_tele='".$tt."' 
and d_fech>last_day(curdate()-interval 1 month);";
$resulth=mysql_query($queryh) or die(mysql_error());
while($answerh) {$tt=0;}
}
if (($tt+1)>1) {
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
<td><?php echo $subproducto; ?></td>
<td><?php echo $fecha_ultima_gestion; ?></td>
</tr>
<?php } } }?>
</table>
<?php } ?>
</body>
</html> 
<?php
}
mysql_close($con);
?>
