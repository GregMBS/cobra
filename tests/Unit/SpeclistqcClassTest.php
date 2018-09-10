<?php

namespace Tests\Unit;

use App\SpeclistqcClass;
use Illuminate\Http\Request;
use Tests\TestCase;

class SpeclistqcClassTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetSpecListReport()
    {
        $testArray = [
            0 => 'numero_de_cuenta',
            1 => 'nombre_deudor',
            2 => 'saldo_total',
            3 => 'status_aarsa',
            4 => 'ejecutivo_asignado_call_center',
            5 => 'sm',
            6 => 'status_de_credito',
            7 => 'producto',
            8 => 'estado_deudor',
            9 => 'ciudad_deudor',
            10 => 'cli',
            11 => 'idc',
            12 => 'fecha_ultima_gestion',
            13 => 'saldo_vencido'
        ];
        $r = new Request();
        $data = collect($r->all());
        $data->rato = '';
        $data->cliente = 'GCyC';
        $data->queue = 'SIN CONTACTOS';
        $sc = new SpeclistqcClass();
        $result = $sc->getSpecListReport($data);
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testArray, $keys);
        $data->cliente = '';
        $data->sdc = 'VIG MORA 1';
        $data->rato = 'diario';
        $result = $sc->getSpecListReport($data);
        $this->assertEquals(0, count($result));
        $data->rato = 'semanal';
        $result = $sc->getSpecListReport($data);
        $this->assertEquals(0, count($result));
        $data->rato = 'mensual';
        $result = $sc->getSpecListReport($data);
        $this->assertEquals(0, count($result));
    }
}
