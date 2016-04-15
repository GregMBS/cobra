<?php
require_once 'Classes/PHPExcel/IOFactory.php';
include('admin_hdr_2.php');
$day_esp = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");$host = "localhost";
set_time_limit(300);
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
$querymain="SELECT cuenta,DATE_FORMAT(d_fech,'%m%d%Y'),
DATE_FORMAT(c_hrin,'%H:%i:%s'),codigo,cr.csi_cr,'',
C_OBSE1 
from resumen 
join historia on c_cont=id_cuenta
left join cyberres cr on c_cvst=cr.dictamen 
left join cyberact on accion=c_accion 
where month(d_fech)=month(curdate() - interval 6 day) and year(d_fech)=year(curdate() - interval 6 day) 
and cliente='Credito Si' 
and fecha_de_actualizacion>last_day(curdate() - interval 1 month)
order by d_fech,c_hrin
;";
$result=mysql_query($querymain) or die(mysql_error());

$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
PHPExcel_Settings::setCacheStorageMethod($cacheMethod);

// Creating a workbook
$workbook = new PHPExcel();
$fecha1=date("d\_M");
$workbook->getProperties()->setCreator("Gregory Miles Blumenthal Scharf")
							 ->setLastModifiedBy("Gregory Miles Blumenthal Scharf")
							 ->setTitle("Layout Carga de Gesiones CS Mensual")
							 ->setSubject("Layout Carga de Gesiones CS Mensual")
							 ->setDescription("Layout Carga de Gesiones CS Mensual, formato nuevo.")
							 ->setKeywords("Layout Carga de Gesiones CS Mensual nuevo")
							 ->setCategory("Layout Carga de Gesiones CS Mensual");

$filename="Layout_carga_de_gestiones_cs_".$fecha1.".xls";

// Creating a worksheet
$workbook->setActiveSheetIndex(0);
$workbook->getActiveSheet()->setTitle('Reporte CS');

// The actual data
$workbook->setActiveSheetIndex(0)
            ->setCellValue('A1', 1)
            ->setCellValue('A2', 2)
            ->setCellValue('A3', 3)
            ->setCellValue('A4', 4)
            ->setCellValue('A5', 5)
            ->setCellValue('A6', 6)
            ->setCellValue('A7', 7)
            ->setCellValue('A8', 8)
            ->setCellValue('A9', 9)
            ->setCellValue('A10', 10);
$workbook->setActiveSheetIndex(0)
            ->setCellValue('B1', 'Valor constante ')
            ->setCellValue('B2', 'Grupo')
            ->setCellValue('B3', 'Número de cuenta')
            ->setCellValue('B4', 'Fecha y hora de actividad')
            ->setCellValue('B5', 'No. de secuencia. Usado para ordenar cómo se muestra en sesión. Esta secuencia se ignora si las actividades se clasifican por fecha y hora.')
            ->setCellValue('B6', 'Código de acción')
            ->setCellValue('B7', 'Código de resultado')
            ->setCellValue('B8', 'Código de carta')
            ->setCellValue('B9', 'Id agente o apellido paterno')
            ->setCellValue('B10', 'Comentario');
$i=2;
while ($answer=mysql_fetch_row($result)) {
$i++;
$workbook->setActiveSheetIndex(0)
->setCellValueByColumnAndRow(1, $i, 200)
->setCellValueByColumnAndRow(2, $i, 6)
->setCellValueByColumnAndRow(3, $i, $answer[0])
->setCellValueByColumnAndRow(4, $i, $answer[1]." ".$answer[2])
->setCellValueByColumnAndRow(5, $i, $i-2)
->setCellValueByColumnAndRow(6, $i, $answer[3])
->setCellValueByColumnAndRow(7, $i, $answer[4])
->setCellValueByColumnAndRow(8, $i, $answer[5])
->setCellValueByColumnAndRow(9, $i, 'ADARSA')
->setCellValueByColumnAndRow(10, $i, 6);
}
// Let's send the file
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($workbook, 'Excel2007');
$objWriter->save('php://output');
}
}
mysql_close();
?>
