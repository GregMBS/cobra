<?php

namespace Tests\Unit;

use App\BuscarClass;
use Tests\TestCase;

class BuscarClassTest extends TestCase
{
    public function testListClients()
    {
        $bc = new BuscarClass();
        $clients = $bc->listClients();
        $this->assertInternalType('array', $clients);
        $this->assertGreaterThan(0, count($clients));
    }

    public function testSearchAccounts()
    {
        $bc = new BuscarClass();
        $result = $bc->searchAccounts('id_cuenta', '134697', '');
        $this->assertEquals(1, count($result));
        $first = $result[0];
        $this->assertEquals('134697', $first['id_cuenta']);
        $result = $bc->searchAccounts('numero_de_cuenta', '0907139237', '');
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $last = $result[count($result) - 1];
        $this->assertContains('0907139237', $first['numero_de_cuenta'], '', true);
        $this->assertContains('0907139237', $last['numero_de_cuenta'], '', true);
        $result = $bc->searchAccounts('nombre_deudor', 'Greg', '');
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $last = $result[count($result) - 1];
        $this->assertContains('Greg', $first['nombre_deudor'], '', true);
        $this->assertContains('Greg', $last['nombre_deudor'], '', true);
        $result = $bc->searchAccounts('nombre_deudor', 'Greg', 'GCYC');
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $last = $result[count($result) - 1];
        $this->assertContains('GCYC', $first['cliente'], '', true);
        $this->assertContains('GCYC', $last['cliente'], '', true);
        $result = $bc->searchAccounts('', '', '');
        $this->assertEquals(0, count($result));
        $result = $bc->searchAccounts('ROBOT', '81', '');
        $this->assertGreaterThan(0, count($result));
        $result = $bc->searchAccounts('TELS', '81', '');
        $this->assertGreaterThan(0, count($result));
        $result = $bc->searchAccounts('REFS', '81', '');
        $this->assertGreaterThan(0, count($result));
        $result = $bc->searchAccounts('numero_de_credito', '8', '');
        $this->assertGreaterThan(0, count($result));
        $result = $bc->searchAccounts('domicilio_deudor', 'Calle', '');
        $this->assertGreaterThan(0, count($result));
    }
}
