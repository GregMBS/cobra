<?php

namespace Tests\Unit;

use App\MigoClass;
use Tests\TestCase;

class MigoClassTest extends TestCase
{
    private $fieldsRequired = [
        'numero_de_cuenta',
        'nombre_deudor',
        'saldo_total',
        'status_de_credito',
        'cliente',
        'status_aarsa',
        'saldo_descuento_2',
        'id_cuenta',
        'fecha_ultima_gestion'
    ];

    protected function assertArrayContainsKeys($needle, $haystack)
    {
        $keys = array_keys($haystack);
        foreach ($needle as $val) {
            $this->assertContains($val, $keys);
        }
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminReport()
    {
        $mc = new MigoClass();
        $result = $mc->adminReport();
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $this->assertArrayContainsKeys($this->fieldsRequired, $first);
    }

    public function testUserReport()
    {
        $mc = new MigoClass();
        $result = $mc->userReport('MIGUEL');
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $this->assertArrayContainsKeys($this->fieldsRequired, $first);
    }
}
