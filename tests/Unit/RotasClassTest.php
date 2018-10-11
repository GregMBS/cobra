<?php

namespace Tests\Unit;

use App\RotasClass;
use Tests\TestCase;

class RotasClassTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetRotas()
    {
        $testKeys = [
            'cliente',
            'numero_de_cuenta',
            'nombre_deudor',
            'saldo_total',
            'status_de_credito',
            'status_aarsa',
            'id_cuenta',
            'c_cvge',
            'n_prom1',
            'd_prom1',
            'n_prom2',
            'd_prom2',
            'semaforo',
            'd_fech',
            'n_prom3',
            'd_prom3',
            'n_prom4',
            'd_prom4',
            'sum_monto'
        ];
        $rc = new RotasClass();
        $result = $rc->getRotas('admin', 'gmbs');
        if ($result) {
            $this->checkKeys($testKeys, $result);
        } else {
            $this->assertEquals(array(), $result);
        }
        $result = $rc->getRotas('', 'gmbs');
        $this->assertEquals(array(), $result);
    }
}
