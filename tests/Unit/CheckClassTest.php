<?php

namespace Tests\Unit;

use App\CheckClass;
use App\User;
use App\Vasign;
use App\Resumen;
use Tests\TestCase;

class CheckClassTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testGetOneMonth()
    {
        $cc = new CheckClass();
        $result = $cc->getOneMonth();
        $lastDay = (int) date('d', strtotime('last day of last month'));
        $this->assertEquals($lastDay, count($result));
        $first = $result[0];
        $this->assertEquals(date('Y-m-d', strtotime('-1 month')), $first);
        $last = $result[$lastDay - 1];
        $this->assertEquals(date('Y-m-d', strtotime('yesterday')), $last);
    }

    public function testCountInOut()
    {
        $cc = new CheckClass();
        $result = $cc->countInOut('gmbs');
        $keys = array_keys($result);
        $this->assertEquals(['asig', 'recib'], $keys);
    }

    public function testListVasign()
    {
        $testKeys = ['id_cuenta',
            'numero_de_cuenta',
            'nombre_deudor',
            'cliente',
            'saldo_total',
            'queue',
            'gestor',
            'fechaOut',
            'fechaIn'
        ];
        $cc = new CheckClass();
        $result = $cc->listVisitorAssignment('');
        if ($result) {
            $this->checkKeys($testKeys, $result);
        }
        $result = $cc->listVisitorAssignment('gmbs');
        $this->assertEquals(array(), $result);
    }

    /**
     * @throws \Exception
     */
    public function testGetCompleto()
    {
        $user = User::first();
        $cc = new CheckClass();
        $result = $cc->getFullName('');
        $this->assertEquals('', $result);
        $result = $cc->getFullName($user->iniciales);
        $this->assertEquals($user->completo, $result);
    }

    /**
     * @throws \Exception
     */
    public function testInsertUpdateVasign()
    {
        $resumen = Resumen::where('numero_de_cuenta', '<>', '')->first();
        if ($resumen) {
            $r = collect();
            $r->CUENTA = $resumen->id_cuenta;
            $r->gestor = 'gregb';
            $r->fechaout = date('Y-m-d');
            $r->tipo = 'id_cuenta';
            $array = [
                'cuenta' => $resumen->numero_de_cuenta,
                'c_cont' => $resumen->id_cuenta,
                'gestor' => 'gregb',
                'fechaout' => date('Y-m-d')
            ];
            $cc = new CheckClass();
            $cc->insertVisitorAssignment($r);
            $this->assertDatabaseHas('vasign', $array);
            $r->fechain = date('Y-m-d');
            $array['fechain'] = date('Y-m-d');
            $cc->updateVisitorAssignment($r);
            $this->assertDatabaseHas('vasign', $array);
            Vasign::whereGestor('gregb')->whereFechaout(date('Y-m-d'))->delete();
        }
        $this->assertTrue(true);
    }
}
