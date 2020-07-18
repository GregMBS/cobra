<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use Box\Spout\Common\Exception\InvalidArgumentException;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Exception\WriterNotOpenedException;

require_once 'vendor/autoload.php';

/**
 * Description of OutputClass
 *
 * @author gmbs
 */
class OutputClass {

    /**
     *
     * @param string $filename
     * @param array $array
     * @param array $headers
     * @throws IOException
     * @throws InvalidArgumentException
     * @throws WriterNotOpenedException
     */
    private function outputCSV($filename, $array, $headers) {
        $writer = WriterEntityFactory::createCSVWriter(); // for CSV files
        $writer->openToBrowser($filename); // stream data directly to the browser
        $row = WriterEntityFactory::createRowFromArray($headers);
        $writer->addRow($row);
        $writer->addRows($array); // add multiple rows at a time
        $writer->close();
    }
    
    /**
     * 
     * @param string $filename
     * @param array $data
     * @param array $headers
     */
    public function writeCSVFile($filename, $data, $headers) {
        try {
            $this->outputCSV($filename, $data, $headers);
        } catch (IOException $e) {
        } catch (InvalidArgumentException $e) {
        } catch (WriterNotOpenedException $e) {
        }
    }

    /**
     *
     * @param $filename
     * @param array $array
     * @param array $headers
     * @throws IOException
     * @throws InvalidArgumentException
     * @throws WriterNotOpenedException
     */
    private function outputXLSX($filename, $array, $headers) {
        $writer = WriterEntityFactory::createXLSXWriter(); // for XLSX files
        $writer->openToBrowser($filename); // stream data directly to the browser
        $row = WriterEntityFactory::createRowFromArray($headers);
        $writer->addRow($row);
        $writer->addRows($array); // add multiple rows at a time
        $writer->close();
    }
    
    /**
     * 
     * @param string $filename
     * @param array $data
     * @param array $headers
     */
    public function writeXLSXFile($filename, $data, $headers) {
        try {
            $this->outputXLSX($filename, $data, $headers);
        } catch (IOException $e) {
        } catch (InvalidArgumentException $e) {
        } catch (WriterNotOpenedException $e) {
        }
    }

}
