<?php

namespace Tests\Unit;

use App\InventarioClass;
use App\Resumen;
use Tests\TestCase;

class InventarioClassTest extends TestCase
{

    public function testGetInventarioReport()
    {
        $testKeys = [
            'id_cuenta',
            'numero_de_cuenta',
            'nombre_deudor',
            'cliente',
            'segmento',
            'disposicion',
            'producto',
            'subproducto',
            'saldo_total',
            'queue',
            'saldo_descuento_1',
            'saldo_descuento_2',
            'domicilio_deudor',
            'colonia_deudor',
            'ciudad_deudor',
            'estado_deudor',
            'cp_deudor',
            'ejecutivo_asignado_call_center',
            'ejecutivo_asignado_domiciliario',
            'gestiones',
            'contactos',
            'fecha_de_asignacion',
        ];
        $ic = new InventarioClass();
        $result = $ic->getInventarioReport('todos');
        $this->checkKeys($testKeys, $result);
        $cuenta = Resumen::where('status_de_credito', 'NOT REGEXP', '-')->first();
        $cliente = $cuenta->cliente;
        $result = $ic->getInventarioReport($cliente);
        $this->checkKeys($testKeys, $result);
    }

    public function testGetFullInventarioReport()
    {
        $testKeys = [
            0 => 'numero_de_cuenta',
            1 => 'nombre_deudor',
            2 => 'cliente',
            3 => 'status_de_credito',
            4 => 'saldo_total',
            5 => 'queue',
            6 => 'domicilio_deudor',
            7 => 'direccion_nueva',
            8 => 'email_deudor',
            9 => 'tel_1',
            10 => 't1 efectivo',
            11 => 'tel_2',
            12 => 't2 efectivo',
            13 => 'tel_3',
            14 => 't3 efectivo',
            15 => 'tel_4',
            16 => 't4 efectivo',
            17 => 'tel_1_verif',
            18 => 't1v efectivo',
            19 => 'tel_2_verif',
            20 => 't2v efectivo',
            21 => 'tel_3_verif',
            22 => 't3v efectivo',
            23 => 'tel_4_verif',
            24 => 't4v efectivo',
            25 => 'tel_1_laboral',
            26 => 't1l efectivo',
            27 => 'tel_2_laboral',
            28 => 't2l efectivo'
        ];
        $ic = new InventarioClass();
        $result = $ic->getFullInventarioReport('todos');
        $this->checkKeys($testKeys, $result);
        $cuenta = Resumen::where('status_de_credito', 'NOT REGEXP', '-')->first();
        $cliente = $cuenta->cliente;
        $result = $ic->getFullInventarioReport($cliente);
        $this->checkKeys($testKeys, $result);
    }

    public function testListCliente()
    {
        $ic = new InventarioClass();
        $result = $ic->listClients();
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $this->assertEquals(['cliente' => ''], $first);
    }
}
