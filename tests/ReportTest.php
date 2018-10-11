<?php

namespace Tests;

use App\BaseClass;

abstract class ReportTest extends TestCase
{
    /**
     * @var array
     */
    protected $keys = [];

    /**
     * @var BaseClass
     */
    protected $class;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetReport()
    {
        $report = $this->class->getReport();
        if ($report) {
            $this->assertGreaterThan(0, count($report));
            $first = $report[0];
            $keys = array_keys($first);
            $this->assertEquals(count($this->keys), count($keys));
            $this->assertEquals($this->keys, $keys);
        }
        $this->assertTrue(true);
    }
}
