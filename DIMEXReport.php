<?php
require_once 'vendor/phpoffice/phpexcel/Classes/PHPExcel.php';
require_once 'DIMEXModels.php';
$dc       = new DIMEXModels();
$result   = $dc->outputReport();
$filename = "Reporte_de_DIMEX_".date('ymd').".xlsx";
// sending HTTP headers
//$workbook->send($filename);

$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("CDM");
$objPHPExcel->getProperties()->setLastModifiedBy("Greg Blumenthal");
$objPHPExcel->getProperties()->setTitle("Reporte_de_DIMEX");
$objPHPExcel->getProperties()->setSubject("COBRA Reporte_de_DIMEX");
$objPHPExcel->getProperties()->setDescription("COBRA Reporte_de_DIMEX");
$objPHPExcel->setActiveSheetIndex(0);
$i = 0;
foreach ($result['headers'] as $headers) {
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, 1, $var);
}
$ii = 2;
foreach ($result['data'] as $row) {
    $iii = 0;
    foreach ($row as $cell) {
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iii, $ii,
            $cell);
        $iii++;
    }
    $ii++;
}
$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Disposition: attachment; filename="'.$filename.'"');
header("Cache-Control: max-age=0");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
$objWriter->save("php://output");
