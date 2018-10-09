<?php

namespace Tests\Unit;

use App\DhvClass;
use App\Historia;
use Tests\TestCase;

class DhvClassTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetPromesas()
    {
        $gestion = Historia::join('resumen', 'id_cuenta', '=', 'c_cont')
            ->where('n_prom', '>', 0)
            ->where('c_visit', '<>', '')
            ->first();
        $testKeys = [
            'numero_de_cuenta',
            'nombre_deudor',
            'saldo_total',
            'status_de_credito',
            'ejecutivo_asignado_call_center',
            'pagos_vencidos',
            'status_aarsa',
            'saldo_descuento_2',
            'producto',
            'estado_deudor',
            'ciudad_deudor',
            'cliente',
            'id_cuenta',
            'monto_promesa',
            'fecha_promesa',
            'vcc'
        ];
        $dc = new DhvClass();
        if ($gestion) {
            $gestor = $gestion->C_VISIT;
            $fecha = $gestion->D_FECH;
            $result = $dc->getPromesas($gestor, $fecha);
            $this->assertGreaterThan(0, count($result));
            $first = $result[0];
            $keys = array_keys($first);
            $this->assertEquals($testKeys, $keys);
        }
        $this->assertTrue(true);
    }

    public function testGetGestiones()
    {
        $gestion = Historia::join('resumen', 'id_cuenta', '=', 'c_cont')
            ->where('c_visit', '<>', '')
            ->first();
        $testKeys = [
            'numero_de_cuenta',
            'nombre_deudor',
            'saldo_total',
            'status_de_credito',
            'ejecutivo_asignado_call_center',
            'pagos_vencidos',
            'c_cvst',
            'saldo_descuento_2',
            'producto',
            'estado_deudor',
            'ciudad_deudor',
            'cliente',
            'id_cuenta',
            'n_prom',
            'd_prom',
            'v_cc'
        ];
        $dc = new DhvClass();
        $gestor = $gestion->C_VISIT;
        $fecha = $gestion->D_FECH;
        $result = $dc->getGestiones($gestor, $fecha);
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
    }

}
