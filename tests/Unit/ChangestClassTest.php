<?php

namespace Tests\Unit;

use App\ChangestClass;
use App\Resumen;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;


class ChangestClassTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateResumen()
    {
        $cc = new ChangestClass();
        /** @var Builder $query */
        $query = Resumen::where('status_de_credito', 'REGEXP', '-');
        /** @var Resumen $cuenta */
        $cuenta = $query->first();
        if ($cuenta) {
            $id_cuenta = $cuenta->id_cuenta;
            $count = $cc->updateResumen(false, $id_cuenta);
            $this->assertEquals(1, $count);
            $count = $cc->updateResumen(true, $id_cuenta);
            $this->assertEquals(1, $count);
            $count = $cc->updateResumen(false, $id_cuenta);
            $this->assertEquals(1, $count);
            $count = $cc->updateResumen(true, $id_cuenta);
            $this->assertEquals(1, $count);
        }
        $this->assertTrue(true);
    }
}
