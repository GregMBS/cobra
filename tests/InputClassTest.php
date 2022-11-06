<?php


use cobra_salsa\InputClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../classes/InputClass.php';

class InputClassTest extends TestCase
{
    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var InputClass
     */
    protected InputClass $ic;

    protected function setUp(): void
    {
        $this->ic = new InputClass();
    }

    public function testReadXLSXFile()
    {
        $filename = 'C:\Users\llame\carteritas\data\carga.xlsx';
        $result = $this->ic->readXLSXFile($filename);
        $this->assertIsArray($result);
        var_dump($result);
    }
}
