<?php

namespace Tests\Unit;

use App\LoadClass;
use App\Cliente;
use App\Resumen;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class LoadClassTest extends TestCase
{
    public function testListClientes()
    {
        $count = Cliente::count();
        if ($count > 0) {
            $testKeys = ['cliente'];
            $cc = new LoadClass();
            $result = $cc->listClients();
            $this->checkKeys($testKeys, $result);
        }
        $this->assertTrue(true);
    }

    public function testUpdateClientes()
    {
        $cc = new LoadClass();
        $cc->updateClients();
        $clientes = Cliente::all(['cliente'])->toArray();
        /** @var Builder $query */
        $query = Resumen::distinct()->orderBy('cliente');
        $resumen = $query->get(['cliente'])->toArray();
        $this->assertEquals($resumen, $clientes);
    }

    public function testCheckDuplicates()
    {
        $cc = new LoadClass();
        $testDupe = ['a', 'a', 'b', 'c'];
        $result = $cc->checkDuplicates($testDupe);
        $expected = ['flag' => true, 'columns' => ['a']];
        $this->assertEquals($expected, $result);
        $testNoDupe = ['a', 'b', 'c'];
        $result = $cc->checkDuplicates($testNoDupe);
        $expected = ['flag' => false, 'columns' => []];
        $this->assertEquals($expected, $result);
    }

    public function testBadNames()
    {
        $cc = new LoadClass();
        $testBad = ['a', 'a', 'b', 'c'];
        $result = $cc->badName($testBad);
        $expected = ['flag' => true, 'columns' => $testBad];
        $this->assertEquals($expected, $result);
        $testGood = ['cliente', 'numero_de_cuenta', 'nombre_deudor'];
        $result = $cc->badName($testGood);
        $expected = ['flag' => false, 'columns' => []];
        $this->assertEquals($expected, $result);
    }
}
