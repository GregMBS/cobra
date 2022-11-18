<?php

use cobra_salsa\ResumenObject;
use cobra_salsa\ResumenQueuesClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/ResumenQueuesClass.php';
require_once __DIR__ . '/../classes/ResumenObject.php';

class ResumenQueuesClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var ResumenQueuesClass
     */
    protected $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new ResumenQueuesClass($this->pdo);
    }

    public function testGetStatusQueue()
    {
        $report = $this->cc->getStatusQueue('');
        $this->assertEquals('SIN GESTION', $report);
    }

    public function testGetNextAccount()
    {
        try {
            $report = $this->cc->getNextAccount('gmbs', 0, '', '');
            $this->assertInstanceOf(ResumenObject::class, $report);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
