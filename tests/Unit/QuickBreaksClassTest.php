<?php

namespace Tests\Unit;

use App\QuickBreaksClass;
use Tests\TestCase;

class QuickBreaksClassTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAhora()
    {
        $testKeys = [
            'auto',
            'gestor',
            'tipo',
            'tiempo',
            'ntp',
            'diff'
        ];
        $qac = new QuickBreaksClass();
        $result = $qac->getBreaks();
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
