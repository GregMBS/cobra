<?php

use cobra_salsa\PdoClass;
use cobra_salsa\QueuelistObject;
use cobra_salsa\QueuesQCClass;
use cobra_salsa\QueuesReportObject;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../classes/PdoClass.php';
require_once __DIR__ . '/../classes/QueuesQCClass.php';
require_once __DIR__ . '/../classes/ResumenObject.php';
require_once __DIR__ . '/../classes/QueuesReportObject.php';
require_once __DIR__ . '/../classes/QueuelistObject.php';

class QueuesQCClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var QueuesQCClass
     */
    protected $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new QueuesQCClass($this->pdo);
    }

    public function testGetReportSub()
    {
        $report = $this->cc->getReportSub('','','');
        $this->assertInstanceOf(QueuesReportObject::class, $report);
    }

    public function testGetMain()
    {
        $report = $this->cc->getMain();
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertArrayHasKey('cliente', $first);
        $this->assertArrayHasKey('status_de_credito', $first);
        $this->assertArrayHasKey('cnt', $first);
        $this->assertArrayHasKey('mnt', $first);
        $this->assertArrayHasKey('ecount', $first);
        $this->assertArrayHasKey('emount', $first);
    }

    public function testGetSegmentoCount()
    {
        $report = $this->cc->getSegmentoCount('', '');
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertArrayHasKey('ct', $first);
        $this->assertArrayHasKey('sst', $first);
    }

    public function testGetQueues()
    {
        $report = $this->cc->getQueues();
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertInstanceOf(QueuelistObject::class, $first);
    }
}
