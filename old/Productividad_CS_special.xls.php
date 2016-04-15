<?php
require_once 'Spreadsheet/Excel/Writer.php';
include('admin_hdr_2.php');
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");$host = "localhost";
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querypre="SELECT count(1) FROM resumen 
WHERE month(fecha_de_actualizacion)=month(curdate() - interval 1 week) 
and year(fecha_de_actualizacion)=year(curdate() - interval 1 week) 
and status_de_credito not regexp 'nactivo' 
and cliente='Credito Si'
;";
$resultpre=mysql_query($querypre) or die(mysql_error);
while ($answerpre=mysql_fetch_row($resultpre)) {$total=$answerpre[0];}
$querymain="SELECT count(distinct cuenta),count(1),sum(csi_tipo='CD'),sum(csi_cr='PP')
from historia left join csidict on c_cvst=dictamen left join csilugar on accion=c_accion 
where d_fech>='2010-05-01' 
and d_fech<='2010-05-31'
and c_cvba='Credito Si' 
order by d_fech,c_hrin
;";
$result=mysql_query($querymain) or die(mysql_error);
while ($answer=mysql_fetch_row($result)) {
// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();
$fecha1=date("d\_M");
$filename="PRODUCTIVIDAD_DIA_".$fecha1.".xls";
// sending HTTP headers
$workbook->send($filename);

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('Reporte CS');
$worksheet->setInputEncoding('ISO-8859-1');
$fecha2=date("d/m/Y");

// The actual data
$worksheet->write(0, 4, $fecha2);
$worksheet->write(2, 2, 'Total Cuentas Asignadas');
$worksheet->write(2, 3, 'Cuentas Trabajadas');
$worksheet->write(2, 5, 'Total de Gestiones');
$worksheet->write(2, 6, 'Gestiones Efectivas');
$worksheet->write(2, 8, '# Promesas de Pago');
$worksheet->write(3, 1, 'Agencies');
$worksheet->write(3, 2, 'Total Accounts');
$worksheet->write(3, 3, 'Accounts Worked');
$worksheet->write(3, 4, '% Accounts Worked');
$worksheet->write(3, 5, 'Total Activities');
$worksheet->write(3, 6, 'Right Party');
$worksheet->write(3, 7, '%RPC');
$worksheet->write(3, 8, 'Promise to Pay');
$worksheet->write(3, 9, '# PTP vs RPC');
$worksheet->write(4, 1, 'ADARSA');
$worksheet->write(4, 2, $total);
$worksheet->write(4, 3, $answer[0]);
$worksheet->write(4, 4, number_format(($answer[0]/$total*100),0)."%");
$worksheet->write(4, 5, $answer[1]);
$worksheet->write(4, 6, $answer[2]);
$worksheet->write(4, 7, number_format(($answer[2]/$answer[1]*100),0)."%");
$worksheet->write(4, 8, $answer[3]);
$worksheet->write(4, 9, number_format(($answer[3]/$answer[2]*100),0)."%");
$worksheet->write(5, 1, 'Total');
$worksheet->write(5, 2, $total);
$worksheet->write(5, 3, $answer[0]);
$worksheet->write(5, 4, number_format(($answer[0]/$total*100),0)."%");
$worksheet->write(5, 5, $answer[1]);
$worksheet->write(5, 6, $answer[2]);
$worksheet->write(5, 7, number_format(($answer[2]/$answer[1]*100),0)."%");
$worksheet->write(5, 8, $answer[3]);
$worksheet->write(5, 9, number_format(($answer[3]/$answer[2]*100),0)."%");
}
$workbook->close();
}
}
mysql_close();
?>
