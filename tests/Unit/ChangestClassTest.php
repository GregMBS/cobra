<?php

namespace Tests\Unit;

use App\ChangeStatusClass;
use App\Debtor;
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
        $cc = new ChangeStatusClass();
        /** @var Builder $query */
        $query = Debtor::where('status_de_credito', 'REGEXP', '-');
        /** @var Debtor $cuenta */
        $cuenta = $query->first();
        if ($cuenta) {
            $id_cuenta = $cuenta->id_cuenta;
            $count = $cc->updateDebtor(false, $id_cuenta);
            $this->assertEquals(1, $count);
            $count = $cc->updateDebtor(true, $id_cuenta);
            $this->assertEquals(1, $count);
            $count = $cc->updateDebtor(false, $id_cuenta);
            $this->assertEquals(1, $count);
            $count = $cc->updateDebtor(true, $id_cuenta);
            $this->assertEquals(1, $count);
        }
        $this->assertTrue(true);
    }
}
