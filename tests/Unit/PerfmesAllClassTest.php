<?php

namespace Tests\Unit;

use App\Historia;
use App\HoursDataClass;
use App\LastMonthAllClass;
use App\Pago;
use Carbon\Carbon;
use Tests\TestCase;

class PerfmesAllClassTest extends TestCase
{
    public function testGetCurrentMain()
    {
        $start = date('Y-m-d', strtotime('first day of last month'));
        $end = date('Y-m-d', strtotime('last day of last month'));
        $gestion = Historia::whereBetween('d_fech', [$start, $end])->first();
        $fecha = new Carbon($gestion->D_FECH);
        $dom = $fecha->day;
        $testKeys = [
            'cuentas',
            'promesas',
            'gestiones',
            'nocontactos',
            'contactos'
        ];
        $hc = new LastMonthAllClass();
        $result = $hc->getCurrentMain($dom);
        $this->checkKeys($testKeys, $result);
    }

    public function testGetPagos()
    {
        $start = date('Y-m-d', strtotime('first day of 1 month ago'));
        $end = date('Y-m-d', strtotime('last day of 1 month ago'));
        $pago = Pago::whereBetween('fecha', [$start, $end])->first();
        $count = Pago::whereFecha($pago->fecha)->count();
        if ($pago) {
            $fecha = new Carbon($pago->fecha);
            $dom = $fecha->day;
            $hc = new LastMonthAllClass();
            $result = $hc->getPayments($dom);
            $this->assertEquals($count, $result['ct']);
        }
        $this->assertTrue(true);
    }

    public function testCountAccounts()
    {
        $from = date('Y-m-d', strtotime('first day of last month'));
        $to = date('Y-m-d', strtotime('last day of last month'));
        $query = Historia::whereBetween('d_fech', [$from, $to])
            ->where('c_cont', '>', 0)
            ->whereNull('c_cniv')
            ->whereNull('c_msge');
        $count = $query->count();
        $hc = new LastMonthAllClass();
        $result = $hc->countAccounts();
        if ($count > 0) {
            $this->assertGreaterThan(0, $result);
        } else {
            $this->assertEquals(0, $result);
        }
    }

    public function testCountAccountsPerDay()
    {
        $start = date('Y-m-d', strtotime('first day of last month'));
        $end = date('Y-m-d', strtotime('last day of last month'));
        $gestion = Historia::whereBetween('d_fech', [$start, $end])
            ->where('c_cont', '>', 0)
            ->whereNull('c_cniv')
            ->whereNull('c_msge')
            ->first();
        if ($gestion) {
            /** @var Carbon $fecha */
            $fecha = new Carbon($gestion->D_FECH);
            $dom = $fecha->day;
            $hc = new LastMonthAllClass();
            $result = $hc->countAccountsPerDay($dom);
            $this->assertGreaterThan(0, $result);
        }
        $this->assertTrue(true);
    }

    public function testGetReport()
    {
        $hc = new LastMonthAllClass();
        $result = $hc->getReport(2);
        $this->assertGreaterThan(0, count($result));
        $first = array_pop($result);
        $this->assertInstanceOf(HoursDataClass::class, $first);
    }
}
