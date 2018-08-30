<?php

namespace Tests\Feature;

use App\BigDataClass;
use App\BigPromClass;
use Illuminate\Http\Request;
use Tests\TestCase;

class BigPromClassTest extends TestCase
{
    private $keys = [
        0 => "id_cuenta",
  1 => "STATUS",
  2 => "GESTOR",
  3 => "CUENTA",
  4 => "NOMBRE",
  5 => "SALDO CAPITAL s/i",
  6 => "SALDO TOTAL",
  7 => "MORA",
  8 => "TOTAL PROMESA",
  9 => "FECHA PROMESA 1",
  10 => "MONTO PROMESA 1",
  11 => "FECHA PROMESA 2",
  12 => "MONTO PROMESA 2",
  13 => "MOTIVADOR",
  14 => "CAUSA NO PAGO",
  15 => "CLIENTE",
  16 => "CAMPANA",
  17 => "FECHA GESTION",
  18 => "FECHA PAGO",
  19 => "MONTO PAGO",
  20 => "CONFIRMADO"
];

    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAllProms()
    {
        $r = new Request();
        $dataClass = new BigDataClass($r);
        $dataClass->gestor = 'todos';
        $dataClass->cliente = 'todos';
        $bc = new BigPromClass();
        $report = $bc->getProms($dataClass);
        $first = $report[0];
        $keys = array_keys($first);
        $this->assertEquals(count($this->keys), count($keys));
        $this->assertEquals($this->keys, $keys);
    }
}
