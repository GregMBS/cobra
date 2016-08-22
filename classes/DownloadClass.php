<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResumenClass
 *
 * @author gmbs
 */
class DownloadClass {

    private function __construct() {
        require_once 'vendor/autoload.php';
    }

    private function sendToOutput($output, $filename) {
        $workbook = new PHPExcel();
        $workbook->setActiveSheetIndex(0);
//        $workbook->getActiveSheet()->fromArray(array_keys($output[0]), NULL, 'A1');
        $workbook->getActiveSheet()->fromArray($output, NULL, 'A1');
        header('Content-Type', 'application/vnd.ms-excel');
        header('Content-Disposition', 'attachment;filename="' . $filename . '.xls"');
        header('Cache-Control', 'max-age=0');

        $objWriter = new PHPExcel_Writer_Excel2007($workbook);
        $objWriter->save('php://output');
    }

    private function sendToCSV($header, $data, $filename) {

	header('Content-Type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename.'.csv');
	header('Pragma: no-cache');

        $outputBuffer = fopen("php://output", 'w');

	fputcsv($outputBuffer, $header);

        foreach ($data as $val) {
            fputcsv($outputBuffer, $val);
        }

        fclose($outputBuffer);
    }

}
