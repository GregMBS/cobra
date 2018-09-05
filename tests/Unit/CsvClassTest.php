<?php

namespace Tests\Unit;

use App\CsvClass;
use Tests\TestCase;

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
