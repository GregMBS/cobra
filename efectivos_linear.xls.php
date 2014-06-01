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
    $querymain = "select distinct numero_de_cuenta,trim(c_tele)
from resumen
join historia on c_cont=id_cuenta
join dictamenes on dictamen=c_cvst
join livelines using (c_tele)
left join deadlines using (c_tele)
where status_de_credito not regexp '[vd]o$'
and length(trim(c_tele)) in (8,10,12,13)
and queue <>'ilocalizables'
and queue <>'sin contactos'
and deadlines.c_tele is null
".$clientestr." 
order by numero_de_cuenta,c_tele 
    ;";
    $result = mysql_query($querymain) or die(mysql_error());
// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();

$filename="Telefonos_efectivos_".date('ymd',strtotime($fecha1))."_".date('ymd',strtotime($fecha2)).".xls";
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
<form action="efectivos_linear.xls.php" method="get" name="queryparms">
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
<input type='submit' name='go' value='Tel&eacute;fonos Efectivos'>
</form>
</body>
</html> 
<?php } 
}
}
mysql_close($con);
?>
