<?php

namespace Tests\Unit;

use App\Historia;
use App\HorariosDataClass;
use App\Pago;
use App\PerfmesAllClass;
use Carbon\Carbon;
use Tests\TestCase;

class PerfmesAllClassTest extends TestCase
{
    public function testGetCurrentMain()
    {
        $start = date('Y-m-d', strtotime('first day of last month'));
        $end = date('Y-m-d', strtotime('last day of last month'));
        $gestion = Historia::whereBetween('d_fech', [$start, $end])->first();
        /** @var Carbon $fecha */
        $fecha = new Carbon($gestion->D_FECH);
        $dom = $fecha->day;
        $testKeys = [
            'cuentas',
            'promesas',
            'gestiones',
            'nocontactos',
            'contactos'
        ];
        $hc = new PerfmesAllClass();
        $result = $hc->getCurrentMain($dom);
        $keys = array_keys($result);
        $this->assertEquals($testKeys, $keys);
    }

    public function testGetPagos()
    {
        $start = date('Y-m-d', strtotime('first day of 2 months ago'));
        $end = date('Y-m-d', strtotime('last day of 2 months ago'));
        $pago = Pago::whereBetween('fecha', [$start, $end])->first();
        /** @var Carbon $fecha */
        $fecha = new Carbon($pago->fecha);
        $dom = $fecha->day;
        $hc = new PerfmesAllClass();
        $result = $hc->getPagos($dom);
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
        $start = date('Y-m-d', strtotime('first day of last month'));
        $end = date('Y-m-d', strtotime('last day of last month'));
        $gestion = Historia::whereBetween('d_fech', [$start, $end])->first();
        /** @var Carbon $fecha */
        $fecha = new Carbon($gestion->D_FECH);
        $dom = $fecha->day;
        $hc = new PerfmesAllClass();
        $result = $hc->countAccountsPerDay($dom);
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
