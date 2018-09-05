<?php

namespace Tests\Unit;

use App\Dictamen;
use App\ResumenClass;
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
        $id_cuenta = $rc->lastGestion('gmbs');
        $this->assertGreaterThan(0, $id_cuenta);
        $id_cuenta = $rc->lastGestion('');
        $this->assertEquals(0, $id_cuenta);
    }

    /**
     * @throws \Exception
     */
    public function testGetDict()
    {
        $rc = new ResumenClass();
        $dictamenes = $rc->getDict('callcenter');
        $this->assertContains('TEL OCUPADA', $dictamenes);
        $this->assertNotContains('Habitada por familiar no valido', $dictamenes);
        $this->assertNotContains('PROMESA INCUMPLIDA', $dictamenes);
        $dictamenes = $rc->getDict('admin');
        $this->assertContains('TEL OCUPADA', $dictamenes);
        $this->assertContains('Habitada por familiar no valido', $dictamenes);
        $this->assertContains('PROMESA INCUMPLIDA', $dictamenes);
        $dictamenes = $rc->getDict('visitador');
        $this->assertNotContains('TEL OCUPADA', $dictamenes);
        $this->assertContains('Habitada por familiar no valido', $dictamenes);
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
            $this->assertContains('Habitada por familiar no valido', $dictamenes);
            $this->assertNotContains('PROMESA INCUMPLIDA', $dictamenes);
        } catch (\Exception $e) {
            $this->assertEquals('', $e->getMessage());
        }
    }

    /**
     * @throws \Exception
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
     * @throws \Exception
     */
    public function testCnp()
    {
        $rc = new ResumenClass();
        $dictamenes = $rc->getCnp();
        $this->assertContains('Obligado Solidario', $dictamenes);
    }

    /**
     * @throws \Exception
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
        $keys = array_keys($result);
        $this->assertEquals($testKeys, $keys);
        $this->assertEquals($testResult, $result);
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
        $keys = array_keys($result[0]);
        $this->assertEquals($testKeys, $keys);
        $this->assertGreaterThan(0, count($result));
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
        $rc = new ResumenClass();
        $result = $rc->getClientList();
        $this->assertContains('GCYC', $result);
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
        $rc = new ResumenClass();
        $id_cuenta = 1;
        $count = $rc->countGestiones($id_cuenta);
        $this->assertGreaterThan(0, $count);
    }

    public function testCountPromesas()
    {
        $rc = new ResumenClass();
        $id_cuenta = 1;
        $count = $rc->countPromesas($id_cuenta);
        $this->assertGreaterThan(0, $count);
    }

    public function testCountPagos()
    {
        $rc = new ResumenClass();
        $id_cuenta = 1;
        $count = $rc->countPagos($id_cuenta);
        $this->assertGreaterThan(0, $count);
    }

    public function testGetCuentaFromId()
    {
        $rc = new ResumenClass();
        $id_cuenta = 0;
        $cuenta = $rc->getCuentaFromId($id_cuenta);
        $this->assertEquals('', $cuenta);
        $id_cuenta = 1;
        $cuenta = $rc->getCuentaFromId($id_cuenta);
        $this->assertNotEquals('', $cuenta);

    }
}
