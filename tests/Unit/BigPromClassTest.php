<?php

namespace Tests\Unit;

use App\BigDataClass;
use App\BigPromClass;
use App\Historia;
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
    public function testGetProms()
    {
        $r = new Request();
        $r->query->add([
            'gestor' => 'todos',
            'cliente' => 'todos',
            'tipo' => '',
            'fecha3' => '2018-12-31',
            'fecha4' => '2018-01-01'
            ]);
        $dataClass = new BigDataClass($r);
        $bc = new BigPromClass();
        $report = $bc->getProms($dataClass);
        $this->checkKeys($this->keys, $report);
    }

    /**
     * @return bool
     */
    private function hasProms(): bool
    {
        $date = date('Y-m-d', strtotime('last day of last month'));
        $count = Historia::where('n_prom', '>', 0)->where('d_fech', '>', $date)->count();
        return ($count > 0);
    }

    public function testGetPromClientes()
    {
        if ($this->hasProms()) {
            $bc = new BigPromClass();
            $clientes = $bc->getPromClientes();
            $this->assertInternalType('array', $clientes);
            $this->assertNotEmpty($clientes);
        }
        $this->assertTrue(true);
    }

    public function testGetPromGestores()
    {
        if ($this->hasProms()) {
            $bc = new BigPromClass();
            $gestores = $bc->getPromGestores();
            $this->assertInternalType('array', $gestores);
            $this->assertNotEmpty($gestores);
        }
        $this->assertTrue(true);
    }

    public function testPromDates()
    {
        if ($this->hasProms()) {
            $bc = new BigPromClass();
            $dirs = ['asc', 'ASC', 'desc', 'DESC', ''];
            foreach ($dirs as $dir) {
                $dates = $bc->getPromDates($dir);
                $this->assertInternalType('array', $dates);
                $this->assertNotEmpty($dates);
            }
        }
        $this->assertTrue(true);
    }
}
