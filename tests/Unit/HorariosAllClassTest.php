<?php

namespace Tests\Unit;

use App\HorariosAllClass;
use Tests\TestCase;

class HorariosAllClassTest extends TestCase
{
    public function testGetCurrentMain()
    {
        $testKeys = [
            'cuentas',
            'promesas',
            'gestiones',
            'nocontactos',
            'contactos'
        ];
        $hc = new HorariosAllClass();
        $result = $hc->getCurrentMain(2);
        $keys = array_keys($result);
        $this->assertEquals($testKeys, $keys);
    }

    public function testGetPagos()
    {
        $hc = new HorariosAllClass();
        $result = $hc->getPagos(2);
        $this->assertEquals(0, $result['ct']);
    }

    public function testCountAccounts()
    {
        $hc = new HorariosAllClass();
        $result = $hc->countAccounts();
        $this->assertEquals(0, $result);
    }

    public function testCountAccountsPerDay()
    {
        $hc = new HorariosAllClass();
        $result = $hc->countAccountsPerDay(2);
        $this->assertEquals(0, $result);
    }
}
