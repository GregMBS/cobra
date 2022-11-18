<?php


use cobra_salsa\BreaksClass;
use cobra_salsa\BreaksObject;
use cobra_salsa\BreaksTableObject;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/BreaksClass.php';
require_once __DIR__ . '/../classes/BreaksObject.php';
require_once __DIR__ . '/../classes/BreaksTableObject.php';


class BreaksClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var BreaksClass
     */
    protected $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new BreaksClass($this->pdo);
    }

    public function testGetTimes()
    {
        $report = $this->cc->getTimes('12:00:00', 'gmbs');
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertIsArray($first);
        $this->assertArrayHasKey('diff', $first);
        $this->assertArrayHasKey('minHr', $first);
    }

    public function testGetBreaksTable()
    {
        $report = $this->cc->getBreaksTable('gmbs');
        $this->assertIsArray($report);
        if (count($report) > 0) {
            $first = array_pop($report);
            $this->assertInstanceOf(BreaksTableObject::class, $first);
        }
    }

    public function testListUsuarias()
    {
        $report = $this->cc->listUsuarias();
        $this->assertIsArray($report);
        $this->assertContains('gmbs', $report);
    }

    public function testListBreaks()
    {
        $report = $this->cc->listBreaks();
        $this->assertIsArray($report);
        if (count($report) > 0) {
            $first = array_pop($report);
            $this->assertInstanceOf(BreaksObject::class, $first);
        }
    }
}
