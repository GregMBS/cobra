<?php

namespace Tests\Unit;

use App\Client;
use App\Status;
use App\History;
use App\Payment;
use App\Debtor;
use App\DebtorClass;
use Illuminate\Database\Query\Builder;
use Tests\TestCase;


class DebtorClassTest extends TestCase
{
    /**
     * @var array
     */
    private $debtorStatuses = array(
        'PROMESA DE PAGO TOTAL',
        'PROMESA DE PAGO PARCIAL',
        'CLIENTE NEGOCIANDO',
        'PAGO MENSUAL',
        'ADJUDICACION',
        'AUDIENCIA DE PRUEBAS',
        'DACION ENTREGADA A INFONAVIT',
        'DEMANDA ADMITIDA',
        'ELABORACION DE DEMANDA',
        'EMPLAZAMIENTO EFECTIVO',
        'FIRMO PN PARA ENTREGA',
        'INICIO DE EJECUCION',
        'PROMESA DE DACION EN PAGO',
        'PROMESA DE EVPN',
        'SENTENCIA',
        'NO OFRECER SOLUCION',
        'DACION EN PAGO',
        'FIRMO CONVENIO JUDICIAL',
        'FIRMO CONVENIO',
        'CUENTA DEMANDADA'
    );

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHighlight()
    {
        $rc = new DebtorClass();
        $statuses = Status::all('dictamen');
        $visit = '';
        foreach ($statuses as $status) {
            $stat = $status->dictamen;
            $result = $rc->highlight($stat, $visit);
            if (in_array($stat, $this->debtorStatuses)) {
                $this->assertStringStartsWith(" class='deudor'", $result);
            } elseif ($stat == 'VALIDACION') {
                $this->assertStringStartsWith(" class='validacion'", $result);
            } else {
                $this->assertEquals('', $result);
            }
        }
        $visit = 'visitador';
        foreach ($statuses as $status) {
            $stat = $status->dictamen;
            $result = $rc->highlight($stat, $visit);
            $this->assertStringStartsWith(" class='visit'", $result);
        }
    }

    public function testLastCall()
    {
        $rc = new DebtorClass();
        /** @var Builder $history */
        $history = new History();
        $query = $history->where('c_cont', '>', 0)->first();
        if ($query) {
            $capt = $query->C_CVGE;
            $id = $rc->lastCall($capt);
            $this->assertGreaterThan(0, $id);
        }
        $id = $rc->lastCall('');
        $this->assertEquals(0, $id);
    }

    /**
     * @throws \Exception
     */
    public function testGetStatus()
    {
        $rc = new DebtorClass();
        $statuses = $rc->getStatus('callcenter');
        $this->assertContains('TEL OCUPADA', $statuses);
        $this->assertNotContains('NOTIFICACION BAJO PUERTA', $statuses);
        $this->assertNotContains('PROMESA INCUMPLIDA', $statuses);
        $statuses = $rc->getStatus('admin');
        $this->assertContains('TEL OCUPADA', $statuses);
        $this->assertContains('NOTIFICACION BAJO PUERTA', $statuses);
        $this->assertContains('PROMESA INCUMPLIDA', $statuses);
        $statuses = $rc->getStatus('visitador');
        $this->assertNotContains('TEL OCUPADA', $statuses);
        $this->assertContains('NOTIFICACION BAJO PUERTA', $statuses);
        $this->assertNotContains('PROMESA INCUMPLIDA', $statuses);
        $this->expectExceptionMessage("Tipo de usuario no es correcto.");
        $rc->getStatus('');
    }

    public function testGetDictV()
    {
        $rc = new DebtorClass();
        try {
            $statuses = $rc->getStatusVisit();
            $this->assertNotContains('TEL OCUPADA', $statuses);
            $this->assertContains('NOTIFICACION BAJO PUERTA', $statuses);
            $this->assertNotContains('PROMESA INCUMPLIDA', $statuses);
        } catch (\Exception $e) {
            $this->assertEquals('', $e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    public function testGetMotiv()
    {
        $rc = new DebtorClass();
        $statuses = $rc->getMotivation();
        $this->assertContains('PAGO POR CALL CENTER', $statuses);
    }

    public function testGetMotivV()
    {
        $rc = new DebtorClass();
        $statuses = $rc->getMotivationVisit();
        $this->assertContains('PAGO POR CALL CENTER', $statuses);
    }

    /**
     * @throws \Exception
     */
    public function testCnp()
    {
        $rc = new DebtorClass();
        $statuses = $rc->getExcuse();
        $this->assertContains('Obligado Solidario', $statuses);
    }

    /**
     * @throws \Exception
     */
    public function testGetAction()
    {
        $rc = new DebtorClass();
        $statuses = $rc->getAction();
        $this->assertContains('CLIENTE NOS LLAMO', $statuses);
        $this->assertNotContains('SE MANDO ROBOT', $statuses);
        $this->assertNotContains('VISITA A DOMICILIO', $statuses);
    }

    public function testGetActionVisit()
    {
        $rc = new DebtorClass();
        $statuses = $rc->getActionVisit();
        $this->assertNotContains('CLIENTE NOS LLAMO', $statuses);
        $this->assertNotContains('SE MANDO ROBOT', $statuses);
        $this->assertContains('VISITA A DOMICILIO', $statuses);
    }

    public function testGetBadTel()
    {
        $testKeys = [
            0 => "tel_1",
            1 => "tel_2",
            2 => "tel_3",
            3 => "tel_4",
            4 => "tel_1_alterno",
            5 => "tel_2_alterno",
            6 => "tel_3_alterno",
            7 => "tel_4_alterno",
            8 => "tel_1_laboral",
            9 => "tel_2_laboral",
            10 => "tel_1_verif",
            11 => "tel_2_verif",
            12 => "tel_3_verif",
            13 => "tel_4_verif"
        ];
        $testResult = array_fill_keys($testKeys, "");
        $rc = new DebtorClass();
        $id = 1;
        $result = $rc->getBadTel($id);
        if ($result) {
            $keys = array_keys($result);
            $this->assertEquals($testKeys, $keys);
            $this->assertEquals($testResult, $result);
        }
        $this->assertTrue(true);
    }

    public function testGetHistory()
    {
        $testKeys = [
            'c_cvst',
            'fecha',
            'c_cvge',
            'c_tele',
            'short',
            'c_obse1',
            'auto',
            'c_cniv'
        ];
        $rc = new DebtorClass();
        $id = 1;
        $result = $rc->getHistory($id);
        if ($result) {
            $keys = array_keys($result[0]);
            $this->assertEquals($testKeys, $keys);
            $this->assertGreaterThan(0, count($result));
        }
        $this->assertTrue(true);
    }

    public function testGetGestorList()
    {
        $rc = new DebtorClass();
        $result = $rc->getAgentList();
        $this->assertContains('gmbs', $result);
    }

    public function testGetVisitadorList()
    {
        $rc = new DebtorClass();
        $result = $rc->getVisitorList();
        $id = array_search('gmbs', array_column($result, 'iniciales'));
        $this->assertGreaterThanOrEqual(0, $id);
        $this->assertEquals('gregory miles blumenthal scharf', $result[$id]['completo']);
    }

    public function testGetClientList()
    {
        $query = Client::first();
        if ($query) {
            $cliente = $query->cliente;
            $rc = new DebtorClass();
            $result = $rc->getClientList();
            $this->assertContains($cliente, $result);
        }
        $this->assertTrue(true);
    }

    public function testNumGests()
    {
        $rc = new DebtorClass();
        $gestor = 'gmbs';
        $numGests = $rc->countCallsByAgent($gestor);
        $this->assertEquals(0, $numGests);
    }

    public function testGetUserData()
    {
        $testKeys = [
            0 => "USUARIA",
            1 => "INICIALES",
            2 => "COMPLETO",
            3 => "TIPO",
            4 => "TICKET",
            5 => "camp",
            6 => "turno",
            7 => "authcode",
            8 => "passw",
            9 => "policy",
            10 => "id"
        ];
        $rc = new DebtorClass();
        $gestor = 'gmbs';
        $data = $rc->getUserData($gestor);
        $keys = array_keys($data);
        $this->assertEquals($testKeys, $keys);
        $tipo = $data['TIPO'];
        $this->assertEquals('admin', $tipo);
        $completo = $data['COMPLETO'];
        $this->assertEquals('gregory miles blumenthal scharf', $completo);
    }

    public function testCountGestiones()
    {
        $date = date('Y-m-d', strtotime('first day of last month'));
        /** @var Builder $query */
        $query = History::where('c_cont', '>', 0)->where('d_fech', '>', $date);
        $gestiones = $query->get();
        $first = $gestiones->first();
        if ($first) {
            $id = $first->C_CONT;
            $rc = new DebtorClass();
            $count = $rc->countCallsByAccount($id);
            $this->assertGreaterThan(0, $count);
        }
        $this->assertTrue(true);
    }

    public function testCountPromesas()
    {
        $query = History::where('c_cont', '>', 0)->where('n_prom', '>', 0)->first();
        if ($query) {
            $id = $query->C_CONT;
            $rc = new DebtorClass();
            $count = $rc->countPromisesByAccount($id);
            $this->assertGreaterThan(0, $count);
        }
        $this->assertTrue(true);
    }

    public function testCountPagos()
    {
        $rc = new DebtorClass();
        /** @var Payment $pago */
        $pago = Payment::first();
        if ($pago) {
            $id = $pago->id_cuenta;
            $count = $rc->countPaymentsByAccount($id);
            $this->assertGreaterThan(0, $count);
        }
        $this->assertTrue(true);
    }

    public function testGetCuentaFromId()
    {
        $rc = new DebtorClass();
        $id = 0;
        $cuenta = $rc->getAccountNumberFromId($id);
        $this->assertEquals('', $cuenta);
        $query = Debtor::where('id_cuenta', '>', 0)->first();
        if ($query) {
            $id = $query->id_cuenta;
            $cuenta = $rc->getAccountNumberFromId($id);
            $this->assertNotEquals('', $cuenta);
        }
    }

    public function testGetPromData()
    {
        $testPromise = [
            "N_PROM_OLD" => "0",
            "N_PROM1_OLD" => "0",
            "N_PROM2_OLD" => "0.00",
            "N_PROM3_OLD" => null,
            "N_PROM4_OLD" => null,
            "D_PROM_OLD" => "0000-00-00",
            "D_PROM1_OLD" => "0000-00-00",
            "D_PROM2_OLD" => "0000-00-00",
            "D_PROM3_OLD" => null,
            "D_PROM4_OLD" => null
        ];
        $rc = new DebtorClass();
        $query = History::where('n_prom', '>', 0)->first();
        if ($query) {
            $id = $query->C_CONT;
            $promises = $rc->getPromiseData($id);
            $fields = [
                "N_PROM_OLD",
                "N_PROM1_OLD",
                "D_PROM_OLD",
                "D_PROM1_OLD"
            ];
            foreach ($fields as $field) {
                $this->assertGreaterThan($testPromise[$field], $promises[$field]);
            }
        }
        $this->assertTrue(true);
    }

    public function testGetTimelock()
    {
        $now = date('r');
        $rc = new DebtorClass();
        $query = Debtor::whereNull('locker')->first();
        if ($query) {
            $timeLock = $rc->getTimelock($query->id_cuenta);
            $this->assertEquals($now, $timeLock, '', 2);
        }
        $query = Debtor::where('locker', '<>', '')->first();
        if ($query) {
            $timeLock = $rc->getTimelock($query->id_cuenta);
            $this->assertLessThan(strtotime($now), strtotime($timeLock));
        } else {
            $this->assertTrue(true);
        }
    }

    public function testListVisits()
    {
        $testKeys = [
            'c_cvst',
            'fh',
            'gestor',
            'short',
            'c_obse1',
            'auto'
        ];
        $rc = new DebtorClass();
        /** @var Builder $query */
        $query = History::where('c_cniv', '<>', '')->take(10);
        $tenVisits = $query->get();
        /** @var History $first */
        $first = $tenVisits->first();
        if ($first) {
            $id = $first->C_CONT;
            $visits = $rc->listVisits($id);
            $this->assertGreaterThan(0, count($visits));
            $this->checkKeys($testKeys, $visits);
        }
        $this->assertTrue(true);
    }
}
