<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {die($capt.$ticket);}
else {
$cliente='';
    if (!empty($_REQUEST['go'])) 
    {
        $go = mysql_real_escape_string($_REQUEST['go']);
        $cliente = mysql_real_escape_string($_REQUEST['cliente']);
    }
    $querypre = "select id_cuenta,numero_de_cuenta,status_de_credito,saldo_total,
    fecha_ultima_gestion,domicilio_deudor,colonia_deudor,ciudad_deudor,
    estado_deudor,cp_deudor,producto,nombre_deudor,
    saldo_descuento_2,saldo_descuento_1,status_aarsa,dias_vencidos
 from resumen 
where cliente='".$cliente."'  and estado_deudor like 'N%'
and (fecha_de_actualizacion>last_day(curdate()-interval 5 week)
or fecha_ultima_gestion>last_day(curdate()-interval 5 week)
or status_de_credito not regexp '[dv]o$')
order by numero_de_cuenta
    ;";
    $resultpre = mysql_query($querypre) or die(mysql_error());
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
        $queryc = "SELECT distinct cliente FROM resumen 
        where fecha_ultima_gestion>last_day(curdate()-interval 5 week) limit 20
        ";
        $resultc = mysql_query($queryc);
        while ($answerc = mysql_fetch_array($resultc)) 
        { ?>
  <option value="<?php echo $answerc[0];?>" style="font-size:120%;">
	<?php echo $answerc[0];?></option>
	
<?php
        } ?>
</select>
<input type='submit' name='go' value='ELIGIR'>
</form><p>
<p>'numero_de_cuenta','nombre','camp','morosidad','saldo total','saldo descuento1',
'saldo descuento2','mejor tele','mejor visit','direccion','colonia',
'ciudad','estado','cp'<br>
<?php    
while ($rowpre = mysql_fetch_row($resultpre)) 
    {
$id_cuenta=$rowpre[0];    
$numero_de_cuenta=$rowpre[1];    
$CAMP=$rowpre[2];    
$ST=$rowpre[3];    
$FUG=$rowpre[4];    
$DOM=$rowpre[5];
$COL=$rowpre[6];
$CIU=$rowpre[7];
$EST=$rowpre[8];
$CP=$rowpre[9];    
$PRODUCTOS=$rowpre[10];    
$NOMBRE=$rowpre[11];    
$SD2=$rowpre[12];    
$SD1=$rowpre[13];    
$BESTSTAT=$rowpre[14];
$DIAS=$rowpre[15];
$BESTVISIT='';
$querybest="select c_cvst from historia 
join dictamenes on c_cvst=dictamen
where c_cont=".$id_cuenta." and c_cniv is not null and c_cont>0
order by v_v limit 1
";
    $resultbest = mysql_query($querybest) or die(mysql_error());
while ($rowbest = mysql_fetch_row($resultbest)) {
$BESTVISIT=$rowbest[0];
}
?>
<?php echo $numero_de_cuenta.",'".$NOMBRE."','".$CAMP."',".$DIAS.",".$ST.",".$SD1.",".$SD2.
",'".$BESTSTAT."','".$BESTVISIT."','".$DOM."','".$COL."','".$CIU."','".$EST."','".$CP."'\n"; ?>
<br>
<?php } ?>
<?php } ?>
</p>
</body>
</html> 
<?php
}
mysql_close($con);
?>
