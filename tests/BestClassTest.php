<?php

use cobra_salsa\BestClass;
use cobra_salsa\HistoriaObject;
use cobra_salsa\ResumenObject;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/BestClass.php';
require_once __DIR__ . '/../classes/HistoriaObject.php';
require_once __DIR__ . '/../classes/ResumenObject.php';

class BestClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var BestClass
     */
    protected BestClass $cc;

    /**
     * @var int
     */
    protected int $id;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new BestClass($this->pdo);
        $this->id = $this->getTopIdCuenta();
    }

    public function testGetLastHistoriaData()
    {
        $data = $this->cc->getLastHistoriaData($this->id);
        $this->assertInstanceOf(HistoriaObject::class, $data);
    }

    public function testCountGestiones()
    {
        $data = $this->cc->countGestiones($this->id);
        $this->assertIsInt($data);
    }

    public function testGetBestHistoriaData()
    {
        $data = $this->cc->getBestHistoriaData($this->id);
        $this->assertInstanceOf(HistoriaObject::class, $data);
    }

/*
    public function testGetNewBestHistoriaData()
    {
        $data = $this->cc->getNewBestHistoriaData($this->id);
        $this->assertIsArray($data);
    }
*/

    public function testGetResumenData()
    {
        $stq = $this->cc->getResumenData();
        $data = $stq->fetchObject( ResumenObject::class);
        $this->assertInstanceOf(ResumenObject::class, $data);
    }

    /**
     * @return int
     */
    private function getTopIdCuenta(): int
    {
        $query = "SELECT MAX(C_CONT) as cc from historia";
        $stq = $this->pdo->query($query);
        $result = $stq->fetch();
        return $result[0];
    }

    /*
    public function testAll()
    {
        ini_set('memory_limit', '2048M');
        $this->cc->createBestTemp();
        $this->cc->createLastBest();
        $stq = $this->cc->getLastBest();
        $output = $stq->fetchAll(PDO::FETCH_ASSOC);
        $count = count($output);
        $this->assertGreaterThan(0, $count);
    }
    */
}
