<?php

namespace Tests\Feature;

use App\ComparativoClass;
use Tests\TestCase;

class ComparativoClassTest extends TestCase
{
    /**
     * @var array
     */
    private $keys = [
        "c_cvba",
        "mdf",
        "sg",
        "sc",
        "sp",
        "cg",
        "ch"
    ];

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetReport()
    {
        $cc = new ComparativoClass();
        $report = $cc->getReport();
        $this->assertGreaterThan(0, count($report));
        $first = $report[0];
        $keys = array_keys($first);
        $this->assertEquals(count($this->keys), count($keys));
        $this->assertEquals($this->keys, $keys);
    }
}
