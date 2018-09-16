<?php

namespace Tests\Unit;

use App\IntensidadClass;
use Tests\TestCase;

class IntensidadClassTest extends TestCase
{

    public function testGetByCuenta()
    {
        $testKeys = [
            'numero_de_cuenta',
            'intensidad'
        ];
        $ic = new IntensidadClass();
        $start = date('Y-m-d', strtotime('2 months ago'));
        $end = date('Y-m-d');
        $result = $ic->getByCuenta($start, $end);
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
        $result = $ic->getByCuenta($end, $start);
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
    }

    public function testGetBySegmento()
    {
        $testKeys = [
            0 => 'cliente',
            1 => 'segmento',
            2 => 'queue',
            3 => 'intensidad'
        ];
        $ic = new IntensidadClass();
        $start = date('Y-m-d', strtotime('2 months ago'));
        $end = date('Y-m-d');
        $result = $ic->getBySegmento($start, $end);
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
        $result = $ic->getBySegmento($end, $start);
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
    }

    public function testGetGestionDates()
    {
        $testKeys = [
            'd_fech'
        ];
        $ic = new IntensidadClass();
        $result = $ic->getGestionDates('asc');
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
        $result = $ic->getGestionDates('desc');
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
        $result = $ic->getGestionDates('');
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
        $ic = new IntensidadClass();
        $result = $ic->getGestionClientes();
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
    }
}
