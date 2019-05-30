<?php

namespace Tests\Unit;

use App\ActivateClass;
use App\Resumen;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ActivateClassTest extends TestCase
{

    private $cuentas = [];

    private function getCuentas()
    {
        /** @var Collection $query */
        $query = Resumen::where('status_de_credito', 'not regexp', '-')->get();
        $this->cuentas = $query->pluck('numero_de_cuenta')->toArray();
    }

    public function testActivateCuentas()
    {
        $this->getCuentas();
        $count = count($this->cuentas);
        $ac = new ActivateClass();
        $result = $ac->activateAccounts($this->cuentas);
        $this->assertEquals(0, $result['inactive']);
        $this->assertEquals($count, $result['active']);
    }

    public function testInactivateCuentas()
    {
        $count = count($this->cuentas);
        $ac = new ActivateClass();
        $result = $ac->inactivateAccounts($this->cuentas);
        $this->assertEquals(0, $result['active']);
        $this->assertEquals($count, $result['inactive']);
    }
}
