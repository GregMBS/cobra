<?php
require_once 'Spreadsheet/Excel/Writer.php';
include('admin_hdr_2.php');
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");$host = "localhost";
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querymain="select numero_de_cuenta, status_aarsa, producto, 
who(status_de_credito), saldo_cuota, 100-round(n_prom/saldo_total*100), 
n_prom, saldo_total-n_prom, d_prom1, n_prom1, d_prom2, n_prom2, curdate()
from resumen join historia on c_cont=id_cuenta
where c_cvba='GE Capital' and n_prom>0
order by d_fech,c_hrin
;";
$result=mysql_query($querymain) or die(mysql_error);

// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();
$fecha1=date("d\_M");

$filename="Promesas_y_convenios_".$fecha1.".xls";
// sending HTTP headers
$workbook->send($filename);

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('Reporte');
$worksheet->setInputEncoding('ISO-8859-1');
$format_title1 =& $workbook->addFormat(array('Size' => 8,
                                      'Bold' => 0,
                                      'Color' => 'black',
                                      'FgColor' => 'green'));
$format_title1->setAlign('merge');
$format_title2 =& $workbook->addFormat(array('Size' => 8,
                                      'Bold' => 0,
                                      'Color' => 'black',
                                      'FgColor' => 'green'));
$format_title2->setAlign('merge');
$format_title3 =& $workbook->addFormat(array('Size' => 8,
                                      'Bold' => 1,
                                      'Color' => 'black',
                                      'FgColor' => 22));
$format_data =& $workbook->addFormat(array('Size' => 8,
                                      'Bold' => 0,
                                      'Color' => 'black',
                                      'FgColor' => 'white'));

// The actual data
$worksheet->write(0, 0, '', $format_data);
$worksheet->write(0, 1, '', $format_data);
$worksheet->write(0, 2, '', $format_data);
$worksheet->write(0, 3, '', $format_data);
$worksheet->write(0, 4, '', $format_data);
$worksheet->write(0, 5, '', $format_data);
$worksheet->write(0, 6, '', $format_data);
$worksheet->write(0, 7, '', $format_data);
$worksheet->write(0, 8, '', $format_data);
$worksheet->write(0, 9, 'Pago 1', $format_title1);
$worksheet->write(0, 10, '', $format_title1);
$worksheet->write(0, 11, 'Pago 2', $format_title2);
$worksheet->write(0, 12, '', $format_title2);
$worksheet->write(1, 0, 'Numero de cuenta', $format_title3);
$worksheet->write(1, 1, 'Status', $format_title3);
$worksheet->write(1, 2, 'Retailer', $format_title3);
$worksheet->write(1, 3, 'Bucket', $format_title3);
$worksheet->write(1, 4, 'Balance Asignación', $format_title3);
$worksheet->write(1, 5, 'Balance actualizado', $format_title3);
$worksheet->write(1, 6, 'quita en %', $format_title3);
$worksheet->write(1, 7, 'Monto Total Negociado', $format_title3);
$worksheet->write(1, 8, 'quita en $', $format_title3);
$worksheet->write(1, 9, 'Fecha de Pago', $format_title3);
$worksheet->write(1, 10, 'Monto Negociado', $format_title3);
$worksheet->write(1, 11, 'Fecha de Pago', $format_title3);
$worksheet->write(1, 12, 'Monto Negociado', $format_title3);
$worksheet->write(1, 13, 'Fecha de Reporte', $format_title3);
$worksheet->write(1, 14, 'Agencia', $format_title3);
$worksheet->write(1, 15, 'Fecha Rep Ag x Correo', $format_title3);
$worksheet->write(1, 16, 'Tipo Asigna', $format_title3);
$i=1;
while ($answer=mysql_fetch_row($result)) {
$i++;
$worksheet->write($i, 0, "'".$answer[0], $format_data);
$worksheet->write($i, 1, $answer[1], $format_data);
$worksheet->write($i, 2, $answer[2], $format_data);
$worksheet->write($i, 3, $answer[3], $format_data);
$worksheet->write($i, 4, $answer[4], $format_data);
$worksheet->write($i, 5, $answer[4], $format_data);
$worksheet->write($i, 6, $answer[5]."%", $format_data);
$worksheet->write($i, 7, $answer[6], $format_data);
$worksheet->write($i, 8, $answer[7], $format_data);
$worksheet->write($i, 9, $answer[8], $format_data);
$worksheet->write($i, 10, $answer[9], $format_data);
$worksheet->write($i, 11, $answer[10], $format_data);
$worksheet->write($i, 12, $answer[11], $format_data);
$worksheet->write($i, 13, $answer[12], $format_data);
$worksheet->write($i, 14, 'ADARSA', $format_data);
$worksheet->write($i, 15, $answer[12], $format_data);
$worksheet->write($i, 16, 'Asig. Especial', $format_data);
}
// Let's send the file
$workbook->close();
}
}
mysql_close();
?>
