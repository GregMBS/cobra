<?php

use cobra_salsa\BestClass;
use cobra_salsa\HistoriaObject;
use cobra_salsa\PdoClass;
use cobra_salsa\ResumenObject;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../classes/PdoClass.php';
require_once __DIR__ . '/../classes/BestClass.php';
require_once __DIR__ . '/../classes/HistoriaObject.php';
require_once __DIR__ . '/../classes/ResumenObject.php';

class BestClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var BestClass
     */
    protected $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new BestClass($this->pdo);
    }

    public function testGetLastHistoriaData()
    {
        $data = $this->cc->getLastHistoriaData(33333);
        $this->assertInstanceOf(HistoriaObject::class, $data);
    }

    public function testCountGestiones()
    {
        $data = $this->cc->countGestiones(33333);
        $this->assertIsInt($data);
    }

    public function testGetBestHistoriaData()
    {
        $data = $this->cc->getBestHistoriaData(33333);
        $this->assertInstanceOf(HistoriaObject::class, $data);
    }

    public function testGetResumenData()
    {
        $data = $this->cc->getResumenData();
        $this->assertIsArray($data);
        $first = array_pop($data);
        $this->assertInstanceOf(ResumenObject::class, $first);
    }
}
