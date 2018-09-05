<?php

namespace Tests\Unit;

use App\ActivarClass;
use Tests\TestCase;

class ActivarClassTest extends TestCase
{

    private $cuentas = ['1599105359','8901018408'];

    public function testActivateCuentas()
    {
        $count = count($this->cuentas);
        $ac = new ActivarClass();
        $result = $ac->activateCuentas($this->cuentas);
        $this->assertEquals(0, $result['inactive']);
        $this->assertEquals($count, $result['active']);
    }

    public function testInactivateCuentas()
    {
        $count = count($this->cuentas);
        $ac = new ActivarClass();
        $result = $ac->inactivateCuentas($this->cuentas);
        $this->assertEquals(0, $result['active']);
        $this->assertEquals($count, $result['inactive']);
    }
}
