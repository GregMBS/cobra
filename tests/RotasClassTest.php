<?php


use cobra_salsa\PdoClass;
use cobra_salsa\RotasClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../classes/PdoClass.php';
require_once __DIR__ . '/../classes/RotasClass.php';
require_once __DIR__ . '/../classes/RotasQueryObject.php';

class RotasClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var RotasClass
     */
    protected $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new RotasClass($this->pdo);
    }

    public function testGetRotas()
    {
        $report = $this->cc->getRotas('gmbs');
        $first = array_pop($report);
        $this->assertIsArray($first);
    }

    public function testGetUserType()
    {
        $tipo = $this->cc->getUserType('gmbs');
        $this->assertEquals('admin', $tipo);
    }
}
