<?php

namespace Tests\Unit;

use App\AccountsClass;
use App\Debtor;
use Illuminate\Database\Eloquent\Builder;
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
        $mc = new AccountsClass();
        $count = Debtor::count();
        if ($count > 0) {
            $result = $mc->adminReport();
            $this->assertGreaterThan(0, count($result));
            $first = $result[0];
            $this->assertArrayContainsKeys($this->fieldsRequired, $first);
        }
        $this->assertTrue(true);
    }

    public function testUserReport()
    {
        $mc = new AccountsClass();
        /** @var Builder $query */
        $query = Debtor::where('status_de_credito', 'NOT REGEXP', '-')->where('ejecutivo_asignado_call_center', '<>', '');
        /** @var Debtor $cuenta */
        $cuenta = $query->first();
        if ($cuenta) {
            $result = $mc->userReport($cuenta->ejecutivo_asignado_call_center);
            $this->assertGreaterThan(0, count($result));
            $first = $result[0];
            $this->assertArrayContainsKeys($this->fieldsRequired, $first);
        }
        $this->assertTrue(true);
    }
}
