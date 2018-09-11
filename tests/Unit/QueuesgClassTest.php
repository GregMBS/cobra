<?php

namespace Tests\Unit;

use App\QueuesgClass;
use Tests\TestCase;

class QueuesgClassTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetCamp()
    {
        $qc = new QueuesgClass();
        $result = $qc->getCamp('GCyC', 'Especial', 'VEN MORA 2', 'gmbs');
        $this->assertNotEquals(-1, $result);
        $result = $qc->getCamp('GCyC', 'Especial', '', 'gmbs');
        $this->assertEquals(-1, $result);
    }

    public function testGetClientes()
    {
        $qc = new QueuesgClass();
        $result = $qc->getClients();
        $this->assertNotEmpty($result);
    }

    public function testGetSdcClients()
    {
        $qc = new QueuesgClass();
        $result = $qc->getSdcClients('gmbs');
        $this->assertNotEmpty($result);
    }

    public function testGetQueueSdcClients()
    {
        $qc = new QueuesgClass();
        $result = $qc->getQueueSdcClients('gmbs');
        $this->assertNotEmpty($result);
    }
}
