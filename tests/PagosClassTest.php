<?php


use cobra_salsa\PagosClass;
use cobra_salsa\PagosObject;
use cobra_salsa\PdoClass;
use cobra_salsa\ResumenObject;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../classes/PdoClass.php';
require_once __DIR__ . '/../classes/PagosClass.php';
require_once __DIR__ . '/../classes/PagosObject.php';
require_once __DIR__ . '/../classes/ResumenObject.php';

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
        $pagos = $this->cc->listPagos(158877);
        $this->assertIsArray($pagos);
        $first = array_pop($pagos);
        $this->assertInstanceOf(PagosObject::class, $first);
    }

    public function testQueryAll()
    {
        $report = $this->cc->queryAll('2020-01-01', '2020-12-31', 'FAMSA');
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
        $keys = array_keys((array) $first);
        $this->assertEquals($expected, $keys);
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
        $report = $this->cc->summaryThisMonth();
        $this->assertIsArray($report);
        $first = array_pop($report);
        $expected = [
            'cli',
            'sdc',
            'sm',
            'smc'
        ];
        $keys = array_keys($first);
        $this->assertEquals($expected, $keys);
    }

    public function testSummaryLastMonth()
    {
        $report = $this->cc->summaryLastMonth();
        $this->assertIsArray($report);
        $first = array_pop($report);
        $expected = [
            'cli',
            'sdc',
            'sm',
            'smc'
        ];
        $keys = array_keys($first);
        $this->assertEquals($expected, $keys);
    }

    public function testGetCuentaClienteFromID()
    {
        $data = $this->cc->getCuentaClienteFromID(158877);
        $this->assertInstanceOf(ResumenObject::class, $data);
    }
}
