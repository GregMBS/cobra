<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use OpenSpout\Common\Exception\IOException;
use Exception;
use OpenSpout\Writer\Common\Creator\WriterEntityFactory;
use OpenSpout\Writer\Exception\WriterNotOpenedException;

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
            $writer = WriterEntityFactory::createCSVWriter();
            $this->writeFile($writer, $filename, $headers, $array);
            $writer->close();
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
            $writer = WriterEntityFactory::createXLSXWriter();
            $this->writeFile($writer, $filename, $headers, $array);
            $writer->close();
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    /**
     * @param $writer
     * @param string $filename
     * @param array $headers
     * @param array $array
     * @return void
     * @throws IOException
     * @throws WriterNotOpenedException
     */
    private function writeFile($writer, string $filename, array $headers, array $array): void
    {
        $writer->openToFile($filename);
        $row = WriterEntityFactory::createRowFromArray($headers);
        $writer->addRow($row);
        foreach ($array as $data) {
            $row = WriterEntityFactory::createRowFromArray($data);
            $writer->addRow($row);
        }
    }

}
