<?php

namespace cobra_salsa;

use OpenSpout\Common\Exception\IOException;
use Exception;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Writer\Common\Creator\WriterEntityFactory;
use OpenSpout\Writer\Exception\WriterNotOpenedException;
use RuntimeException;

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
    public function writeCSVFile(string $filename, array $array, array $headers): void
    {
        try {
            $this->writeFile('csv', $filename, $headers, $array);
        } catch (Exception $e) {
            throw new RuntimeException($e);
        }
    }

    /**
     *
     * @param string $filename
     * @param array $array
     * @param array|null $headers
     * @throws Exception
     */
    public function writeXLSXFile(string $filename, array $array, ?array $headers = []): void
    {
        try {
            $this->writeFile('xlsx', $filename, $headers, $array);
        } catch (Exception $e) {
            throw new RuntimeException($e);
        }
    }

    /**
     * @param string $type
     * @param string $filename
     * @param array $headers
     * @param array $array
     * @return void
     * @throws IOException
     * @throws WriterNotOpenedException
     * @throws UnsupportedTypeException
     */
    private function writeFile(string $type, string $filename, array $headers, array $array): void
    {
        $writer = WriterEntityFactory::createWriter($type);
        $writer->openToBrowser($filename);
        $row = WriterEntityFactory::createRowFromArray($headers);
        $writer->addRow($row);
        foreach ($array as $data) {
            $row = WriterEntityFactory::createRowFromArray($data);
            $writer->addRow($row);
        }
        $writer->close();
    }

}
