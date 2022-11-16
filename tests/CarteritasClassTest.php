<?php


use cobra_salsa\CarteritasClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/CarteritasClass.php';

class CarteritasClassTest extends TestCase
{
    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var CarteritasClass
     */
    protected CarteritasClass $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new CarteritasClass($this->pdo);
    }

    /**
     * @throws Exception
     */
    public function testLoadVisitas()
    {
        $filename = 'C:\Users\llame\carteritas\data\carga.xlsx';
        $result = $this->cc->prepareData($filename);
        $dataCount = $result['dataCount'];
        $loadVisitas = $result['loadVisitas'];
        $this->assertIsInt($dataCount);
        $this->assertIsString($loadVisitas);
    }
}
