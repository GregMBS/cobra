<?php

namespace Tests\Unit;

use App\DhvClass;
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
        $gestor = 'irineo';
        $fecha = '2014-04-27';
        $result = $dc->getPromesas($gestor, $fecha);
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
    }

    public function testGetGestiones()
    {
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
        $gestor = 'irineo';
        $fecha = '2014-04-27';
        $result = $dc->getGestiones($gestor, $fecha);
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
    }

}
