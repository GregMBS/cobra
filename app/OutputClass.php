<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

/**
 * Description of OutputClass
 *
 * @author gmbs
 */
class OutputClass {

    /**
     * @param $filename
     * @param $array
     * @param $headers
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    private function outputCSV($filename, $array, $headers) {
        $wf = new WriterFactory();
        $writer = $wf->create(Type::CSV); // for CSV files
        $writer->openToBrowser($filename); // stream data directly to the browser
        $writer->addRow($headers);
        $writer->addRows($array); // add multiple rows at a time
        $writer->close();
    }

    /**
     * @param $filename
     * @param $data
     * @param $headers
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function writeCSVFile($filename, $data, $headers) {
        $this->outputCSV($filename, $data, $headers);
    }

    /**
     * @param $filename
     * @param $array
     * @param $headers
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    private function outputXLSX($filename, $array, $headers) {
        $wf = new WriterFactory();
        $writer = $wf->create(Type::XLSX);
        try {
            $writer->openToBrowser($filename); // stream data directly to the browser
            $writer->addRow($headers);
            $writer->addRows($array); // add multiple rows at a time
            $writer->close();
        } catch (\Exception $e) {
            $writer->openToFile(storage_path('temp.xlsx'));
            $writer->addRows($headers);
            $writer->addRows($array);
            $writer->close();
        }
    }

    /**
     * @param $filename
     * @param $data
     * @param $headers
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function writeXLSXFile($filename, $data, $headers) {
        $this->outputXLSX($filename, $data, $headers);
    }

}
