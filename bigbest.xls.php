<?php
set_time_limit(300);
require_once 'Spreadsheet/Excel/Writer.php';
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {die($capt.$ticket);}
else {
function MesNom($n)
{
    $timestamp = mktime(0, 0, 0, $n, 1, 2005);
    
    return date("M", $timestamp);
}
    if (!empty($_REQUEST['go'])) 
    {
        $go = mysql_real_escape_string($_REQUEST['go']);
        $gestor = mysql_real_escape_string($_REQUEST['gestor']);
        $cliente = mysql_real_escape_string($_REQUEST['cliente']);
        $fecha1 = mysql_real_escape_string($_REQUEST['fecha1']);
        $fecha2 = mysql_real_escape_string($_REQUEST['fecha2']);
        if ($fecha2<$fecha1) {list($fecha1, $fecha2) = array($fecha2, $fecha1);}
//$gestorstr=" and ejecutivo_asignado_call_center not regexp '-' ";
$gestorstr='';
$clientestr='';
if ($gestor!='todos') {$gestorstr=" and c_cvge='".$gestor."' ";}
if ($cliente!='todos') {$clientestr=" and c_cvba='".$cliente."' ";}
    $querymain = "SELECT numero_de_cuenta as 'cuenta',nombre_deudor as 'nombre',
    resumen.cliente as 'cliente',status_de_credito as 'segmento',
    saldo_total,d1.queue,h1.*,d2.v_cc as ponderacion,
    domicilio_deudor as calle,colonia_deudor as 'colonia',
    direccion_nueva as 'direccion nueva',email_deudor,pagos.fecha as 'fecha pago', 
    pagos.monto as 'monto pago'
    from resumen join historia h1 on c_cont=resumen.id_cuenta
left join dictamenes d1 on status_aarsa=d1.dictamen
left join dictamenes d2 on c_cvst=d2.dictamen
left join pagos on c_cont=pagos.id_cuenta and d2.queue='PAGOS' and fecha between last_day(d_fech-interval 1 month) and d_fech
where d_fech between '".$fecha1."' and '".$fecha2."'
".$gestorstr.$clientestr." 
and not exists 
(select h2.auto from historia h2, dictamenes d3 
where h2.c_cvst=d3.dictamen and h1.c_cont=h2.c_cont and d3.v_cc<d2.v_cc 
and h2.d_fech between '".$fecha1."' and '".$fecha2."'".$gestorstr.$clientestr.")
ORDER BY d_fech,c_hrin
    ;";
    $result = mysql_query($querymain) or die(mysql_error());
// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();

$filename="Query_de_gestiones_".date('ymd',strtotime($fecha1))."_".date('ymd',strtotime($fecha2)).".xls";
// sending HTTP headers
$workbook->send($filename);

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('Reporte CS');
$worksheet->setInputEncoding('ISO-8859-1');


$ii=0;
$numberfields = mysql_num_fields($result);

   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
	$worksheet->write(0, $i, $var);
   }
$ii++;
while ($row = mysql_fetch_row($result)) 
    {
    for ($j=0;$j<$numberfields; $j++) {
	$worksheet->write($ii, $j, $row[$j]);
    }
    $ii++;
    }
$workbook->close();
    }
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Query de las Promesas/Propuestas</title>

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
<form action="bigbest.xls.php" method="get" name="queryparms">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<p>Gestor: <?php echo $gestor;?>
<select name="gestor">
<option value="todos" style="font-size:120%;">todos</option>
<?php
        $queryc = "SELECT distinct c_cvge FROM historia 
        where d_fech>last_day(curdate()-interval 2 month)
        order by c_cvge
        limit 1000
	";
        $resultc = mysql_query($queryc);
        while ($answerc = mysql_fetch_array($resultc)) 
        { ?>
  <option value="<?php echo $answerc[0];?>" style="font-size:120%;">
	<?php echo $answerc[0];?></option>
<?php
        } ?>
</select>
</p>
<p>Cliente: <?php echo $cliente;?>
<select name="cliente">
<option value="todos" style="font-size:120%;">todos</option>
<?php
        $queryc = "SELECT distinct c_cvba FROM historia 
        where d_fech>last_day(curdate()-interval 2 month) 
        order by c_cvba
        limit 100
	";
        $resultc = mysql_query($queryc);
        while ($answerc = mysql_fetch_array($resultc)) 
        { ?>
  <option value="<?php echo $answerc[0];?>" style="font-size:120%;">
	<?php echo $answerc[0];?></option>
<?php
        } ?>
</select>
</p>
<p>HECHO de:
<?php echo $fecha1;?>
<select name="fecha1">
<?php
        $queryma = "SELECT distinct d_fech FROM historia 
        where d_fech>last_day(curdate()-interval 2 month) 
        ORDER BY d_fech limit 360";
        $resultma = mysql_query($queryma);
        while ($answerma = mysql_fetch_array($resultma)) 
        { ?>
  <option value="<?php echo $answerma[0];?>" style="font-size:120%;">
	<?php echo $answerma[0];?></option>
<?php } ?>
</select>
a:
<?php echo $fecha2;?>
<select name="fecha2">
<?php
        $queryma = "SELECT distinct d_fech FROM historia 
        where d_fech>last_day(curdate()-interval 2 month) 
        ORDER BY d_fech desc limit 60";
        $resultma = mysql_query($queryma);
        while ($answerma = mysql_fetch_array($resultma)) 
        { ?>
  <option value="<?php echo $answerma[0];?>" style="font-size:120%;">
	<?php echo $answerma[0];?></option>
<?php } ?>
</select>
</p>
<input type='submit' name='go' value='Query Gestiones'>
</form>
</body>
</html> 
<?php } 
}
}
mysql_close($con);
?>
