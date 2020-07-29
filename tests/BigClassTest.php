<?php


use cobra_salsa\BigClass;
use cobra_salsa\BigInputObject;
use cobra_salsa\PdoClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../classes/PdoClass.php';
require_once __DIR__ . '/../classes/BigClass.php';
require_once __DIR__ . '/../classes/BigInputObject.php';

class BigClassTest extends TestCase
{
    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var BigClass
     */
    protected $cc;

    /**
     * @var BigInputObject
     */
    protected $bio;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new BigClass($this->pdo);
        $this->bio = new BigInputObject('2020-01-01', '2020-08-01','todos', 'todos');
    }



    public function testGetProms()
    {
        $report = $this->cc->getProms($this->bio);
        var_dump($report);
    }

    public function testGetGestionGestores()
    {
        $gestores = $this->cc->getGestionGestores();
        var_dump($gestores);
    }

    public function testGetGestionClientes()
    {
        $clientes = $this->cc->getGestionClientes();
        var_dump($clientes);
    }

    public function testGetGestiones()
    {
        $report = $this->cc->getGestiones($this->bio);
        var_dump($report);
    }
}
