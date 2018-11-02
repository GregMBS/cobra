<?php

namespace Tests\Unit;

use App\AgentActivityClass;
use App\Historia;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class DhClassTest extends TestCase
{
    /** @var string */
    private $gestor = '';

    /** @var string */
    private $fecha = '0000-00-00';

    public function setUp()
    {
        parent::setUp();
        $date = date('Y-m-d', strtotime('last day of last month'));
        /** @var Builder $query */
        $query = Historia::where('N_PROM', '>', 0)->where('d_fech', '>', $date);
        /** @var Historia $gestion */
        $gestion = $query->first();
        if ($gestion) {
            $this->gestor = $gestion->C_CVGE;
            $this->fecha = $gestion->D_FECH;
        }
    }

    public function testGetPromesas()
    {
        $testKeys = [
            'numero_de_cuenta',
            'nombre_deudor',
            'status_de_credito',
            'ejecutivo_asignado_call_center',
            'status_aarsa',
            'saldo_descuento_2',
            'cliente',
            'id_cuenta',
            'monto_promesa',
            'fecha_promesa'
        ];

        $dc = new AgentActivityClass();
        $result = $dc->getPromises($this->gestor, $this->fecha);
        $this->checkKeys($testKeys, $result);
    }

    public function testGetGestiones()
    {
        $testKeys = [
            'numero_de_cuenta',
            'nombre_deudor',
            'status_de_credito',
            'ejecutivo_asignado_call_center',
            'status_aarsa',
            'saldo_descuento_2',
            'cliente',
            'id_cuenta',
            'd_fech',
            'c_hrin',
            'c_cvst',
            'c_contan'
        ];

        $dc = new AgentActivityClass();
        $result = $dc->getCalls($this->gestor, $this->fecha);
        $this->checkKeys($testKeys, $result);
    }

    public function testGetDhMain()
    {
        $testKeys = [
            'numero_de_cuenta',
            'nombre_deudor',
            'saldo_total',
            'status_de_credito',
            'status_aarsa',
            'ejecutivo_asignado_call_center',
            'dias_vencidos',
            'c_cvst',
            'c_hrin',
            'saldo_descuento_2',
            'producto',
            'estado_deudor',
            'ciudad_deudor',
            'cliente',
            'id_cuenta',
            'n_prom',
            'd_prom',
            'vcc'
        ];

        $dc = new AgentActivityClass();
        $result = $dc->getReport($this->gestor, $this->fecha);
        $this->checkKeys($testKeys, $result);
    }
}
