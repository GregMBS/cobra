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
        $cliente = mysql_real_escape_string($_REQUEST['cliente']);
//$gestorstr=" and ejecutivo_asignado_call_center not regexp '-' ";
$gestorstr='';
$clientestr='';
if ($cliente!='todos') {$clientestr=" and cliente='".$cliente."' ";}
    $querymain = "SELECT concat(' ',numero_de_cuenta) as 'cuenta',nombre_deudor,resumen.cliente,
    status_de_credito,saldo_total,saldo_descuento_2,d1.queue,status_aarsa as status,
    domicilio_deudor,colonia_deudor,ciudad_deudor,estado_deudor,cp_deudor,email_deudor,
concat(' ',tel_1),(tel_1 in (select c_tele from livelines))*(1-(tel_1 in (select c_tele from deadlines))) as 't1 efectivo',
concat(' ',tel_2),(tel_2 in (select c_tele from livelines))*(1-(tel_2 in (select c_tele from deadlines))) as 't2 efectivo',
concat(' ',tel_3),(tel_3 in (select c_tele from livelines))*(1-(tel_3 in (select c_tele from deadlines))) as 't3 efectivo',
concat(' ',tel_4),(tel_4 in (select c_tele from livelines))*(1-(tel_4 in (select c_tele from deadlines))) as 't4 efectivo',
concat(' ',tel_1_verif),(tel_1_verif in (select c_tele from livelines))*(1-(tel_1_verif in (select c_tele from deadlines))) as 't1v efectivo',
concat(' ',tel_2_verif),(tel_2_verif in (select c_tele from livelines))*(1-(tel_2_verif in (select c_tele from deadlines))) as 't2v efectivo',
concat(' ',tel_3_verif),(tel_3_verif in (select c_tele from livelines))*(1-(tel_3_verif in (select c_tele from deadlines))) as 't3v efectivo',
concat(' ',tel_4_verif),(tel_4_verif in (select c_tele from livelines))*(1-(tel_4_verif in (select c_tele from deadlines))) as 't4v efectivo',
concat(' ',tel_1_laboral),(tel_1_laboral in (select c_tele from livelines))*(1-(tel_1_laboral in (select c_tele from deadlines))) as 't1l efectivo',
concat(' ',tel_2_laboral),(tel_2_laboral in (select c_tele from livelines))*(1-(tel_2_laboral in (select c_tele from deadlines))) as 't2l efectivo',
concat(' ',tel_1_ref_1),(tel_1_ref_1 in (select c_tele from livelines))*(1-(tel_1_ref_1 in (select c_tele from deadlines))) as 't1r1 efectivo',
concat(' ',tel_1_ref_2),(tel_1_ref_2 in (select c_tele from livelines))*(1-(tel_1_ref_2 in (select c_tele from deadlines))) as 't1r2 efectivo'
    from resumen 
left join dictamenes d1 on status_aarsa=d1.dictamen
where status_de_credito like '%o'  
and cliente='Provident'
and fecha_de_actualizacion>='2011-07-01'
ORDER BY cliente,status_de_credito,queue,numero_de_cuenta
    ;";
    $result = mysql_query($querymain) or die(mysql_error());
// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();

$filename="Query_de_provident_".date('ymd').".xls";
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
<form action="provident.xls.php" method="get" name="queryparms">
<input type="hidden" name="capt" value="<?php echo $capt ?>">
<p>Cliente: <?php echo $cliente;?>
<select name="cliente">
<option value="todos" style="font-size:120%;">todos</option>
<?php
        $queryc = "SELECT distinct cliente FROM clientes 
        order by cliente
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
<input type='submit' name='go' value='Query Inventario'>
</form>
</body>
</html> 
<?php } 
}
}
mysql_close($con);
?>
