<?php

namespace Tests;

use App\ValidationClass;

class ValidationClassTest extends TestCase
{
    /**
     * @var array
     */
    private $testEmpty = [
        'C_OBSE1' => '',
        'C_CARG' => '',
        'D_FECH' => '',
        'N_PROM' => 0,
        'N_PROM1' => 0,
        'N_PROM2' => 0,
        'N_PROM3' => 0,
        'N_PROM4' => 0,
        'D_PROM' => '',
        'D_PROM1' => '',
        'D_PROM2' => '',
        'D_PROM3' => '',
        'D_PROM4' => '',
        'N_PAGO' => 0,
        'D_PAGO' => '',
        'C_VISIT' => '',
        'C_CVST' => ''
    ];

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCountVisitErrors()
    {
        $vc = new ValidationClass();
        $gestion = $this->testEmpty;
        $result = $vc->countVisitErrors($gestion);
        $this->assertEquals('App\ValidationErrorClass', get_class($result));
        $this->assertEquals($result->msg,'RESUELTO ES NECESARIO<br>VISITADOR ES NECESARIO<br>ACCION ES NECESARIO<br>COMENTARIO INCOMPLETO<br>PROMESA NECESITA MONTO<br>');
        $gestion['C_CVST'] = 'something';
        $result = $vc->countVisitErrors($gestion);
        $this->assertEquals($result->msg,'VISITADOR ES NECESARIO<br>ACCION ES NECESARIO<br>COMENTARIO INCOMPLETO<br>PROMESA NECESITA MONTO<br>');
        $gestion['C_VISIT'] = 'someone';
        $result = $vc->countVisitErrors($gestion);
        $this->assertEquals($result->msg,'ACCION ES NECESARIO<br>COMENTARIO INCOMPLETO<br>PROMESA NECESITA MONTO<br>');
        $gestion['ACCION'] = 'do';
        $result = $vc->countVisitErrors($gestion);
        $this->assertEquals($result->msg,'COMENTARIO INCOMPLETO<br>PROMESA NECESITA MONTO<br>');
        $gestion['C_OBSE1'] = 'gestion gestion gestion';
        $result = $vc->countVisitErrors($gestion);
        $this->assertEquals($result->msg,'PROMESA NECESITA MONTO<br>');
        $gestion['D_FECH'] = '2018-01-01';
        $result = $vc->countVisitErrors($gestion);
        $this->assertEquals($result->msg,'');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCountGestionErrors()
    {
        $vc = new ValidationClass();
        $gestion = $this->testEmpty;
        $result = $vc->countGestionErrors($gestion);
        $this->assertEquals('App\ValidationErrorClass', get_class($result));
        $this->assertEquals($result->msg,'PROMESA NECESITA MONTO<br>');
        $gestion['D_FECH'] = '2018-01-01';
        $result = $vc->countGestionErrors($gestion);
        $this->assertEquals($result->msg,'');
    }
}
