<?php

namespace Tests\Unit;

use App\RotasClass;
use Tests\TestCase;

class RotasClassTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetRotas()
    {
       $rc = new RotasClass();
        $result = $rc->getRotas('admin', 'gmbs');
        $this->assertEquals(array(), $result);
        $result = $rc->getRotas('', 'gmbs');
        $this->assertEquals(array(), $result);
    }
}
