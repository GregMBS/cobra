<?php


use cobra_salsa\RotasClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/RotasClass.php';

class RotasClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var RotasClass
     */
    protected RotasClass $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new RotasClass($this->pdo);
    }

    public function testGetRotas()
    {
        $report = $this->cc->getRotas('gmbs');
        $this->assertIsArray($report);
        $first = array_pop($report);
        if ($first) {
            $this->assertArrayHasKey('numero_de_cuenta', $first);
            $this->assertArrayHasKey('cliente', $first);
            $this->assertArrayHasKey('c_cvge', $first);
            $this->assertArrayHasKey('id_cuenta', $first);
            $this->assertArrayHasKey('status_aarsa', $first);
            $this->assertArrayHasKey('dp1', $first);
            $this->assertArrayHasKey('np1', $first);
            $this->assertArrayHasKey('dp2', $first);
            $this->assertArrayHasKey('np2', $first);
            $this->assertArrayHasKey('dp3', $first);
            $this->assertArrayHasKey('np3', $first);
            $this->assertArrayHasKey('dp4', $first);
            $this->assertArrayHasKey('np4', $first);
            $this->assertArrayHasKey('sum_monto', $first);
            $this->assertArrayHasKey('nombre_deudor', $first);
            $this->assertArrayHasKey('status_de_credito', $first);
            $this->assertArrayHasKey('saldo_total', $first);
            $this->assertArrayHasKey('semaforo', $first);
        }
    }

    public function testGetUserType()
    {
        $tipo = $this->cc->getUserType('gmbs');
        $this->assertEquals('admin', $tipo);
    }
}
