<?php

use cobra_salsa\ActivarClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/ActivarClass.php';

class ActivarClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var ActivarClass
     */
    protected $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new ActivarClass($this->pdo);
    }

    public function testInactivateCuentas()
    {
        $count = $this->cc->activateCuentas([0]);
        $this->assertSame(0, $count);
    }

    public function testActivateCuentas()
    {
        $count = $this->cc->inactivateCuentas([0]);
        $this->assertSame(0, $count);
    }
}
