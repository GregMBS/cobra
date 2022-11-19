<?php


use cobra_salsa\ResumenObject;
use cobra_salsa\SpeclistqcClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/SpeclistqcClass.php';
require_once __DIR__ . '/../classes/ResumenObject.php';

class SpeclistqcClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var SpeclistqcClass
     */
    protected SpeclistqcClass $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new SpeclistqcClass($this->pdo);
    }

    public function testGetReport()
    {
        $report = $this->cc->getReport('','','','');
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertInstanceOf(ResumenObject::class, $first);
    }
}
