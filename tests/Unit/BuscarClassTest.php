<?php

namespace Tests\Unit;

use App\SearchClass;
use App\Resumen;
use Tests\TestCase;

class BuscarClassTest extends TestCase
{
    public function testListClients()
    {
        $bc = new SearchClass();
        $clients = $bc->listClients();
        $this->assertInternalType('array', $clients);
        $this->assertGreaterThan(0, count($clients));
    }

    public function testSearchAccounts()
    {
        $bc = new SearchClass();
        $cuenta = Resumen::where('tel_1', '<>', '')
            ->where('tel_1_ref_1', '<>', '')
            ->first();
        if ($cuenta) {
            $result = $bc->searchAccounts('id_cuenta', $cuenta->id_cuenta, '');
            $this->assertEquals(1, count($result));
            $first = $result[0];
            $this->assertEquals($cuenta->id_cuenta, $first['id_cuenta']);
            $result = $bc->searchAccounts('numero_de_cuenta', $cuenta->numero_de_cuenta, '');
            $this->assertGreaterThan(0, count($result));
            $first = $result[0];
            $last = $result[count($result) - 1];
            $this->assertContains($cuenta->numero_de_cuenta, $first['numero_de_cuenta'], '', true);
            $this->assertContains($cuenta->numero_de_cuenta, $last['numero_de_cuenta'], '', true);
            $result = $bc->searchAccounts('nombre_deudor', $cuenta->nombre_deudor, '');
            $this->assertGreaterThan(0, count($result));
            $first = $result[0];
            $last = $result[count($result) - 1];
            $this->assertContains($cuenta->nombre_deudor, $first['nombre_deudor'], '', true);
            $this->assertContains($cuenta->nombre_deudor, $last['nombre_deudor'], '', true);
            $result = $bc->searchAccounts('nombre_deudor', $cuenta->nombre_deudor, $cuenta->cliente);
            $this->assertGreaterThan(0, count($result));
            $first = $result[0];
            $last = $result[count($result) - 1];
            $this->assertContains($cuenta->cliente, $first['cliente'], '', true);
            $this->assertContains($cuenta->cliente, $last['cliente'], '', true);
            $result = $bc->searchAccounts('', '', '');
            $this->assertEquals(0, count($result));
            $result = $bc->searchAccounts('TELS', $cuenta->tel_1, '');
            $this->assertGreaterThan(0, count($result));
            $result = $bc->searchAccounts('REFS', $cuenta->tel_1_ref_1, $cuenta->cliente);
            $this->assertGreaterThan(0, count($result));

            $result = $bc->searchAccounts('numero_de_cuenta', $cuenta->numero_de_cuenta, $cuenta->cliente);
            $this->assertGreaterThan(0, count($result));

            $result = $bc->searchAccounts('domicilio_deudor', 'Calle', '');
            $this->assertGreaterThan(0, count($result));
        }
        $this->assertTrue(true);
    }
}
