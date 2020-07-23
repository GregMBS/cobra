<?php


use cobra_salsa\PagosClass;
use cobra_salsa\PdoClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../classes/PdoClass.php';
require_once __DIR__ . '/../classes/PagosClass.php';

class PagosClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var PagosClass
     */
    protected $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new PagosClass($this->pdo);
    }

    public function testListClientes()
    {
        $clients = $this->cc->listClientes();
        $first = array_pop($clients);
        $this->assertArrayHasKey('cliente', $first);
    }

    public function testQuerySheet()
    {
        $report = $this->cc->querySheet();
        $this->assertIsArray($report);
        $first = array_pop($report);
        $expected = [
            'cuenta',
            'fecha',
            'fechacapt',
            'monto',
            'cliente',
            'sdc',
            'gestor',
            'confirmado',
            'id_cuenta',
            'credit'
        ];
        $keys = array_keys($first);
        $this->assertEquals($expected, $keys);
    }

    public function testByGestorLastMonth()
    {
        $report = $this->cc->byGestorLastMonth();
        $this->assertIsArray($report);
        $first = array_pop($report);
        $expected = [
            'gestor',
            'cliente',
            'sm',
            'smc'
        ];
        $keys = array_keys($first);
        $this->assertEquals($expected, $keys);
    }

    public function testDetailsThisMonth()
    {
        $report = $this->cc->byGestorThisMonth();
        $this->assertIsArray($report);
        $first = array_pop($report);
        $expected = [
            'gestor',
            'cliente',
            'sm',
            'smc'
        ];
        $keys = array_keys($first);
        $this->assertEquals($expected, $keys);
    }

    public function testDetailsLastMonth()
    {
        $report = $this->cc->byGestorLastMonth();
        $this->assertIsArray($report);
        $first = array_pop($report);
        $expected = [
            'gestor',
            'cliente',
            'sm',
            'smc'
        ];
        $keys = array_keys($first);
        $this->assertEquals($expected, $keys);
    }

    public function testListPagos()
    {

    }

    public function testQueryAll()
    {

    }

    public function testByGestorThisMonth()
    {
        $report = $this->cc->byGestorThisMonth();
        $this->assertIsArray($report);
        $first = array_pop($report);
        $expected = [
            'gestor',
            'cliente',
            'sm',
            'smc'
        ];
        $keys = array_keys($first);
        $this->assertEquals($expected, $keys);
    }

    public function testQueryOldSheet()
    {
        $report = $this->cc->queryOldSheet();
        $this->assertIsArray($report);
        $first = array_pop($report);
        $expected = [
            'cuenta',
            'fecha',
            'fechacapt',
            'monto',
            'cliente',
            'sdc',
            'gestor',
            'confirmado',
            'id_cuenta',
            'credit'
        ];
        $keys = array_keys($first);
        $this->assertEquals($expected, $keys);
    }

    public function testSummaryThisMonth()
    {

    }

    public function testSummaryLastMonth()
    {

    }

    public function testGetCuentaClienteFromID()
    {

    }
}
