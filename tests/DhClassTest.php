<?php


use cobra_salsa\DhClass;
use cobra_salsa\DhObject;
use cobra_salsa\PdoClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../classes/PdoClass.php';
require_once __DIR__ . '/../classes/DhClass.php';
require_once __DIR__ . '/../classes/DhObject.php';

class DhClassTest extends TestCase
{
    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var DhClass
     */
    protected $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new DhClass($this->pdo);
    }

    public function testGetPromesas()
    {
        $report = $this->cc->getPromesas('cristina', '2020-07-01');
        $this->assertInstanceOf(DhObject::class, $report);
    }

    public function testGetDhMain()
    {
        $report = $this->cc->getDhMain('cristina', '2020-07-01');
        $this->assertInstanceOf(DhObject::class, $report);
    }
}
