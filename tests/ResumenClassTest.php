<?php

namespace Tests;

use App\Dictamen;
use App\ResumenClass;


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
}
