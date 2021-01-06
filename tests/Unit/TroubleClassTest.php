<?php

namespace Tests\Unit;

use App\Trouble;
use App\TroubleClass;
use App\TroubleDataClass;
use Tests\TestCase;

class TroubleClassTest extends TestCase
{
    public function testListTrouble()
    {
        $testKeys = [
            0 => 'auto',
            1 => 'fechahora',
            2 => 'sistema',
            3 => 'usuario',
            4 => 'fuente',
            5 => 'descripcion',
            6 => 'error_msg',
            7 => 'fechacomp',
            8 => 'it_guy',
            9 => 'reparacion'
        ];
        $tc = new TroubleClass();
        $result = $tc->listTrouble();
        $this->checkKeys($testKeys, $result);
    }

    /**
     * @param Trouble $trouble
     * @return Trouble
     */
    private function checkTrouble(Trouble $trouble): Trouble
    {
        $this->assertIsInt($trouble->auto);
        $tro = Trouble::find($trouble->auto);
        $this->assertInstanceOf(Trouble::class, $tro);
        return $tro;
    }

    /**
     * @throws \Exception
     */
    public function testInsertUpdateTrouble()
    {
        $tc = new TroubleClass();
        $tdc = new TroubleDataClass();
        $tdc->system = 'localhost';
        $tdc->user = 'gregb';
        $tdc->source = 'COBRA';
        $tdc->description = 'test';
        $tdc->error_msg = '404';
        $trouble = $tc->insertTrouble($tdc);
        $temp = $this->checkTrouble($trouble);
        $this->assertEquals('404', $temp->error_msg);
        $tdc->auto = $temp->auto;
        $tdc->fix = 'wontfix';
        $tc->updateTrouble($tdc, 'gmbs');
        $tro = $this->checkTrouble($trouble);
        $this->assertEquals('wontfix', $tro->reparacion);
        $tro->delete();
    }
}
