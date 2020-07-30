<?php


use cobra_salsa\BuscarClass;
use cobra_salsa\PdoClass;
use cobra_salsa\ResumenObject;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../classes/PdoClass.php';
require_once __DIR__ . '/../classes/BuscarClass.php';
require_once __DIR__ . '/../classes/ResumenObject.php';

class BuscarClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var BuscarClass
     */
    protected $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new BuscarClass($this->pdo);
    }

    public function testListClients()
    {
        $clients = $this->cc->listClients();
        $this->assertIsArray($clients);
        $first = array_pop($clients);
        $this->assertIsString($first);
    }

    public function testSearchAccounts()
    {
        $accounts = $this->cc->searchAccounts('','','');
        $first = array_pop($accounts);
        $this->assertInstanceOf(ResumenObject::class, $first);
    }
}
