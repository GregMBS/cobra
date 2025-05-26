<?php


use cobra_salsa\HorariosAllClass;
use cobra_salsa\HorariosClass;
use cobra_salsa\PdoClass;
use cobra_salsa\PerfmesAllClass;
use cobra_salsa\PerfmesClass;
use cobra_salsa\TimesheetDayObject;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../classes/PdoClass.php';
require_once __DIR__ . '/../classes/TimesheetClass.php';
require_once __DIR__ . '/../classes/HorariosClass.php';
require_once __DIR__ . '/../classes/PerfmesClass.php';
require_once __DIR__ . '/../classes/HorariosAllClass.php';
require_once __DIR__ . '/../classes/PerfmesAllClass.php';
require_once __DIR__ . '/../classes/TimesheetDayObject.php';
require_once __DIR__ . '/../classes/ResumenObject.php';

class TimesheetClassTest extends TestCase
{
    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var HorariosClass
     */
    protected $hc;

    /**
     * @var PerfmesClass
     */
    protected $pc;

    /**
     * @var HorariosAllClass
     */
    protected $hac;

    /**
     * @var PerfmesAllClass
     */
    protected $pac;

    protected function setUp(): void
    {
        $pd = new PdoClass();
        $this->pdo = $pd->dbConnectNobody();
        $this->hc = new HorariosClass($this->pdo);
        $this->pc = new PerfmesClass($this->pdo);
        $this->hac = new HorariosAllClass($this->pdo);
        $this->pac = new PerfmesAllClass($this->pdo);
    }

    public function testGetTiempoDiff()
    {
        $report = $this->hc->getTiempoDiff('cristina', 1, 'Break');
        if (count($report) > 0) {
            $first = array_pop($report);
            $this->assertArrayHasKey('tiempo', $first);
            $this->assertArrayHasKey('diff', $first);
        }
        $report = $this->pc->getTiempoDiff('cristina', 1, 'Break');
        $first = array_pop($report);
        if ($first) {
            $this->assertArrayHasKey('tiempo', $first);
            $this->assertArrayHasKey('diff', $first);
        }
    }

    public function testGetPagos()
    {
        $report = $this->hc->getPagos('cristina', 7);
        $this->hasCount($report);
        $report = $this->pc->getPagos('cristina', 7);
        $this->hasCount($report);
    }

    public function testGetNTPDiff()
    {
        $report = $this->hc->getNTPDiff('christine', 1, '');
        $first = array_pop($report);
        $this->assertArrayHasKey('diff', $first);
        $this->assertArrayHasKey('ntp', $first);
        $report = $this->pc->getNTPDiff('christine', 1, '');
        $first = array_pop($report);
        $this->assertArrayHasKey('diff', $first);
        $this->assertArrayHasKey('ntp', $first);
    }

    public function testListGestores()
    {
        $report = $this->hc->listGestores();
        $this->assertIsArray($report);
        if (count($report) > 0) {
            $first = array_pop($report);
            $this->assertArrayHasKey('c_cvge', $first);
        }
    }

    public function testListOldGestores()
    {
        $report = $this->pc->listGestores();
        $this->assertIsArray($report);
        if (count($report) > 0) {
            $first = array_pop($report);
            $this->assertArrayHasKey('c_cvge', $first);
        }
    }

    public function testListVisitadores()
    {
        $report = $this->hc->listVisitadores();
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertIsString($first);
        $report = $this->pc->listVisitadores();
        $first = array_pop($report);
        $this->assertIsString($first);
    }

    public function testGetStartStopDiff()
    {
        $report = $this->hc->getStartStopDiff('cristina', 7);
        $this->assertIsArray($report);
        if (count($report) > 0) {
            $first = array_pop($report);
            $this->assertArrayHasKey('start', $first);
            $this->assertArrayHasKey('stop', $first);
            $this->assertArrayHasKey('diff', $first);
        }
        $report = $this->pc->getStartStopDiff('cristina', 1);
        $this->assertIsArray($report);
        if (count($report) > 0) {
            $first = array_pop($report);
            $this->assertArrayHasKey('start', $first);
            $this->assertArrayHasKey('stop', $first);
            $this->assertArrayHasKey('diff', $first);
        }
    }

    public function testGetCurrentMain()
    {
        $report = $this->hc->getCurrentMain('cristina', 7);
        $this->assertIsArray($report);
        if (count($report) > 0) {
            $first = array_pop($report);
            $this->assertArrayHasKey('cuentas', $first);
            $this->assertArrayHasKey('promesas', $first);
            $this->assertArrayHasKey('gestiones', $first);
            $this->assertArrayHasKey('nocontactos', $first);
            $this->assertArrayHasKey('contactos', $first);
        }
        $report = $this->pc->getCurrentMain('cristina', 1);
        if (count($report) > 0) {
            $this->assertIsArray($report);
            $first = array_pop($report);
            $this->assertArrayHasKey('cuentas', $first);
            $this->assertArrayHasKey('promesas', $first);
            $this->assertArrayHasKey('gestiones', $first);
            $this->assertArrayHasKey('nocontactos', $first);
            $this->assertArrayHasKey('contactos', $first);
        }
    }

    /**
     * @param array $report
     * @return array
     */
    private function hasCount(array $report): array
    {
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertArrayHasKey('ct', $first);
        return $report;
    }

    public function testPrepareSheet()
    {
        $report = $this->hc->prepareSheet('gmbs', 10);
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertInstanceOf(TimesheetDayObject::class, $first);
        $report = $this->pc->prepareSheet('cristina', 10);
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertInstanceOf(TimesheetDayObject::class, $first);
        $report = $this->hac->prepareSheet('', 10);
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertInstanceOf(TimesheetDayObject::class, $first);
        $report = $this->pac->prepareSheet('', 10);
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertInstanceOf(TimesheetDayObject::class, $first);
    }

    /**
     * @depends testPrepareSheet
     */
    public function testPrepareMonthSum()
    {
        $month = $this->hc->prepareSheet('gmbs', 10);
        $report = $this->hc->prepareMonthSum($month);
        $this->assertInstanceOf(TimesheetDayObject::class, $report);
        $month = $this->pc->prepareSheet('cristina', 10);
        $report = $this->pc->prepareMonthSum($month);
        $this->assertInstanceOf(TimesheetDayObject::class, $report);
        $month = $this->hac->prepareSheet('', 10);
        $report = $this->hac->prepareMonthSum($month);
        $this->assertInstanceOf(TimesheetDayObject::class, $report);
        $month = $this->pac->prepareSheet('', 10);
        $report = $this->pac->prepareMonthSum($month);
        $this->assertInstanceOf(TimesheetDayObject::class, $report);
    }
}
