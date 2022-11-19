<?php

use cobra_salsa\StatusClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/StatusClass.php';


class StatusClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var StatusClass
     */
    protected StatusClass $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new StatusClass($this->pdo);
    }

    public function testGetProcesslist()
    {
        $report = $this->cc->getProcesslist();
        $this->assertIsArray($report);
        $first = array_pop($report);
        $expected = [
            'Id',
            'User',
            'Host',
            'db',
            'Command',
            'Time',
            'State',
            'Info'
        ];
        $keys = array_keys($first);
        $this->assertEquals($expected, $keys);
    }

    public function testGetTables()
    {
        $report = $this->cc->getTables();
        $this->assertIsArray($report);
    }
}
