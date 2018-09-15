<?php

namespace Tests\Unit;

use App\QuickPorHoraClass;
use Tests\TestCase;

class QuickPorHoraClassTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetPorHora()
    {
        $testKeys = [
            'auto',
            'gestor',
            'tipo',
            'tiempo',
            'ntp',
            'diff'
        ];
        $qac = new QuickPorHoraClass();
        $result = $qac->getPorHora();
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
