<?php

namespace Tests\Unit;

use App\HorariosClass;
use App\HorariosDataClass;
use Tests\TestCase;

class HorariosClassTest extends TestCase
{
    /**
     * @var HorariosClass
     */
    protected $uc;
    
    public function setUp()
    {
        parent::setUp();
        $this->uc = new HorariosClass();
    }

    public function testListGestores()
    {
        $testKeys = ['c_cvge'];
        $result = $this->uc->listGestores();
        $this->checkKeys($testKeys, $result);
    }

    public function testPackData()
    {
        $gestor = 'gregb';
        $day = 1;
        $result = $this->uc->packData($gestor, $day);
        $first = $result[$day];
        $this->assertInstanceOf(HorariosDataClass::class, $first);
        $start = strtotime($first->start);
        $stop = strtotime($first->stop);
        $diff = $stop - $start;
        $this->assertEquals($diff, $first->diff);
    }

    public function testPackVisit()
    {
        $gestor = 'gregb';
        $day = 1;
        $result = $this->uc->packVisit($gestor, $day);
        $first = $result[$day];
        $this->assertInstanceOf(HorariosDataClass::class, $first);
        $this->assertEquals(null, $first->diff);
    }

    public function testDowArray()
    {
        $test = [
            1 => 'Saturday',
            2 => 'Sunday',
            3 => 'Monday',
            4 => 'Tuesday',
            5 => 'Wednesday',
            6 => 'Thursday',
            7 => 'Friday',
            8 => 'Saturday',
            9 => 'Sunday',
            10 => 'Monday',
            11 => 'Tuesday',
            12 => 'Wednesday',
            13 => 'Thursday',
            14 => 'Friday',
            15 => 'Saturday',
            16 => 'Sunday',
            17 => 'Monday',
            18 => 'Tuesday',
            19 => 'Wednesday',
            20 => 'Thursday',
            21 => 'Friday',
            22 => 'Saturday',
            23 => 'Sunday',
            24 => 'Monday',
            25 => 'Tuesday',
            26 => 'Wednesday',
            27 => 'Thursday',
            28 => 'Friday',
            29 => 'Saturday',
            30 => 'Sunday'
        ];
        $year = 2018;
        $month = 9;
        $day = 30;
        $result = $this->uc->dowArray($year, $month, $day);
        $this->assertEquals($test, $result);
    }
}
