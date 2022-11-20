<?php

use cobra_salsa\QueuelistObject;
use cobra_salsa\QueuesgClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/QueuesgClass.php';
require_once __DIR__ . '/../classes/QueuelistObject.php';

class QueuesgClassTest extends TestCase
{
    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var QueuesgClass
     */
    protected QueuesgClass $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new QueuesgClass($this->pdo);
    }

    /**
     * @depends testGetCamp
     */
    public function testSetCamp(): void
    {
        $queue = $this->getQueue();
        $cliente = $queue->cliente;
        $queueName = $queue->queue;
        $sdc = $queue->sdc;
        $start = $this->cc->getCamp($cliente, $queueName, $sdc, 'gmbs');
        $this->cc->setCamp($start, 'gmbs');
        $report = $this->cc->getMyQueue('gmbs');
        $this->assertEquals($cliente, $report->cliente);
        $this->assertEquals($queueName, $report->status_aarsa);
        $this->assertEquals($sdc, $report->sdc);
        $this->assertEquals($start, $report->camp);
    }

    public function testGetQueueSdcClients()
    {
        $report = $this->cc->getQueueSdcClients('gmbs');
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertArrayHasKey('status_aarsa', $first);
        $this->assertArrayHasKey('sdc', $first);
        $this->assertArrayHasKey('cliente', $first);
    }

    public function testGetCamp()
    {
        $queue = $this->getQueue();
        $cliente = $queue->cliente;
        $queueName = $queue->queue;
        $sdc = $queue->sdc;
        $report = $this->cc->getCamp($cliente, $queueName, $sdc, 'gmbs');
        $this->assertIsInt($report);
        $this->assertGreaterThan(0, $report);
    }

    public function testGetSdcClients()
    {
        $report = $this->cc->getSdcClients('gmbs');
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertArrayHasKey('sdc', $first);
        $this->assertArrayHasKey('cliente', $first);
    }

    public function testGetClients()
    {
        $report = $this->cc->getClients();
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertArrayHasKey('cliente', $first);
    }

    /**
     * @return false|mixed|object|stdClass|null
     */
    private function getQueue()
    {
        $query = "SELECT cliente, status_aarsa AS queue, sdc 
from cobraribemi.queuelist
where cliente <> '' and queuelist.status_aarsa <> '' and sdc <> ''
and gestor = 'gmbs'
LIMIT 1
";
        $stq = $this->pdo->prepare($query);
        $stq->execute();
        return $stq->fetchObject();
    }
}
