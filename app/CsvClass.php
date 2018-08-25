<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

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
     * @param array $array
     * @return string
     */
    public function getCSV($array) {
        ob_start(); // buffer the output ...
        $this->outputCSV($array);
        return ob_get_clean(); // ... then return it as a string!
    }

}
