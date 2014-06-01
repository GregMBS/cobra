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
    fecha_ultima_gestion,nombre_deudor
 from resumen 
where cliente='".$cliente."' 
and status_de_credito not regexp '[dv]o$'
order by numero_de_cuenta
    ;";
    $querypre = "select id_cuenta,numero_de_cuenta,status_de_credito,saldo_total,
    fecha_ultima_gestion,nombre_deudor,producto
 from resumen 
where cliente='".$cliente."' 
and status_de_credito not regexp '[dv]o$'
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
<form action="latest_best_csv.php" method="get" name="queryparms">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<p>Cliente:
<select name="cliente">
<?php
        $queryc = "SELECT distinct cliente FROM resumen 
        where status_de_credito not regexp '[dv]o$'
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
</form>
<p><?php echo $cliente; ?></p>
<p>
numero_de_cuenta,nombre,camp,saldo total,ultima fecha,ultima status,ultima tele,ultima coment,mejor status,mejor tele,producto
<br>
<?php    
while ($rowpre = mysql_fetch_row($resultpre)) 
    {
$id_cuenta=$rowpre[0];    
$numero_de_cuenta=$rowpre[1];    
$CAMP=$rowpre[2];    
$ST=$rowpre[3];    
$FUG=$rowpre[4];    
$nombre_deudor=$rowpre[5];    
$producto=$rowpre[6];    
$ULTSTAT='';
$ULTTEL='';
$ULTTXT='';
$BESTSTAT='';
$BESTTEL='';
$queryult="select c_cvst,c_tele,c_obse1 from historia use index (misdup)
where c_cont=".$id_cuenta."
order by d_fech desc, c_hrin desc limit 1
";
    $resultult = mysql_query($queryult) or die(mysql_error());
while ($rowult = mysql_fetch_row($resultult)) {
$ULTSTAT=$rowult[0];
$ULTTEL=$rowult[1];
$ULTTXT=$rowult[2];
}
$querybest="select c_cvst,c_tele from historia 
join dictamenes on c_cvst=dictamen
where c_cont=".$id_cuenta."
order by v_cc limit 1
";
    $resultbest = mysql_query($querybest) or die(mysql_error());
while ($rowbest = mysql_fetch_row($resultbest)) {
$BESTSTAT=$rowbest[0];
$BESTTEL=$rowbest[1];
}
?>
<?php echo '"'.$numero_de_cuenta.'","'.$nombre_deudor.'","'.$CAMP.'","'.$ST.
'","'.$FUG.'","'.$ULTSTAT.'","'.$ULTTEL.'","'.$ULTTXT.'","'.$BESTSTAT.
'","'.$BESTTEL.'","'.$producto.'"'?>
<br>
<?php } ?>
</p>
<?php } ?>
</body>
</html> 
<?php
}
mysql_close($con);
?>
