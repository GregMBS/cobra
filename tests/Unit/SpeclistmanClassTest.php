<?php

namespace Tests\Unit;

use App\SpecListManClass;
use Tests\TestCase;

class SpeclistmanClassTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetReport()
    {
        $sc = new SpecListManClass();
        $result = $sc->getReport('GCYC', '');
        $this->assertEquals(0, count($result));
    }
}
