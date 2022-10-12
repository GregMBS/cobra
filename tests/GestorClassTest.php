<?php

use cobra_salsa\GestorClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/GestorClass.php';
require_once __DIR__ . '/../classes/DhObject.php';

class GestorClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var GestorClass
     */
    protected $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new GestorClass($this->pdo);
    }

    public function testGetPagos()
    {
        $report = $this->cc->getPagos('', 'FAMSA');
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertArrayHasKey('sm', $first);
        $this->assertArrayHasKey('mf', $first);
    }

    public function testGetPagosReport()
    {
        $report = $this->cc->getPromsReport('cristina');
        $this->assertIsArray($report);
    }
}
