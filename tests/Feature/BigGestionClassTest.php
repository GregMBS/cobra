<?php

namespace Tests\Feature;

use App\BigDataClass;
use App\BigGestionClass;
use Illuminate\Http\Request;
use Tests\TestCase;

class BigGestionClassTest extends TestCase
{
    private $keys = [
        'numero_de_cuenta',
        'nombre_deudor',
        'cliente',
        'status_de_credito',
        'saldo_total',
        'queue',
        'Auto',
        'C_CVGE',
        'C_CVBA',
        'C_CONT',
        'C_CVST',
        'D_FECH',
        'C_HRIN',
        'C_HRFI',
        'C_TELE',
        'C_MSGE',
        'CUENTA',
        'C_OBSE1',
        'C_OBSE2',
        'C_CONTAN',
        'C_NSE',
        'C_VISIT',
        'C_ATTE',
        'C_CNIV',
        'C_CARG',
        'C_CFAC',
        'C_CPTA',
        'C_RCON',
        'AUTH',
        'CARGADO',
        'CUANDO',
        'D_PROM',
        'C_PROM',
        'N_PROM',
        'C_CALLE1',
        'C_CALLE2',
        'C_CNP',
        'C_EMAIL',
        'C_NTEL',
        'C_NDIR',
        'C_FREQ',
        'C_CTIPO',
        'C_COWN',
        'C_CSTAT',
        'C_CREJ',
        'C_CPAT',
        'C_ACCION',
        'C_MOTIV',
        'C_CAMP',
        'D_PROM1',
        'N_PROM1',
        'D_PROM2',
        'N_PROM2',
        'C_EJE',
        'error',
        'D_PROM3',
        'N_PROM3',
        'D_PROM4',
        'N_PROM4'
    ];	

    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAllGestiones()
    {
        $r = new Request();
        $dataClass = new BigDataClass($r);
        $dataClass->gestor = 'aaron';
        $dataClass->cliente = 'CARTERA';
        $bc = new BigGestionClass();
        $report = $bc->getAllGestiones($dataClass);
        $first = $report[0];
        $keys = array_keys($first);
        $this->assertEquals(count($this->keys), count($keys));
        $this->assertEquals($this->keys, $keys);
    }

    public function testGetGestionClientes()
    {
        $bc = new BigGestionClass();
        $clientes = $bc->getGestionClientes();
        $this->assertInternalType('array', $clientes);
        $this->assertNotEmpty($clientes);
    }

    public function testGetGestionGestores()
    {
        $bc = new BigGestionClass();
        $gestores = $bc->getGestionGestores();
        $this->assertInternalType('array', $gestores);
        $this->assertNotEmpty($gestores);
    }

    public function testGestionDates()
    {
        $bc = new BigGestionClass();
        $dirs = ['asc', 'ASC', 'desc', 'DESC', ''];
        foreach ($dirs as $dir) {
            $dates = $bc->getGestionDates($dir);
            $this->assertInternalType('array', $dates);
            $this->assertNotEmpty($dates);
        }
    }
}
