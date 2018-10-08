<?php
namespace Tests\Unit;

use App\HorariosDataClass;
use App\PerfmesClass;

class PerfmesClassTest extends HorariosClassTest
{
    /**
     * @var PerfmesClass
     */
    protected $uc;

    public function setUp()
    {
        parent::setUp();
        $this->uc = new PerfmesClass();
    }

    public function testPackData()
    {
        $result = $this->uc->packData();
        dd($result);
        $first = array_pop($result);
        $this->assertInstanceOf(HorariosDataClass::class, $first);
        $start = strtotime($first->start);
        $stop = strtotime($first->stop);
        $diff = $stop - $start;
        $this->assertEquals($diff, $first->diff);
    }

}
