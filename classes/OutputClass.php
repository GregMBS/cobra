<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Description of OutputClass
 *
 * @author gmbs
 */
class OutputClass
{

    /**
     * @param string $filename
     * @param array $array
     * @param array $headers
     * @throws Exception
     */
    public function writeCSVFile($filename, $array, $headers)
    {
        try {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $rowNum = 1;
            $sheet->fromArray($headers, null, 'A' . $rowNum++);
            foreach ($array as $rowData) {
                $sheet->fromArray($rowData, null, 'A' . $rowNum++);
            }
            $writer = new Csv($spreadsheet);
            // Output to browser
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
            exit;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    /**
     *
     * @param $filename
     * @param array $array
     * @param array $headers
     * @throws Exception
     */
    public function writeXLSXFile($filename, $array, $headers = [])
    {
        try {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $rowNum = 1;
            if (count($headers) > 0) {
                $sheet->fromArray($headers, null, 'A' . $rowNum++);
            }
            foreach ($array as $rowData) {
                $sheet->fromArray($rowData, null, 'A' . $rowNum++);
            }
            $writer = new Xlsx($spreadsheet);
            // Output to browser
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
            exit;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

}
