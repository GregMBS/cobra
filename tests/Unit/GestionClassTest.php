<?php

namespace Tests\Unit;

use App\GestionClass;
use App\Historia;
use App\Pago;
use App\Resumen;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class GestionClassTest extends TestCase
{
    /**
     * @var array
     */
    private $testEmpty = [
        'C_OBSE1' => '',
        'C_CARG' => '',
        'D_FECH' => '',
        'C_HRIN' => '',
        'N_PROM' => 0,
        'N_PROM1' => 0,
        'N_PROM2' => 0,
        'N_PROM3' => 0,
        'N_PROM4' => 0,
        'C_PROM' => '',
        'D_PROM' => '',
        'D_PROM1' => '',
        'D_PROM2' => '',
        'D_PROM3' => '',
        'D_PROM4' => '',
        'N_PAGO' => 0,
        'D_PAGO' => '',
        'C_VISIT' => '',
        'C_CVST' => '',
        'C_CNP' => '',
        'C_EMAIL' => '',
        'C_MOTIV' => '',
        'C_NDIR' => '',
        'C_NTEL' => '',
        'C_OBSE2' => '',
        'CUANDO' => '',
        'AUTH' => ''
    ];

    public function testAddNewTel()
    {
        $gc = new GestionClass();
        $cuenta = Resumen::where('status_de_credito', 'REGEXP', '-')->first();
        $id_cuenta = $cuenta->id_cuenta;
        $newTel = '8888888888';
        $result = $gc->addNewTel($id_cuenta, $newTel);
        $this->assertEquals($newTel, $result['tel_1_verif']);
    }

    /**
     * @param array $gestion
     */
    private function doGestionTest(array $gestion)
    {
        $gc = new GestionClass();
        /** @var Builder $query */
        $query = Resumen::whereIdCuenta($gestion['C_CONT']);
        $cuenta = $query->first();
        $contan = $cuenta->status_aarsa;
        $cliente = $cuenta->cliente;
        $numero_de_cuenta = $cuenta->numero_de_cuenta;
        $gestor = $cuenta->ejecutivo_asignado_call_center;
        $result = $gc->doGestion($gestion);
        $this->assertTrue($result);
        unset($gestion['N_PAGO']);
        unset($gestion['D_PAGO']);
        $effect = Historia::where('C_CONT', '=', $gestion['C_CONT'])
            ->where('C_CVGE', '=', $gestion['C_CVGE'])
            ->where('C_TELE', '=', $gestion['C_TELE'])
            ->get()->first()->toArray();
        unset($effect['Auto']);
        $testFull = [
            'C_OBSE1' => $gestion['C_OBSE1'],
            'C_CARG' => '',
            'D_FECH' => date('Y-m-d'),
            'C_HRIN' => '00:00:00',
            'N_PROM' => '0.00',
            'N_PROM1' => '0.00',
            'N_PROM2' => '0.00',
            'N_PROM3' => '0.00',
            'N_PROM4' => '0.00',
            'C_PROM' => '',
            'D_PROM' => '0000-00-00',
            'D_PROM1' => '0000-00-00',
            'D_PROM2' => '0000-00-00',
            'D_PROM3' => '0000-00-00',
            'D_PROM4' => '0000-00-00',
            'C_VISIT' => null,
            'C_CVST' => $gestion['C_CVST'],
            'C_CNP' => '',
            'C_EMAIL' => '',
            'C_MOTIV' => '',
            'C_NDIR' => '',
            'C_NTEL' => '',
            'C_OBSE2' => '',
            'CUANDO' => '',
            'AUTH' => '',
            'C_CONT' => $gestion['C_CONT'],
            'C_CVGE' => $gestion['C_CVGE'],
            'C_TELE' => $gestion['C_TELE'],
            'C_ACCION' => $gestion['C_ACCION'],
            'C_CVBA' => $cliente,
            'C_HRFI' => date('H:i:s'),
            'C_MSGE' => null,
            'CUENTA' => $numero_de_cuenta,
            'C_CONTAN' => $contan,
            'C_NSE' => null,
            'C_ATTE' => '',
            'C_CNIV' => null,
            'C_CFAC' => null,
            'C_CPTA' => null,
            'C_RCON' => null,
            'CARGADO' => null,
            'C_CALLE1' => null,
            'C_CALLE2' => null,
            'C_FREQ' => null,
            'C_CTIPO' => null,
            'C_COWN' => null,
            'C_CSTAT' => null,
            'C_CREJ' => null,
            'C_CPAT' => null,
            'C_CAMP' => '0',
            'C_EJE' => $gestor,
            'error' => 0
        ];
        Historia::where('C_CONT', '=', $gestion['C_CONT'])
            ->where('C_CVGE', '=', $gestion['C_CVGE'])
            ->where('D_FECH', '=', date('Y-m-d'))
            ->delete();
        $testFull['C_HRFI'] = $effect['C_HRFI'];
        $this->assertEquals($testFull, $effect);
    }

    public function testTelNoContesta()
    {
        $gestion = $this->testEmpty;
        $cuenta = Resumen::where('status_de_credito', 'REGEXP', '-')->first();
        $gestion['C_CONT'] = $cuenta->id_cuenta;
        $gestion['C_CVST'] = 'TEL NO CONTESTA';
        $gestion['C_CVGE'] = 'gregb';
        $gestion['C_TELE'] = '8888888888';
        $gestion['C_ACCION'] = 'LLAMADA A DOMICILIO';
        $gestion['C_OBSE1'] = 'something something something';
        $this->doGestionTest($gestion);
    }

    public function testPago()
    {
        $gestion = $this->testEmpty;
        $cuenta = Resumen::where('status_de_credito', 'REGEXP', '-')->first();
        $gestion['C_CONT'] = $cuenta->id_cuenta;
        $gestion['C_CVST'] = 'PAGO PARCIAL';
        $gestion['C_CVGE'] = 'gregb';
        $gestion['C_TELE'] = '8888888888';
        $gestion['C_ACCION'] = 'LLAMADA A DOMICILIO';
        $gestion['C_OBSE1'] = 'something something something';
        $gestion['N_PAGO'] = 1;
        $gestion['D_PAGO'] = '2008-01-01';
        $this->doGestionTest($gestion);
        /** @var Builder $query */
        $query = Pago::whereMonto($gestion['N_PAGO'])->whereFecha($gestion['D_PAGO'])->whereIdCuenta($gestion['C_CONT']);
        $count = $query->count();
        $this->assertEquals(1, $count);
        $query->delete();
    }
}
