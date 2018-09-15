<?php

namespace Tests\Unit;

use App\ChangestClass;
use Tests\TestCase;


class ChangestClassTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateResumen()
    {
        $cc = new ChangestClass();
        $count = $cc->updateResumen(false, 6239);
        $this->assertEquals(1, $count);
        $count = $cc->updateResumen(true, 6239);
        $this->assertEquals(1, $count);
        $count = $cc->updateResumen(false, 6239);
        $this->assertEquals(1, $count);
        $count = $cc->updateResumen(true, 6239);
        $this->assertEquals(1, $count);
    }
}