<?php

use cobra_salsa\EspecialObject;
use cobra_salsa\QueuelistObject;
use cobra_salsa\QueuesQCClass;
use cobra_salsa\QueuesReportObject;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/QueuesQCClass.php';
require_once __DIR__ . '/../classes/ResumenObject.php';
require_once __DIR__ . '/../classes/QueuesReportObject.php';
require_once __DIR__ . '/../classes/QueuelistObject.php';
require_once __DIR__ . '/../classes/EspecialObject.php';

class QueuesQCClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var QueuesQCClass
     */
    protected QueuesQCClass $cc;

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
        $this->assertInstanceOf(EspecialObject::class, $first);
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
