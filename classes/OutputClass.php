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
     * @param string $filename
     * @param array $array
     * @param array $headers
     * @throws IOException
     * @throws InvalidArgumentException
     * @throws WriterNotOpenedException
     */
    public function writeCSVFile($filename, $array, $headers) {
        $writer = WriterEntityFactory::createCSVWriter(); // for CSV files
        $writer->openToBrowser($filename); // stream data directly to the browser
        $row = WriterEntityFactory::createRowFromArray($headers);
        $writer->addRow($row);
        $writer->addRows($array); // add multiple rows at a time
        $writer->close();
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
    public function writeXLSXFile($filename, $array, $headers = []) {
        $writer = WriterEntityFactory::createXLSXWriter(); // for CSV files
        $writer->openToBrowser($filename); // stream data directly to the browser
        if (count($headers) > 0) {
            $row = WriterEntityFactory::createRowFromArray($headers);
            $writer->addRow($row);
        }
        $writer->addRows($array); // add multiple rows at a time
        $writer->close();
    }

}
