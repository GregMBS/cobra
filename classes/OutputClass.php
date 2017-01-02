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
    private function outputCSV($filename, $array) {
        $writer = WriterFactory::create(Type::CSV); // for CSV files
        $writer->openToBrowser($filename); // stream data directly to the browser
        $writer->addRows($array); // add multiple rows at a time
        $writer->close();
    }
    
    /**
     * 
     * @param string $filename
     * @param array $data
     * @param array $headers
     */
    public function writeCSVFile($filename, $array) {
        $this->outputCSV($filename, $array);
    }

    /**
     * 
     * @param array $array
     */
    private function outputXLSX($filename, $array) {
        $writer = WriterFactory::create(Type::XLSX); // for CSV files
        $writer->openToBrowser($filename); // stream data directly to the browser
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
        $array = array();
        $array[] = $data;
        $this->outputXLSX($filename, $array);
    }

}
