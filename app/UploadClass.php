<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

require_once 'vendor/autoload.php';

/**
 * Description of UploadClass
 *
 * @author gmbs
 */
class UploadClass {

    public function reader($filename) {

        $data = array();
        try {
            $reader = ReaderFactory::create(Type::XLSX);
            $reader->open($filename);

            $reader->nextSheet();
            $i = 0;
            while ($reader->hasNextRow()) {
                $row = $reader->nextRow();
                if ($i == 0) {
                    $titles = $row;
                } 
                if ($i > 0) {
                    $data[] = $row;
                }
                $i++;
            }
            $output = $this->toAssociative($titles, $data);
            return $output;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 
     * @param array $titles
     * @param array $data
     * @return array
     */
    private function toAssociative(array $titles, array $data) {
        $result = array();
        foreach ($data as $row) {
            $temp = array();
            $i = 0;
            foreach ($row as $item) {
                $temp[$titles[$i]] = $item;
                $i++;
            }
            $result[] = $temp;
        }
        return $result;
    }

}
