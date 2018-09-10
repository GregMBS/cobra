<?php

namespace Tests\Unit;

use App\CheckClass;
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
        $this->assertEquals(31, count($result));
        $first = $result[0];
        $this->assertEquals(date('Y-m-d', strtotime('-1 month')), $first);
        $last = $result[30];
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
        $cc = new CheckClass();
        $result = $cc->listVasign('');
        $this->assertEquals(array(), $result);
        $result = $cc->listVasign('gmbs');
        $this->assertEquals(array(), $result);
    }

    /**
     * @throws \Exception
     */
    public function testGetCompleto()
    {
        $cc = new CheckClass();
        $result = $cc->getCompleto('');
        $this->assertEquals('', $result);
        $result = $cc->getCompleto('gregb');
        $this->assertEquals('Greg B', $result);
    }

    public function testUpdateVasign()
    {
        $r = collect();
        $r->CUENTA = 1;
        $r->gestor = 'gregb';
        $r->fechaout = date('Y-m-d');
        $r->tipo = 'id_cuenta';
        $cc = new CheckClass();
        $result = $cc->updateVasign($r);
        $this->assertEquals(array(), $result);
        $r->tipo = 'numero_de_cuenta';
        $cc = new CheckClass();
        $result = $cc->updateVasign($r);
        $this->assertEquals(array(), $result);
    }
}
