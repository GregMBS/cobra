<?php

namespace Tests\Unit;

use App\Cliente;
use App\Dictamen;
use App\Historia;
use App\Pago;
use App\Resumen;
use App\ResumenClass;
use Exception;
use Illuminate\Database\Query\Builder;
use Tests\TestCase;


class ResumenClassTest extends TestCase
{
    /**
     * @var array
     */
    private $deudorStatuses = array(
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
    public function testHighhist()
    {
        $rc = new ResumenClass();
        $dictamenes = Dictamen::all('dictamen');
        $visit = '';
        foreach ($dictamenes as $dictamen) {
            $stat = $dictamen->dictamen;
            $result = $rc->highhist($stat, $visit);
            if (in_array($stat, $this->deudorStatuses)) {
                $this->assertStringStartsWith(" class='deudor'", $result);
            } elseif ($stat == 'VALIDACION') {
                $this->assertStringStartsWith(" class='validacion'", $result);
            } else {
                $this->assertEquals('', $result);
            }
        }
        $visit = 'visitador';
        foreach ($dictamenes as $dictamen) {
            $stat = $dictamen->dictamen;
            $result = $rc->highhist($stat, $visit);
            $this->assertStringStartsWith(" class='visit'", $result);
        }
    }

    public function testLastGestion()
    {
        $rc = new ResumenClass();
        $query = Historia::where('c_cont', '>', 0)->first();
        if ($query) {
            $capt = $query->C_CVGE;
            $id_cuenta = $rc->lastGestion($capt);
            $this->assertGreaterThan(0, $id_cuenta);
        }
        $id_cuenta = $rc->lastGestion('');
        $this->assertEquals(0, $id_cuenta);
    }

    /**
     * @throws Exception
     */
    public function testGetDict()
    {
        $rc = new ResumenClass();
        $dictamenes = $rc->getDict('callcenter');
        $this->assertContains('TEL OCUPADA', $dictamenes);
        $this->assertNotContains('NOTIFICACION BAJO PUERTA', $dictamenes);
        $this->assertNotContains('PROMESA INCUMPLIDA', $dictamenes);
        $dictamenes = $rc->getDict('admin');
        $this->assertContains('TEL OCUPADA', $dictamenes);
        $this->assertContains('NOTIFICACION BAJO PUERTA', $dictamenes);
        $this->assertContains('PROMESA INCUMPLIDA', $dictamenes);
        $dictamenes = $rc->getDict('visitador');
        $this->assertNotContains('TEL OCUPADA', $dictamenes);
        $this->assertContains('NOTIFICACION BAJO PUERTA', $dictamenes);
        $this->assertNotContains('PROMESA INCUMPLIDA', $dictamenes);
        $this->expectExceptionMessage("Tipo de usuario no es correcto.");
        $rc->getDict('');
    }

    public function testGetDictV()
    {
        $rc = new ResumenClass();
        try {
            $dictamenes = $rc->getDictV();
            $this->assertNotContains('TEL OCUPADA', $dictamenes);
            $this->assertContains('NOTIFICACION BAJO PUERTA', $dictamenes);
            $this->assertNotContains('PROMESA INCUMPLIDA', $dictamenes);
        } catch (Exception $e) {
            $this->assertEquals('', $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function testGetMotiv()
    {
        $rc = new ResumenClass();
        $dictamenes = $rc->getMotiv();
        $this->assertContains('PAGO POR CALL CENTER', $dictamenes);
    }

    public function testGetMotivV()
    {
        $rc = new ResumenClass();
        $dictamenes = $rc->getMotivV();
        $this->assertContains('PAGO POR CALL CENTER', $dictamenes);
    }

    /**
     * @throws Exception
     */
    public function testCnp()
    {
        $rc = new ResumenClass();
        $dictamenes = $rc->getCnp();
        $this->assertContains('Obligado Solidario', $dictamenes);
    }

    /**
     * @throws Exception
     */
    public function testGetAccion()
    {
        $rc = new ResumenClass();
        $dictamenes = $rc->getAccion();
        $this->assertContains('CLIENTE NOS LLAMO', $dictamenes);
        $this->assertNotContains('SE MANDO ROBOT', $dictamenes);
        $this->assertNotContains('VISITA A DOMICILIO', $dictamenes);
    }

    public function testGetAccionV()
    {
        $rc = new ResumenClass();
        $dictamenes = $rc->getAccionV();
        $this->assertNotContains('CLIENTE NOS LLAMO', $dictamenes);
        $this->assertNotContains('SE MANDO ROBOT', $dictamenes);
        $this->assertContains('VISITA A DOMICILIO', $dictamenes);
    }

    public function testGetBadNo()
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
        $rc = new ResumenClass();
        $id_cuenta = 1;
        $result = $rc->getBadNo($id_cuenta);
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
        $rc = new ResumenClass();
        $id_cuenta = 1;
        $result = $rc->getHistory($id_cuenta);
        if ($result) {
            $keys = array_keys($result[0]);
            $this->assertEquals($testKeys, $keys);
            $this->assertGreaterThan(0, count($result));
        }
        $this->assertTrue(true);
    }

    public function testGetGestorList()
    {
        $rc = new ResumenClass();
        $result = $rc->getGestorList();
        $this->assertContains('gmbs', $result);
    }

    public function testGetVisitadorList()
    {
        $rc = new ResumenClass();
        $result = $rc->getVisitadorList();
        $id = array_search('gmbs', array_column($result, 'iniciales'));
        $this->assertGreaterThanOrEqual(0, $id);
        $this->assertEquals('gregory miles blumenthal scharf', $result[$id]['completo']);
    }

    public function testGetClientList()
    {
        $query = Cliente::first();
        if ($query) {
            $cliente = $query->cliente;
            $rc = new ResumenClass();
            $result = $rc->getClientList();
            $this->assertContains($cliente, $result);
        }
        $this->assertTrue(true);
    }

    public function testNumGests()
    {
        $rc = new ResumenClass();
        $gestor = 'gmbs';
        $numGests = $rc->getNumGests($gestor);
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
        $rc = new ResumenClass();
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
        $query = Historia::where('c_cont', '>', 0)->where('d_fech', '>', $date);
        $gestiones = $query->get();
        $first = $gestiones->first();
        if ($first) {
            $id_cuenta = $first->C_CONT;
            $rc = new ResumenClass();
            $count = $rc->countGestiones($id_cuenta);
            $this->assertGreaterThan(0, $count);
        }
        $this->assertTrue(true);
    }

    public function testCountPromesas()
    {
        $query = Historia::where('c_cont', '>', 0)->where('n_prom', '>', 0)->first();
        if ($query) {
            $id_cuenta = $query->C_CONT;
            $rc = new ResumenClass();
            $count = $rc->countPromesas($id_cuenta);
            $this->assertGreaterThan(0, $count);
        }
        $this->assertTrue(true);
    }

    public function testCountPagos()
    {
        $rc = new ResumenClass();
        /** @var Pago $pago */
        $pago = Pago::first();
        if ($pago) {
            $id_cuenta = $pago->id_cuenta;
            $count = $rc->countPagos($id_cuenta);
            $this->assertGreaterThan(0, $count);
        }
        $this->assertTrue(true);
    }

    public function testGetCuentaFromId()
    {
        $rc = new ResumenClass();
        $id_cuenta = 0;
        $cuenta = $rc->getCuentaFromId($id_cuenta);
        $this->assertEquals('', $cuenta);
        $query = Resumen::where('id_cuenta', '>', 0)->first();
        if ($query) {
            $id_cuenta = $query->id_cuenta;
            $cuenta = $rc->getCuentaFromId($id_cuenta);
            $this->assertNotEquals('', $cuenta);
        }
    }

    public function testGetPromData()
    {
        $testProm = [
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
        $rc = new ResumenClass();
        $query = Historia::where('n_prom', '>', 0)->first();
        if ($query) {
            $c_cont = $query->C_CONT;
            $promesas = $rc->getPromData($c_cont);
            $fields = [
                "N_PROM_OLD",
                "N_PROM1_OLD",
                "D_PROM_OLD",
                "D_PROM1_OLD"
            ];
            foreach ($fields as $field) {
                $this->assertGreaterThan($testProm[$field], $promesas[$field]);
            }
        }
        $this->assertTrue(true);
    }

    public function testGetTimelock()
    {
        $now = date('r');
        $rc = new ResumenClass();
        $query = Resumen::whereNull('locker')->first();
        if ($query) {
            $timeLock = $rc->getTimelock($query->id_cuenta);
            $this->assertEquals($now, $timeLock, '', 2);
        }
        $query = Resumen::where('locker', '<>', '')->first();
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
        $rc = new ResumenClass();
        /** @var Builder $query */
        $query = Historia::where('c_cniv', '<>', '');
        $visitas = $query->get();
        /** @var Historia $first */
        $first = $visitas->first();
        if ($first) {
            $visits = $rc->listVisits($first->C_CONT);
            $this->assertGreaterThan(0, count($visits));
            $this->checkKeys($testKeys, $visits);
        }
        $this->assertTrue(true);
    }
}
