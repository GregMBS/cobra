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
            header('Content-Description: File Transfer');
            header('Content-Type: application/csv');
            header("Content-Disposition: attachment; filename=".$filename);
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

            $handle = fopen('php://output', 'w');
            ob_clean(); // clean slate
            fputcsv($handle, $headers);
            foreach ($array as $row) {
                fputcsv($handle, $row);   // direct to buffered output
            }
            ob_flush(); // dump buffer
            fclose($handle);
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
