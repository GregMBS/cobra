<?php

namespace Tests\Unit;

use App\Historia;
use App\HoursAllClass;
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
        $hc = new HoursAllClass();
        $result = $hc->getCurrentMain(2);
        $keys = array_keys($result);
        $this->assertEquals($testKeys, $keys);
    }

    public function testGetPagos()
    {
        $hc = new HoursAllClass();
        $result = $hc->getPayments(2);
        $this->assertEquals(0, $result['ct']);
    }

    public function testCountAccounts()
    {
        $from = date('Y-m-d', strtotime('last day of last month'));
        $count = Historia::where('d_fech', '>', $from)->where('c_cont', '>', 0)->count();
        $hc = new HoursAllClass();
        $result = $hc->countAccounts();
        if ($count > 0) {
            $this->assertGreaterThan(0, $result);
        } else {
            $this->assertEquals(0, $result);
        }
    }

    public function testCountAccountsPerDay()
    {
        $hc = new HoursAllClass();
        $result = $hc->countAccountsPerDay(2);
        $this->assertEquals(0, $result);
    }
}
