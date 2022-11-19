<?php


use cobra_salsa\QuickHoyClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/QuickHoyClass.php';

class QuickHoyClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var QuickHoyClass
     */
    protected QuickHoyClass $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new QuickHoyClass($this->pdo);
    }

    public function testGetHoy()
    {
        $report = $this->cc->getHoy();
        $this->assertIsArray($report);
    }
}
