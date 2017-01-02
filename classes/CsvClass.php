<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

/**
 * Description of CsvClass
 *
 * @author gmbs
 */
class CsvClass {

    /**
     * 
     * @param array $array
     */
    private function outputCSV($array) {
        $file = fopen('php://output', 'w'); // this file actual writes to php output
        fputcsv($file, $array);
        fclose($file);
    }
    
    /**
     * 
     * @param string $filename
     */
    private function setHeaders($filename) {
        header('Content-type: application/xls');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
    }

    /**
     * 
     * @param array $array
     * @return string
     */
    public function writeCSVFile($filename, $data, $headers = '') {
        $this->setHeaders($filename);
        $array = array();
        if (!empty($headers)) {
            $array[] = $headers;
        }
        $array[] = $data;
        ob_start(); // buffer the output ...
        $this->outputCSV($array);
        return ob_get_clean(); // ... then return it as a string!
    }

}
