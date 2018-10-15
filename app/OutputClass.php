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
class OutputClass
{

    /**
     * @param string $filename
     * @param array $data
     * @param array $headers
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function writeCSVFile(string $filename, array $data, array $headers)
    {
        $wf = new WriterFactory();
        $writer = $wf->create(Type::CSV); // for CSV files
        $writer->openToBrowser($filename); // stream data directly to the browser
        $writer->addRow($headers);
        $writer->addRows($data); // add multiple rows at a time
        $writer->close();
    }

    /**
     * @param string $filename
     * @param array $data
     * @param array $headers
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function writeXLSXFile(string $filename, array $data, array $headers)
    {
        $wf = new WriterFactory();
        $writer = $wf->create(Type::XLSX);
        $writer->openToBrowser($filename);
        $writer->addRow($headers);
        $writer->addRows($data); // add multiple rows at a time
        $writer->close();
    }
}
