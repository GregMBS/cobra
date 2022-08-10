<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
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
            $writer = WriterEntityFactory::createCSVWriter(); // for CSV files
            $writer->openToBrowser($filename); // stream data directly to the browser
            $row = WriterEntityFactory::createRowFromArray($headers);
            $writer->addRow($row);
            $writer->addRows($array); // add multiple rows at a time
            $writer->close();
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
/*            $writer = WriterEntityFactory::createXLSXWriter(); // for CSV files
            $writer->openToBrowser($filename); // stream data directly to the browser
            if (count($headers) > 0) {
                $rowHead = WriterEntityFactory::createRowFromArray($headers);
                $writer->addRow($rowHead);
            }
            foreach ($array as $rowData) {
                $row = WriterEntityFactory::createRowFromArray($rowData);
                $writer->addRow($row);
            }
            $writer->close();*/
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $start = 'A1';
            if (count($headers) > 0) {
                $sheet->fromArray($headers, NULL, $start);
                $start = 'B1';
            }
            $row = $sheet->getHighestRow()+1;
            $sheet->insertNewRowBefore($row);
            $sheet->fromArray($array,NULL,$start);
            $writer = new Xlsx($spreadsheet);
            $writer->save($filename);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

}
