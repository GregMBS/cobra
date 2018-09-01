<?php

namespace Tests;

use App\BigDataClass;
use App\BigPromClass;
use Illuminate\Http\Request;


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
    public function testGetProms()
    {
        $r = new Request();
        $r->query->add(
            ['gestor' => 'miguel',
                'cliente' => 'GCYC',
                'tipo' => '',
                'fecha3' => '2018-12-12',
                'fecha4' => '2008-12-12']
        );
        $dataClass = new BigDataClass($r);
        $bc = new BigPromClass();
        $report = $bc->getProms($dataClass);
        $first = $report[0];
        $keys = array_keys($first);
        $this->assertEquals(count($this->keys), count($keys));
        $this->assertEquals($this->keys, $keys);
    }

    public function testGetPromClientes()
    {
        $bc = new BigPromClass();
        $clientes = $bc->getPromClientes();
        $this->assertInternalType('array', $clientes);
        $this->assertNotEmpty($clientes);
    }

    public function testGetPromGestores()
    {
        $bc = new BigPromClass();
        $gestores = $bc->getPromGestores();
        $this->assertInternalType('array', $gestores);
        $this->assertNotEmpty($gestores);
    }

    public function testPromDates()
    {
        $bc = new BigPromClass();
        $dirs = ['asc', 'ASC', 'desc', 'DESC', ''];
        foreach ($dirs as $dir) {
            $dates = $bc->getPromDates($dir);
            $this->assertInternalType('array', $dates);
            $this->assertNotEmpty($dates);
        }
    }
}
