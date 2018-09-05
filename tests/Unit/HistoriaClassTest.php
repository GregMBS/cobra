<?php

namespace Tests\Unit;

use App\HistoriaClass;
use Tests\TestCase;

class HistoriaClassTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddNewTel()
    {
        $hc = new HistoriaClass();
        $result = $hc->addNewTel(100, 888888888);
        $this->assertEmpty($result);
    }

}
