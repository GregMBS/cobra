<?php

namespace cobra_salsa;

use OpenSpout\Reader\Common\Creator\ReaderEntityFactory;
use Exception;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Description of InputClass
 *
 * @author gmbs
 */
class InputClass
{

    /**
     *
     * @param string $filename
     * @return array
     * @throws Exception
     */
    public function readXLSXFile(string $filename): array
    {
        try {
            $reader = ReaderEntityFactory::createXLSXReader();
            $reader->open($filename);
            $output = [];
            foreach ($reader->getSheetIterator() as $sheet) {
                if ($sheet->getIndex() === 0) { // index is 0-based
                    $rowIndex = 0;
                    foreach ($sheet->getRowIterator() as $row) {
                        $rowOut = [];
                        if ($rowIndex !== 0) {
                            $cells = $row->getCells();
                            foreach ($cells as $cell) {
                                $rowOut[] = $cell->getValue();
                            }
                            $output[] = $rowOut;
                        }
                        $rowIndex++;
                    }
                }
            }
            return $output;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
