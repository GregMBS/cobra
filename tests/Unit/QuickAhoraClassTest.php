<?php

namespace Tests\Unit;

use App\QuickAhoraClass;
use Tests\TestCase;

class QuickAhoraClassTest extends TestCase
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
            'cuenta',
            'nombre',
            'cliente',
            'camp',
            'status',
            'tiempo',
            'queue',
            'sistema',
            'login',
            'logout',
            'id_cuenta'
        ];
        $qac = new QuickAhoraClass();
        $result = $qac->getAhora();
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
