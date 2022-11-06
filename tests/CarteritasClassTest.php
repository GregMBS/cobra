<?php


use cobra_salsa\InputClass;
use cobra_salsa\CarteritasClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/InputClass.php';
require_once __DIR__ . '/../classes/CarteritasClass.php';

class CarteritasClassTest extends TestCase
{
    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var InputClass
     */
    protected InputClass $ic;

    /**
     * @var CarteritasClass
     */
    protected CarteritasClass $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new CarteritasClass($this->pdo);
        $this->ic = new InputClass();
    }

    public function testLoadVisitas()
    {
        $filename = 'C:\Users\llame\carteritas\data\carga.xlsx';
        $data = $this->ic->readXLSXFile($filename);
        $result = $this->cc->loadVisitas($data);
        $this->assertIsString($result);
    }
}
