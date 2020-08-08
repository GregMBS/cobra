<?php

use cobra_salsa\GestorClass;
use cobra_salsa\PdoClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../classes/PdoClass.php';
require_once __DIR__ . '/../classes/GestorClass.php';

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
        $report = $this->cc->getPromsReport('gmbs');
        $this->assertIsArray($report);
        $first = array_pop($report);
        $expected = [
            'd_prom',
            'cuenta',
            'n_prom',
            'c_cvge',
            'ejecutivo_asignado_call_center',
            'status_aarsa',
            'saldo_vencido',
            'cliente',
            'id_cuenta',
            'saldo_descuento_1'
        ];
        $keys = array_keys($first);
        $this->assertEquals($expected, $keys);
    }
}
