<?php

use cobra_salsa\PdoClass;
use cobra_salsa\QueuesgClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../classes/PdoClass.php';
require_once __DIR__ . '/../classes/QueuesgClass.php';

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

    public function testSetCamp()
    {

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
