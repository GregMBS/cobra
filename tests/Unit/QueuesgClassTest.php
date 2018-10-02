<?php

namespace Tests\Unit;

use App\Queuelist;
use App\QueuesgClass;
use Illuminate\Database\Eloquent\Builder;
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
        /** @var Builder $query */
        $query = Queuelist::where('cliente', '<>', '')
            ->where('status_aarsa', '<>', '')
            ->where('sdc', '<>', '')
            ->where('gestor', '<>', '');
        /** @var Queuelist $camp */
        $camp = $query->first();
        $result = $qc->getCamp($camp->cliente, $camp->status_aarsa, $camp->sdc, $camp->gestor);
        $this->assertNotEquals(-1, $result);
        $result = $qc->getCamp($camp->cliente, $camp->status_aarsa, '', $camp->gestor);
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
