<?php

namespace Tests\Unit;

use App\Resumen;
use App\SpeclistDataClass;
use App\SpeclistqcClass;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Tests\TestCase;

class SpeclistqcClassTest extends TestCase
{

    /**
     * @param array $data
     * @return array
     */
    private function getAQueue(array $data) {
        /** @var Builder $query */
        $query = Resumen::join('dictamenes', 'status_aarsa', '=', 'dictamen')
            ->where('fecha_ultima_gestion', '>', date('Y-m-d', strtotime('end of last month')));
        $resumen = $query->first();
        if ($resumen) {
            $data['rato'] = '';
            $data['cliente'] = $resumen->cliente;
            $data['queue'] = $resumen->queue;
            $data['sdc'] = $resumen->status_de_credito;
        }
        return $data;
    }

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
        $array = $r->all();
        $data = $this->getAQueue($array);
        if ($data) {
            $dataClass = new SpeclistDataClass($data);
            $sc = new SpeclistqcClass();
            $result = $sc->getSpecListReport($dataClass);
            $this->assertGreaterThan(0, count($result));
            $first = $result[0];
            $keys = array_keys($first);
            $this->assertEquals($testArray, $keys);
            $data['cliente'] = '';
            $data['sdc'] = 'VIG MORA 1';
            $data['rato'] = 'diario';
            $dataClass = new SpeclistDataClass($data);
            $result = $sc->getSpecListReport($dataClass);
            $this->assertEquals(0, count($result));
            $data['rato'] = 'semanal';
            $dataClass = new SpeclistDataClass($data);
            $result = $sc->getSpecListReport($dataClass);
            $this->assertEquals(0, count($result));
            $data['rato'] = 'mensual';
            $dataClass = new SpeclistDataClass($data);
            $result = $sc->getSpecListReport($dataClass);
            $this->assertEquals(0, count($result));
        }
        $this->assertTrue(true);
    }
}
