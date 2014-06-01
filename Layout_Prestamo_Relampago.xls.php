<?php
require_once 'Spreadsheet/Excel/Writer.php';
include('admin_hdr_2.php');
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");$host = "localhost";
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querymain="SELECT numero_de_credito,cuenta,'ADARSA',concat_ws(' ',DATE_FORMAT(d_fech,'%d/%m/%Y'),
DATE_FORMAT(c_hrin,'%H:%i')),
if (c_visit is not null,'Visita de Campo','Llamada Telefónico'),
if (n_prom>0,DATE_FORMAT(d_prom,'%d/%m/%Y'),''),
if (n_prom>0,floor(n_prom),''),concat_ws(' ',c_cvst,c_tele,left(c_obse1,200)) 
from historia  
join resumen on c_cont=id_cuenta
where d_fech>last_day(curdate() - interval 6 week) 
and d_fech<curdate()-2
and cliente='Prestamo Relampago' and c_cvge<>'Milt'
order by d_fech,c_hrin
;";
$result=mysql_query($querymain) or die(mysql_error);

// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();
$fecha1=date("d\_M");

$filename="Layout_Prestamo_Relampago_".$fecha1.".xls";
// sending HTTP headers
$workbook->send($filename);

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('Reporte Prestamo Relampago');
$worksheet->setInputEncoding('UTF-8');

// The actual data
$worksheet->write(0, 0, 'N° Credito');
$worksheet->write(0, 1, 'N° Cliente');
$worksheet->write(0, 2, 'Gestor');
$worksheet->write(0, 3, 'Fecha Gestión');
$worksheet->write(0, 4, 'Tipo');
$worksheet->write(0, 5, 'Fecha Promesa de Pago');
$worksheet->write(0, 6, 'Monto Promesa de Pago');
$worksheet->write(0, 7, 'Comentarios');
$i=0;
while ($answer=mysql_fetch_row($result)) {
$i++;
$C_HRIN=$answer[2];
$worksheet->write($i, 0, $answer[0]);
$worksheet->write($i, 1, $answer[1]);
$worksheet->write($i, 2, $answer[2]);
$worksheet->write($i, 3, $answer[3]);
$worksheet->write($i, 4, $answer[4]);
$worksheet->write($i, 5, $answer[5]);
$worksheet->write($i, 6, $answer[6]);
$worksheet->write($i, 7, $answer[7]);
}
// Let's send the file
$workbook->close();
}
}
mysql_close();
?>
