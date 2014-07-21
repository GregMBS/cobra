<?php
require_once 'admin_hdr_2.php';
require_once 'vendor/autoload.php';
set_time_limit(180);

while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {die($capt.$ticket);}
else {
function MesNom($n)
{
    $timestamp = mktime(0, 0, 0, $n, 1, 2005);
    
    return date("M", $timestamp);
}

    if (!empty($_GET['go'])) 
    {
        $go = mysql_real_escape_string($_GET['go']);
        $cliente = mysql_real_escape_string($_GET['cliente']);
//$gestorstr=" and ejecutivo_asignado_call_center not regexp '-' ";
$gestorstr='';
$clientestr='';
if ($cliente!='todos') {$clientestr=" and cliente='".$cliente."' ";}
    $querymain = "SELECT numero_de_cuenta,nombre_deudor,resumen.cliente,
    status_de_credito,saldo_total,d1.queue,saldo_descuento_2,
    domicilio_deudor,colonia_deudor,ciudad_deudor, estado_deudor,cp_deudor,ejecutivo_asignado_call_center,
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
where status_de_credito not regexp '-' 
".$clientestr." 
ORDER BY cliente,status_de_credito,queue,numero_de_cuenta
    ;";
    $result = mysql_query($querymain) or die(mysql_error());
// Creating a workbook
//$workbook = new Spreadsheet_Excel_Writer();

$filename="Query_de_inventario_".date('ymd').".xlsx";

$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("Cobranza Integral");
$objPHPExcel->getProperties()->setLastModifiedBy("Eduardo Pantoja");
$objPHPExcel->getProperties()->setTitle("Query_de_inventario");
$objPHPExcel->getProperties()->setSubject("COBRA Inventario");
$objPHPExcel->getProperties()->setDescription("COBRA Inventario");
$objPHPExcel->setActiveSheetIndex(0);

$ii=0;
$numberfields = mysql_num_fields($result);
$afield=array();
   for ($i=0; $i<$numberfields ; $i++ ) {
	$letter=chr(ord("A")+$i);
       $var = mysql_field_name($result, $i);
       $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, 1, $var);
       $objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);
   }

$row = 2; // 1-based index
while($row_data = mysql_fetch_assoc($result)) {
    $col = 0;
    foreach($row_data as $key=>$value) {
	$pad="";
	if ($col==0) {$pad=" ";}
       	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value.$pad);
        $col++;
    }
    $row++;
}
$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="'.$filename.'"');
header("Cache-Control: max-age=0");
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");
$objWriter->save("php://output");}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Query del Inventario</title>

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
<form action="inventario.xls.php" method="get" name="queryparms">
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
