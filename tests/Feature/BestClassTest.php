<?php

namespace Tests\Feature;

use App\BestClass;
use Tests\TestCase;

class BestClassTest extends TestCase
{
    /**
     * @var array
     */
    private $keys = [
        "id_cuenta",
        "numero_de_cuenta",
        "segmento",
        "saldo_total",
        "fecha_ultima_gestion",
        "nombre_deudor",
        "producto",
        "status_cuenta",
        "ultimo_status",
        "ultimo_tel",
        "ultimo_comentario",
        "mejor_status",
        "mejor_tel"
    ];

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetReport()
    {
        $bc = new BestClass();
        $report = $bc->getReport();
        $this->assertGreaterThan(0, count($report));
        $first = $report[0];
        $keys = array_keys($first);
        $this->assertEquals(count($this->keys), count($keys));
        $this->assertEquals($this->keys, $keys);
    }
}
