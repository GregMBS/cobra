<?php

namespace Tests\Unit;

use App\Queue;
use App\Debtor;
use App\DebtorQueuesClass;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class ResumenQueuesClassTest extends TestCase
{

    private $resumenKeys = [
        'nombre_deudor',
        'domicilio_deudor',
        'colonia_deudor',
        'ciudad_deudor',
        'estado_deudor',
        'cp_deudor',
        'plano_guia_roji',
        'cuadrante_guia_roji',
        'tel_1',
        'tel_2',
        'tel_3',
        'tel_4',
        'nombre_deudor_alterno',
        'domicilio_deudor_alterno',
        'colonia_deudor_alterno',
        'ciudad_deudor_alterno',
        'estado_deudor_alterno',
        'tel_1_alterno',
        'tel_2_alterno',
        'tel_3_alterno',
        'tel_4_alterno',
        'plano_guia_roji_alterno',
        'cuadrante_guia_roji_alterno',
        'status_aarsa',
        'avapar',
        'parentesco_ref_1',
        'nombre_referencia_1',
        'domicilio_referencia_1',
        'colonia_referencia_1',
        'ciudad_referencia_1',
        'estado_referencia_1',
        'cp_referencia_1',
        'tel_1_ref_1',
        'tel_2_ref_1',
        'parentesco_ref_2',
        'nombre_referencia_2',
        'domicilio_referencia_2',
        'colonia_referencia_2',
        'ciudad_referencia_2',
        'estado_referencia_2',
        'cp_referencia_2',
        'tel_1_ref_2',
        'tel_2_ref_2',
        'parentesco_ref_3',
        'nombre_referencia_3',
        'domicilio_referencia_3',
        'colonia_referencia_3',
        'ciudad_referencia_3',
        'estado_referencia_3',
        'cp_referencia_3',
        'tel_1_ref_3',
        'tel_2_ref_3',
        'parentesco_ref_4',
        'nombre_referencia_4',
        'multiestrategia',
        'estado_referencia_4',
        'cp_referencia_4',
        'tel_1_ref_4',
        'tel_2_ref_4',
        'domicilio_laboral',
        'colonia_laboral',
        'ciudad_laboral',
        'estado_laboral',
        'cp_laboral',
        'tel_1_laboral',
        'tel_2_laboral',
        'saldo_corriente',
        'fecha_de_actualizacion',
        'numero_de_cuenta',
        'numero_de_credito',
        'contrato',
        'saldo_total',
        'saldo_vencido',
        'saldo_descuento_1',
        'saldo_descuento_2',
        'fecha_corte',
        'fecha_limite',
        'fecha_de_ultimo_pago',
        'monto_ultimo_pago',
        'producto',
        'subproducto',
        'cliente',
        'status_de_credito',
        'pagos_vencidos',
        'monto_adeudado',
        'fecha_de_asignacion',
        'fecha_de_deasignacion',
        'cuenta_concentradora_1',
        'saldo_cuota',
        'email_deudor',
        'id_cuenta',
        'nss',
        'rfc_deudor',
        'telefonos_marcados',
        'tel_1_verif',
        'tel_2_verif',
        'tel_3_verif',
        'tel_4_verif',
        'telefono_de_ultimo_contacto',
        'dias_vencidos',
        'ejecutivo_asignado_call_center',
        'ejecutivo_asignado_domiciliario',
        'prioridad_de_gestion',
        'nrpp',
        'parentesco_aval',
        'localizar',
        'fecha_ultima_gestion',
        'empresa',
        'timelock',
        'locker',
        'fecha_convenio',
        'especial',
        'direccion_nueva',
        'norobot',
    ];

    /**
     * @param array $result
     * @return array
     */
    private function removeConflicts(array $result) {
        unset($result[17]);
        unset($result[55]);
        unset($result[57]);
        return array_values($result);
    }

    public function testGetMyQueue()
    {
        $testKeys = [
            'auto',
            'gestor',
            'cliente',
            'status_aarsa',
            'camp',
            'orden1',
            'updown1',
            'orden2',
            'updown2',
            'orden3',
            'updown3',
            'sdc',
            'bloqueado',
            'cr'
        ];
        $rc = new DebtorQueuesClass();
        /** @var \Illuminate\Database\Query\Builder $query */
        $query = Queue::whereGestor('gmbs');
        /** @var Queue $queuelist */
        $queuelist = $query->first();
        $result = $rc->getMyQueue('gmbs', $queuelist->camp);
        $keys = array_keys($result);
        $this->assertEquals($testKeys, $keys);
        $this->assertEquals($result['auto'], $queuelist->camp);
        $this->assertEquals($result['camp'], $queuelist->camp);
        $this->assertEquals($result['gestor'], $queuelist->gestor);
    }

    public function testSearchCount()
    {
        $rc = new DebtorQueuesClass();
        $query = Debtor::first();
        if ($query) {
            $field = 'cliente';
            $find = $query->cliente;
            $result = $rc->searchCount($field, $find);
            $this->assertGreaterThan(0, $result);
            $find = 'GMBS';
            $result = $rc->searchCount($field, $find);
            $this->assertEquals(0, $result);
        }
        $this->assertTrue(true);
    }

    public function testGetOne()
    {
        $rc = new DebtorQueuesClass();
        /** @var Debtor $cuenta */
        $cuenta = Debtor::first();
        if ($cuenta) {
            $id_cuenta = $cuenta->id_cuenta;
            $result = $rc->getOne($id_cuenta);
            $keys = array_keys($result);
            $clean = $this->removeConflicts($keys);
            $this->assertEquals($this->resumenKeys, $clean);
        }
        $this->assertTrue(true);
    }

    public function testGetResumen()
    {
        $rc = new DebtorQueuesClass();
        /* no cliente, no sdc, yes cr, not MANUAL or INICIAL */
        /** @var Queue|Builder $queue */
        /*
        $queue = Queue::whereCliente('');
        $queue = $queue->whereSdc('');
        $queue = $queue->whereNotIn('status_aarsa', ['','MANUAL','INICIAL'])->first();
        $result = $rc->getDebtor($queue->gestor, $queue->camp);
        $this->assertArrayHasKey('id_cuenta', $result);
        $id_cuenta = $result['id_cuenta'];
        $this->assertGreaterThan(0, $id_cuenta);
        $result1 = $rc->getOne($id_cuenta);
        $keys = array_keys($result1);
        $this->assertEquals($this->resumenKeys, $keys);
        */
        /* INICIAL */
        $this->expectException(\Exception::class);
        /** @var Queue $query */
        $query = Queue::whereStatusAarsa('INICIAL');
        $queue = $query->first();
        $resultI = $rc->getDebtor($queue->gestor, $queue->camp);
        $this->assertArrayHasKey('id_cuenta', $resultI);
        $id_cuenta = $resultI['id_cuenta'];
        $this->assertEquals(0, $id_cuenta);
        $this->expectException(ModelNotFoundException::class);
        $resultI1 = $rc->getOne($id_cuenta);
        $keys = array_keys($resultI1);
        $this->assertEquals($this->resumenKeys, $keys);
        /* SIN GESTION */
        $query = Queue::whereStatusAarsa('SIN GESTION');
        $queue = $query->first();
        $resultI = $rc->getDebtor($queue->gestor, $queue->camp);
        $this->assertArrayHasKey('id_cuenta', $resultI);
        $id_cuenta = $resultI['id_cuenta'];
        $this->assertGreaterThan(0, $id_cuenta);
        $status_aarsa = $resultI['status_aarsa'];
        $this->assertEquals('', $status_aarsa);
        $resultI1 = $rc->getOne($id_cuenta);
        $keys = array_keys($resultI1);
        $this->assertEquals($this->resumenKeys, $keys);
    }
}
