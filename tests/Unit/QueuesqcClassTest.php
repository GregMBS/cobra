<?php

namespace Tests\Unit;

use App\QueuesqcClass;
use App\QueuesReportDataClass;
use Tests\TestCase;

class QueuesqcClassTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testNormalQueues()
    {
        $qc = new QueuesqcClass();
        $result = $qc->normalQueues();
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $this->assertInstanceOf(QueuesReportDataClass::class, $first);
    }

    public function testSpecialQueues()
    {
        $qc = new QueuesqcClass();
        $result = $qc->specialQueues();
        if ($result) {
            $this->assertGreaterThan(0, count($result));
            $first = $result[0];
            $this->assertInstanceOf(QueuesReportDataClass::class, $first);
        }
        $this->assertTrue(true);
    }
}
