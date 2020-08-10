<?php


use cobra_salsa\PdoClass;
use cobra_salsa\QueuelistObject;
use cobra_salsa\QueueObject;
use cobra_salsa\QueuesClass;
use cobra_salsa\UserDataObject;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../classes/PdoClass.php';
require_once __DIR__ . '/../classes/QueuesClass.php';
require_once __DIR__ . '/../classes/QueuelistObject.php';
require_once __DIR__ . '/../classes/QueueObject.php';
require_once __DIR__ . '/../classes/UserDataObject.php';

class QueuesClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var QueuesClass
     */
    protected $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new QueuesClass($this->pdo);
    }

    public function testGetMyQueuelist()
    {
        $report = $this->cc->getMyQueuelist('gmbs');
        $first = array_pop($report);
        $this->assertInstanceOf(QueuelistObject::class, $first);
    }

    public function testGetAllQueues()
    {
        $report = $this->cc->getAllQueues();
        $first = array_pop($report);
        $this->assertInstanceOf(QueueObject::class, $first);

    }

    public function testGetGestores()
    {
        $report = $this->cc->getGestores();
        $first = array_pop($report);
        $this->assertInstanceOf(UserDataObject::class, $first);
    }

    public function testGetMyQueue()
    {
        $report = $this->cc->getMyQueue('gmbs');
        $this->assertInstanceOf(QueuelistObject::class, $report);
    }
}
