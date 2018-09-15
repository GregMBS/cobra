<?php

namespace Tests\Unit;

use App\DhClass;
use Tests\TestCase;

class DhClassTest extends TestCase
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
            'status_de_credito',
            'ejecutivo_asignado_call_center',
            'status_aarsa',
            'saldo_descuento_2',
            'cliente',
            'id_cuenta',
            'monto_promesa',
            'fecha_promesa'
        ];

        $dc = new DhClass();
        $gestor = 'montse';
        $fecha = '2017-03-06';
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
            'status_de_credito',
            'ejecutivo_asignado_call_center',
            'status_aarsa',
            'saldo_descuento_2',
            'cliente',
            'id_cuenta',
            'd_fech',
            'c_hrin',
            'c_cvst',
            'c_contan'
        ];

        $dc = new DhClass();
        $gestor = 'montse';
        $fecha = '2017-03-06';
        $result = $dc->getGestiones($gestor, $fecha);
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
    }

    public function testGetDhMain()
    {
        $testKeys = [
            'numero_de_cuenta',
            'nombre_deudor',
            'saldo_total',
            'status_de_credito',
            'status_aarsa',
            'ejecutivo_asignado_call_center',
            'dias_vencidos',
            'c_cvst',
            'c_hrin',
            'saldo_descuento_2',
            'producto',
            'estado_deudor',
            'ciudad_deudor',
            'cliente',
            'id_cuenta',
            'n_prom',
            'd_prom',
            'vcc'
        ];

        $dc = new DhClass();
        $gestor = 'montse';
        $fecha = '2017-03-06';
        $result = $dc->getDhMain($gestor, $fecha);
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
    }
}
