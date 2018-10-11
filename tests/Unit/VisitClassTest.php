<?php

namespace Tests\Unit;

use App\GestionClass;
use App\Historia;
use App\Resumen;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class VisitClassTest extends TestCase
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

    /**
     * @param array $gestion
     */
    private function doVisitTest(array $gestion)
    {
        $gc = new GestionClass();
        /** @var Builder $query */
        $query = Resumen::whereIdCuenta($gestion['C_CONT']);
        $cuenta = $query->first();
        $contan = $cuenta->status_aarsa;
        $cliente = $cuenta->cliente;
        $numero_de_cuenta = $cuenta->numero_de_cuenta;
        $gestor = $cuenta->ejecutivo_asignado_call_center;
        $result = $gc->doVisit($gestion);
        $this->assertTrue($result);
        unset($gestion['N_PAGO']);
        unset($gestion['D_PAGO']);
        $effect = Historia::where('C_CONT', '=', $gestion['C_CONT'])
            ->where('C_CVGE', '=', $gestion['C_CVGE'])
            ->where('C_VISIT', '=', $gestion['C_VISIT'])
            ->get()->first()->toArray();
        unset($effect['Auto']);
        unset($effect['C_HRFI']);
        if ($effect['N_PROM3'] == 0) {
            $effect['N_PROM3'] = null;
            $effect['D_PROM3'] = null;
        }
        if ($effect['N_PROM4'] == 0) {
            $effect['N_PROM4'] = null;
            $effect['D_PROM4'] = null;
        }
        $testFull = [
            'C_OBSE1' => $gestion['C_OBSE1'],
            'C_CARG' => '',
            'D_FECH' => $gestion['D_FECH'],
            'C_HRIN' => '00:00:00',
            'N_PROM' => '0.00',
            'N_PROM1' => null,
            'N_PROM2' => null,
            'N_PROM3' => null,
            'N_PROM4' => null,
            'C_PROM' => '',
            'D_PROM' => '0000-00-00',
            'D_PROM1' => null,
            'D_PROM2' => null,
            'D_PROM3' => null,
            'D_PROM4' => null,
            'C_VISIT' => $gestion['C_VISIT'],
            'C_CVST' => $gestion['C_CVST'],
            'C_CNP' => null,
            'C_EMAIL' => '',
            'C_MOTIV' => '',
            'C_NDIR' => '',
            'C_NTEL' => '',
            'C_OBSE2' => '',
            'CUANDO' => null,
            'AUTH' => null,
            'C_CONT' => $gestion['C_CONT'],
            'C_CVGE' => $gestion['C_CVGE'],
            'C_ACCION' => $gestion['C_ACCION'],
            'C_CVBA' => $cliente,
            'C_MSGE' => null,
            'CUENTA' => $numero_de_cuenta,
            'C_CONTAN' => $contan,
            'C_NSE' => '',
            'C_ATTE' => '',
            'C_CNIV' => '',
            'C_CFAC' => '',
            'C_CPTA' => '',
            'C_RCON' => '',
            'CARGADO' => null,
            'C_CALLE1' => '',
            'C_CALLE2' => '',
            'C_FREQ' => '',
            'C_CTIPO' => null,
            'C_COWN' => null,
            'C_CSTAT' => null,
            'C_CREJ' => '',
            'C_CPAT' => '',
            'C_CAMP' => '0',
            'C_EJE' => $gestor,
            'error' => 0,
            'C_TELE' => null
        ];
        Historia::where('C_CONT', '=', $gestion['C_CONT'])
            ->where('C_VISIT', '=', $gestion['C_VISIT'])
            ->where('D_FECH', '=', $gestion['D_FECH'])
            ->delete();
        $this->assertEquals($testFull, $effect);
    }

    public function testNotificationBajoPuerta()
    {
        $gestion = $this->testEmpty;
        $cuenta = Resumen::where('status_de_credito', 'REGEXP', '-')->first();
        if ($cuenta) {
            $gestion['C_CONT'] = $cuenta->id_cuenta;
            $gestion['C_CVST'] = 'NOTIFICACION BAJO PUERTA';
            $gestion['C_CVGE'] = 'gregb';
            $gestion['C_VISIT'] = 'gregb';
            $gestion['D_FECH'] = date('Y-m-d', strtotime('yesterday'));
            $gestion['C_ACCION'] = 'VISITA A DOMICILIO';
            $gestion['C_OBSE1'] = 'something something something';
            $this->doVisitTest($gestion);
        }
        $this->assertTrue(true);
    }

}
