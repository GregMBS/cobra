<?php

use cobra_salsa\CheckClass;
use cobra_salsa\UserDataObject;
use cobra_salsa\VisitSheetObject;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/CheckClass.php';
require_once __DIR__ . '/../classes/UserDataObject.php';
require_once __DIR__ . '/../classes/VisitSheetObject.php';

class CheckClassTest extends TestCase
{
    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var CheckClass
     */
    protected CheckClass $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new CheckClass($this->pdo);
    }

    public function testListVasign()
    {
        $report = $this->cc->listVasign('gmbs');
        $this->assertIsArray($report);
        if (count($report) > 0) {
            $first = array_pop($report);
            $this->assertInstanceOf(VisitSheetObject::class, $first);
        }
        $report = $this->cc->listVasign();
        $this->assertIsArray($report);
        if (count($report) > 0) {
            $first = array_pop($report);
            $this->assertInstanceOf(VisitSheetObject::class, $first);
        }
    }

    public function testGetOneMonth()
    {
        $now = date_create('-1 day');
        $nowString = date_format($now, 'Y-m-d');
        $report = $this->cc->getOneMonth();
        $first = array_pop($report);
        $this->assertEquals($nowString, $first);
        $then = date_create('-1 month');
        $thenString = date_format($then, 'Y-m-d');
        $reverse = array_reverse($report);
        $last = array_pop($reverse);
        $this->assertEquals($thenString, $last);
    }

    public function testCountInOut()
    {
        $report = $this->cc->countInOut('gmbs');
        $this->assertIsArray($report);
        $this->assertArrayHasKey('countOut', $report);
        $this->assertArrayHasKey('countIn', $report);
    }

    public function testGetIdCuentaFromCuenta()
    {
        $gic = $this->getIdCuentaCuenta();
        $cuenta = $gic->numero_de_cuenta;
        $id_cuenta = $gic->id_cuenta;
        $report = $this->cc->getIdCuentaFromCuenta($cuenta);
        $this->assertEquals($id_cuenta, $report);
    }

    public function testGetCuentaFromIdCuenta()
    {
        $gic = $this->getIdCuentaCuenta();
        $cuenta = $gic->numero_de_cuenta;
        $id_cuenta = $gic->id_cuenta;
        $report = $this->cc->getCuentaFromIdCuenta($id_cuenta);
        $this->assertEquals($cuenta, $report);
    }

    public function testGetCompleto()
    {
        $report = $this->cc->getCompleto('gmbs');
        $this->assertEquals('gregory miles blumenthal scharf', $report);
    }

    public function testGetVisitadores()
    {
        $report = $this->cc->getVisitadores();
        $this->assertIsArray($report);
        if (count($report) > 0) {
            $first = array_pop($report);
            $this->assertInstanceOf(UserDataObject::class, $first);
        }
    }

    /**
     * @return false|mixed|object|stdClass|null
     */
    private function getIdCuentaCuenta()
    {
        $query = "SELECT id_cuenta, numero_de_cuenta from resumen LIMIT 1";
        return $this->pdo->query($query)->fetchObject();
    }
}
