<?php
set_time_limit(300);

/**
 *  outputCSV creates a line of CSV and outputs it to browser    
 */
function outputCSV($array) {
    $fp = fopen('php://output', 'w'); // this file actual writes to php output
    fputcsv($fp, $array);
    fclose($fp);
}

/**
 *  getCSV creates a line of CSV and returns it. 
 */
function getCSV($array) {
    ob_start(); // buffer the output ...
    outputCSV($array);
    return ob_get_clean(); // ... then return it as a string!
}
//require_once 'Spreadsheet/Excel/Writer.php';
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {die($capt.$ticket);}
else {
function MesNom($n)
{
    $timestamp = mktime(0, 0, 0, $n, 1, 2005);
    
    return date("M", $timestamp);
}
    if (isset($_GET['go'])) 
    {
        $go = mysql_real_escape_string($_GET['go']);
        $cliente = mysql_real_escape_string($_GET['cliente']);
//$gestorstr=" and ejecutivo_asignado_call_center not regexp '-' ";
$gestorstr='';
$clientestr='';
if ($cliente!='todos') {$clientestr=" and cliente='".$cliente."' ";}
    $querymain = "SELECT concat('\'',numero_de_cuenta) as 'cuenta',nombre_deudor,resumen.cliente,
    status_de_credito,saldo_total,d1.queue,saldo_descuento_2,
    domicilio_deudor,colonia_deudor,ciudad_deudor, estado_deudor,cp_deudor,ejecutivo_asignado_call_center,
    fecha_de_asignacion, fecha_de_deasignacion,
tel_1,(tel_1 in (select c_tele from livelines))*(1-(tel_1 in (select c_tele from deadlines))) as 't1 efectivo',
tel_2,(tel_2 in (select c_tele from livelines))*(1-(tel_2 in (select c_tele from deadlines))) as 't2 efectivo',
tel_3,(tel_3 in (select c_tele from livelines))*(1-(tel_3 in (select c_tele from deadlines))) as 't3 efectivo',
tel_4,(tel_4 in (select c_tele from livelines))*(1-(tel_4 in (select c_tele from deadlines))) as 't4 efectivo',
tel_1_verif,(tel_1_verif in (select c_tele from livelines))*(1-(tel_1_verif in (select c_tele from deadlines))) as 't1v efectivo',
tel_2_verif,(tel_2_verif in (select c_tele from livelines))*(1-(tel_2_verif in (select c_tele from deadlines))) as 't2v efectivo',
tel_3_verif,(tel_3_verif in (select c_tele from livelines))*(1-(tel_3_verif in (select c_tele from deadlines))) as 't3v efectivo',
tel_4_verif,(tel_4_verif in (select c_tele from livelines))*(1-(tel_4_verif in (select c_tele from deadlines))) as 't4v efectivo',
tel_1_laboral,(tel_1_laboral in (select c_tele from livelines))*(1-(tel_1_laboral in (select c_tele from deadlines))) as 't1l efectivo',
tel_2_laboral,(tel_2_laboral in (select c_tele from livelines))*(1-(tel_2_laboral in (select c_tele from deadlines))) as 't2l efectivo',
tel_1_ref_1,(tel_1_ref_1 in (select c_tele from livelines))*(1-(tel_1_ref_1 in (select c_tele from deadlines))) as 't1r1 efectivo',
tel_1_ref_2,(tel_1_ref_2 in (select c_tele from livelines))*(1-(tel_1_ref_2 in (select c_tele from deadlines))) as 't1r2 efectivo'
    from resumen 
left join dictamenes d1 on status_aarsa=d1.dictamen
where 1=1 
".$clientestr." 
ORDER BY cliente,status_de_credito,queue,numero_de_cuenta
    ;";
    $result = mysql_query($querymain) or die(mysql_error());
// Creating a workbook
//$workbook = new Spreadsheet_Excel_Writer();

$filename="Query_de_inventario_".date('ymd').".csv";
// sending HTTP headers
//$workbook->send($filename);
header('Content-type: application/xls');
header('Content-Disposition: attachment; filename="'.$filename.'"');

// Creating a worksheet
//$worksheet =& $workbook->addWorksheet('Reporte CS');
//$worksheet->setInputEncoding('ISO-8859-1');


$ii=0;
$numberfields = mysql_num_fields($result);
$afield=array();
   for ($i=0; $i<$numberfields ; $i++ ) {
       $var = mysql_field_name($result, $i);
//	$worksheet->write(0, $i, $var);
       $afield[]=$var;
   }
echo getcsv($afield);
$ii++;

while ($row = mysql_fetch_row($result)) 
    {
	$arow=array();
    for ($j=0;$j<$numberfields; $j++) {
	if ($row[$j]) {
		$arow[]=$row[$j];
	} else {
		$arow[]=' ';
	}
    }
echo getcsv($arow);
    $ii++;
    }
//$workbook->close();
    }
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Query de Inventario</title>

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
<form action="inventario.csv.php" method="get" name="queryparms">
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
