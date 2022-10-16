<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use OpenSpout\Common\Exception\IOException;
use OpenSpout\Writer\Common\Creator\WriterEntityFactory;
use Exception;
use OpenSpout\Writer\Exception\WriterNotOpenedException;
use OpenSpout\Writer\XLSX\Writer;
use OpenSpout\Writer\CSV\Writer as CW;

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
    public function writeCSVFile(string $filename, array $array, array $headers)
    {
        try {
            //ob_start();
            $fp = fopen('php://output', 'w');
            fputcsv($fp,$headers);
            foreach ($array as $row) {
                fputcsv($fp,$row);
            }
            fclose($fp);
            // reset the file pointer to the start of the file
            fseek($fp, 0);
            // tell the browser it's going to be a csv file
            header('Content-Type: application/vnd.ms-excel');
            // tell the browser we want to save it instead of displaying it
            header('Content-Disposition: attachment; filename="'.$filename.'";');
            // make php send the generated csv lines to the browser
            fpassthru($fp);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    /**
     *
     * @param string $filename
     * @param array $array
     * @param array|null $headers
     * @throws Exception
     */
    public function writeXLSXFile(string $filename, array $array, ?array $headers = [])
    {
        try {
            $writer = WriterEntityFactory::createXLSXWriter(); // for CSV files
            $writer->openToBrowser($filename); // stream data directly to the browser
            $this->writeHeaders($headers, $writer);
            foreach ($array as $rowData) {
                $this->writeRow($rowData, $writer);
            }
            $writer->close();
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    /**
     * @param array $headers
     * @param Writer|null $writer
     * @return void
     * @throws IOException
     * @throws WriterNotOpenedException
     */
    public function writeHeaders(array $headers, ?Writer $writer): void
    {
        if (count($headers) > 0) {
            $this->writeRow($headers, $writer);
        }
    }

    /**
     * @param array $headers
     * @param CW|null $writer
     * @return void
     * @throws IOException
     * @throws WriterNotOpenedException
     */
    public function writeCSVHeaders(array $headers, ?CW $writer): void
    {
        if (count($headers) > 0) {
            $this->writeRow($headers, $writer);
        }
    }

    /**
     * @param $rowData
     * @param Writer|null $writer
     * @return void
     * @throws IOException
     * @throws WriterNotOpenedException
     */
    public function writeRow($rowData, ?Writer $writer): void
    {
        $row = WriterEntityFactory::createRowFromArray($rowData);
        $writer->addRow($row);
    }

    /**
     * @param $rowData
     * @param CW|null $writer
     * @return void
     * @throws IOException
     * @throws WriterNotOpenedException
     */
    public function writeCSVRow($rowData, ?CW $writer): void
    {
        $row = WriterEntityFactory::createRowFromArray($rowData);
        $writer->addRow($row);
    }

}
