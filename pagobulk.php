<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>Capturar Pagos Confirmados</title>
<style>
    body {background-color:blue;}
    .num {text-align:right}
    textarea,select,option {background-color:white;}
    form {margin-left:auto;margin-right:auto;}
    p {background-color:gray;}
</style>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="cargar">
<p>Usa formato CUENTA,FECHA(2011-01-31),MONTO(1234.56)</p>
<textarea name='data' rows='20' cols='50'></textarea>
<input type="hidden" name="capt" value="<?php
    echo $capt
?>" />
<button type="submit" name="go" value="cargar">Cargar</button>
</p>
</form>
<?php
  
    if (!empty($_POST['go'])) 
    {
        
        if ($_POST['go'] == 'cargar') 
        {
            
$data = preg_split("/[\s,]+/", $_POST['data'],0,PREG_SPLIT_NO_EMPTY);
$max=ceil(count($data)/3);
$queryload='';
for ($i=0;$i<$max;$i++) {
$cuenta=$i*3;
$fecha=$i*3+1;
$monto=$i*3+2;
$querypagoclean="delete from pagos 
where confirmado=0 and cuenta='".$data[$cuenta]."' 
 and fecha<='".$data[$fecha]."';";
mysql_query($querypagoclean) or die("Remove Duplicates:".mysql_error());
$querypagoins="insert into pagos (cuenta,fecha,monto,cliente,gestor,confirmado,id_cuenta)
select '".$data[$cuenta]."', '".$data[$fecha]."', ".$data[$monto].", cliente, c_cvge, 1, id_cuenta 
from resumen 
left join historia h1 on cuenta='".$data[$cuenta]."' 
and q(c_cvst) in ('PROMESAS','CLIENTE NEGOCIANDO') 
and d_fech>last_day(curdate() - INTERVAL 31 day)
where ('".$data[$cuenta]."', '".$data[$fecha]."', ".$data[$monto].")
not in (select cuenta,fecha,monto from pagos where confirmado=1) 
and numero_de_cuenta='".$data[$cuenta]."'
and not exists 
(select * from historia h2 where h1.c_cont=h2.c_cont 
and concat(h2.d_fech,h2.c_hrfi)<concat(h1.d_fech,h1.c_hrfi)
and q(h2.c_cvst) in ('PROMESAS','CLIENTE NEGOCIANDO'))
";
mysql_query($querypagoins) or die("Insert Pagos:".mysql_error());
}
$querypi="update resumen
set status_aarsa='PAGO INFONAVIT'
where id_cuenta in (select id_cuenta from pagos  
where confirmado=1 and fecha>=last_day(curdate()-interval 1 month))
and resumen.cliente not like 'j%'";
mysql_query($querypi) or die("Status Update:".mysql_error());
?>
<p>Pagos est&aacute;n guardados</p>
<?php } } ?>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
    </body>
    </html>
<?php 
}
}
$query='drop table if exists ipptemp;';
mysql_query($query) or die("Drop temp table 1:".mysql_error());
$query='drop table if exists mantemp;';
mysql_query($query) or die("Drop temp table 2:".mysql_error());
$query='create temporary table ipptemp
select id_cuenta as idc from pagos 
where confirmado=1 
group by id_cuenta 
having count(distinct year(fecha),month(fecha))>2;';
mysql_query($query) or die("Create temp table 1:".mysql_error());
$query='create temporary table mantemp
select id_cuenta as idc from pagos 
where confirmado=1 
group by id_cuenta 
having count(distinct year(fecha),month(fecha))>8;';
mysql_query($query) or die("Create temp table 2:".mysql_error());
$query="update resumen,ipptemp
SET status_de_credito='MANTENMIENTO'
where idc=id_cuenta
and status_de_credito='IR POR PAGO';";
mysql_query($query) or die("Update table 1:".mysql_error());
$query="update resumen,mantemp
SET status_de_credito='CURADO'
where idc=id_cuenta
and status_de_credito='MANTENMIENTO';";
mysql_query($query) or die("Update table 1:".mysql_error());

mysql_close($con);
?>
