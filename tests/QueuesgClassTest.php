<?php

use cobra_salsa\PdoClass;
use cobra_salsa\QueuelistObject;
use cobra_salsa\QueuesgClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../classes/PdoClass.php';
require_once __DIR__ . '/../classes/QueuesgClass.php';
require_once __DIR__ . '/../classes/QueuelistObject.php';

class QueuesgClassTest extends TestCase
{
    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var QueuesgClass
     */
    protected $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new QueuesgClass($this->pdo);
    }

    /**
     * @depends testGetCamp
     */
    public function testSetCamp()
    {
        $start = $this->cc->getCamp('FAMSA', 'ESPECIAL', 'Armando FAMSA', 'gmbs');
        $this->cc->setCamp($start, 'gmbs');
        $report = $this->cc->getMyQueue('gmbs');
        $this->assertInstanceOf(QueuelistObject::class, $report);
        $this->assertEquals('FAMSA', $report->cliente);
        $this->assertEquals('ESPECIAL', $report->status_aarsa);
        $this->assertEquals('Armando FAMSA', $report->sdc);
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
        $report = $this->cc->getCamp('FAMSA', 'ESPECIAL', 'Armando FAMSA', 'gmbs');
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
}
