<?php

namespace Tests\Unit;

use App\QuickHoyClass;
use Tests\TestCase;

class QuickHoyClassTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetHoy()
    {
        $testKeys = [
            'auto',
            'gestor',
            'tipo',
            'tiempo',
            'ntp',
            'diff'
        ];
        $qac = new QuickHoyClass();
        $result = $qac->getHoy();
        $count = count($result);
        if ($count == 0) {
            $this->assertEquals([], $result);
        } else {
            $first = $result[0];
            $keys = array_keys($first);
            $this->assertEquals($testKeys, $keys);
        }
    }
}
