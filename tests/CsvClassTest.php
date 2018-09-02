<?php

namespace Tests;

use App\CsvClass;

class CsvClassTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetCSV()
    {
        $cc = new CsvClass();
        $array = ['first','second','third'];
        $string = "first,second,third" . "\n";
        $output = $cc->getCSV($array);
        $this->assertEquals($string, $output);
    }
}
