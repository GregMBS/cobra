<?php

use cobra_salsa\CheckClass;
use cobra_salsa\PdoClass;
use cobra_salsa\UserDataObject;
use cobra_salsa\VisitSheetObject;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../classes/PdoClass.php';
require_once __DIR__ . '/../classes/CheckClass.php';
require_once __DIR__ . '/../classes/UserDataObject.php';
require_once __DIR__ . '/../classes/VisitSheetObject.php';

class CheckClassTest extends TestCase
{
    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var CheckClass
     */
    protected $cc;

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
        $report = $this->cc->listVasign('');
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
        $report = $this->cc->getIdCuentaFromCuenta('0-9902');
        $this->assertEquals(194420, $report);
    }

    public function testGetCuentaFromIdCuenta()
    {
        $report = $this->cc->getCuentaFromIdCuenta(194420);
        $this->assertEquals('0-9902', $report);
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
}
