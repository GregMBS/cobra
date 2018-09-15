<?php

namespace Tests\Unit;

use App\HorariosDataClass;
use App\PerfmesAllClass;
use Tests\TestCase;

class PerfmesAllClassTest extends TestCase
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
        $hc = new PerfmesAllClass();
        $result = $hc->getCurrentMain(2);
        $keys = array_keys($result);
        $this->assertEquals($testKeys, $keys);
    }

    public function testGetPagos()
    {
        $hc = new PerfmesAllClass();
        $result = $hc->getPagos(2);
        $this->assertGreaterThan(0, $result['ct']);
    }

    public function testCountAccounts()
    {
        $hc = new PerfmesAllClass();
        $result = $hc->countAccounts();
        $this->assertGreaterThan(0, $result);
    }

    public function testCountAccountsPerDay()
    {
        $hc = new PerfmesAllClass();
        $result = $hc->countAccountsPerDay(2);
        $this->assertGreaterThan(0, $result);
    }

    public function testGetReport()
    {
        $hc = new PerfmesAllClass();
        $result = $hc->getReport(2);
        $this->assertGreaterThan(0, count($result));
        $first = array_pop($result);
        $this->assertInstanceOf(HorariosDataClass::class, $first);
    }
}
