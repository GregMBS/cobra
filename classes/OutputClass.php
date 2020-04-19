<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use Box\Spout\Common\Exception\InvalidArgumentException;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\Writer\Exception\WriterNotOpenedException;
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
     * @param string $filename
     * @param array $array
     * @param array $headers
     * @throws IOException
     * @throws InvalidArgumentException
     * @throws UnsupportedTypeException
     * @throws WriterNotOpenedException
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
        try {
            $this->outputCSV($filename, $data, $headers);
        } catch (IOException $e) {
        } catch (InvalidArgumentException $e) {
        } catch (UnsupportedTypeException $e) {
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
     * @throws UnsupportedTypeException
     * @throws WriterNotOpenedException
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
        try {
            $this->outputXLSX($filename, $data, $headers);
        } catch (IOException $e) {
        } catch (InvalidArgumentException $e) {
        } catch (UnsupportedTypeException $e) {
        } catch (WriterNotOpenedException $e) {
        }
    }

}
