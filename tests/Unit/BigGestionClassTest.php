<?php

namespace Tests\Unit;

use App\BigDataClass;
use App\BigCallClass;
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
        $r->query->add(
            [
                'fecha1' => '2018-12-12',
                'fecha2' => '2018-01-01'
            ]
        );
        $dataClass = new BigDataClass($r);
        $bc = new BigCallClass();
        $report = $bc->getAllCalls($dataClass);
        if (count($report) > 0) {
            $this->checkKeys($this->keys, $report);
        }
        $r->query->add(
            [
                'gestor' => 'miguel',
                'cliente' => 'GCYC',
                'tipo' => 'telef',
                'fecha1' => '2018-12-12',
                'fecha2' => '2008-12-12'
            ]
        );
        $dataClass = new BigDataClass($r);
        $bc = new BigCallClass();
        $report = $bc->getAllCalls($dataClass);
        if (count($report) > 0) {
            $first = $report[0];
            $keys = array_keys($first);
            $this->assertEquals(count($this->keys), count($keys));
            $this->assertEquals($this->keys, $keys);
        }
        $this->assertTrue(true);
    }

    public function testGetGestionClientes()
    {
        $bc = new BigCallClass();
        $clientes = $bc->getCallClients();
        $this->assertInternalType('array', $clientes);
        $this->assertNotEmpty($clientes);
    }

    public function testGetGestionGestores()
    {
        $bc = new BigCallClass();
        $gestores = $bc->getCallAgents();
        $this->assertInternalType('array', $gestores);
        $this->assertNotEmpty($gestores);
    }

    public function testGestionDates()
    {
        $bc = new BigCallClass();
        $dirs = ['asc', 'ASC', 'desc', 'DESC', ''];
        foreach ($dirs as $dir) {
            $dates = $bc->getCallDates($dir);
            $this->assertInternalType('array', $dates);
            $this->assertNotEmpty($dates);
        }
    }
}
