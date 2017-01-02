<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

require_once 'vendor/autoload.php';

/**
 * Description of OutputClass
 *
 * @author gmbs
 */
class OutputClass {

    /**
     * 
     * @param array $array
     */
    private function outputCSV($filename, $array, $headers) {
        $writer = WriterFactory::create(Type::CSV); // for CSV files
        $writer->openToBrowser($filename); // stream data directly to the browser
        $writer->addRow($headers);
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
        $this->outputCSV($filename, $data, $headers);
    }

    /**
     * 
     * @param array $array
     * @param array $headers
     */
    private function outputXLSX($filename, $array, $headers) {
        $writer = WriterFactory::create(Type::XLSX); // for CSV files
        $writer->openToBrowser($filename); // stream data directly to the browser
        $writer->addRow($headers);
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
        $this->outputXLSX($filename, $data, $headers);
    }

}
