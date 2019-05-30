<?php

namespace Tests\Unit;

use App\QuickNowClass;
use Tests\TestCase;

class QuickNowClassTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetNow()
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
        $qac = new QuickNowClass();
        $result = $qac->getNow();
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
