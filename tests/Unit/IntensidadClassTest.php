<?php

namespace Tests\Unit;

use App\IntensityClass;
use Tests\TestCase;

class IntensidadClassTest extends TestCase
{

    public function testGetByCuenta()
    {
        $testKeys = [
            'numero_de_cuenta',
            'intensidad'
        ];
        $ic = new IntensityClass();
        $start = date('Y-m-d', strtotime('2 months ago'));
        $end = date('Y-m-d');
        $result = $ic->getByAccount($start, $end);
        $this->checkKeys($testKeys, $result);
        $result = $ic->getByAccount($end, $start);
        $this->checkKeys($testKeys, $result);
    }

    public function testGetBySegmento()
    {
        $testKeys = [
            0 => 'cliente',
            1 => 'segmento',
            2 => 'queue',
            3 => 'intensidad'
        ];
        $ic = new IntensityClass();
        $start = date('Y-m-d', strtotime('2 months ago'));
        $end = date('Y-m-d');
        $result = $ic->getBySegment($start, $end);
        $this->checkKeys($testKeys, $result);
        $result = $ic->getBySegment($end, $start);
        $this->checkKeys($testKeys, $result);
    }

    public function testGetGestionDates()
    {
        $testKeys = [
            'd_fech'
        ];
        $ic = new IntensityClass();
        $result = $ic->getCallDates('asc');
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
        $result = $ic->getCallDates('desc');
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
        $result = $ic->getCallDates('');
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
    }

    public function testGetGestionClientes()
    {
        $testKeys = [
            'c_cvba'
        ];
        $ic = new IntensityClass();
        $result = $ic->getCallClientes();
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
    }
}
