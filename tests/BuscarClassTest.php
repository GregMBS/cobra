<?php


use cobra_salsa\BuscarClass;
use cobra_salsa\ResumenObject;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/BuscarClass.php';
require_once __DIR__ . '/../classes/ResumenObject.php';

class BuscarClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var BuscarClass
     */
    protected BuscarClass $cc;

    /**
     * @var string
     */
    protected string $name;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new BuscarClass($this->pdo);
        $this->name = $this->getTestName();
    }

    /**
     * @return void
     */
    public function testListClients(): void
    {
        $clients = $this->cc->listClients();
        $this->assertIsArray($clients);
        $first = array_pop($clients);
        $this->assertIsString($first);
    }

    /**
     * @return void
     */
    public function testSearchExactAccounts(): void
    {
        $accounts = $this->cc->searchAccounts('nombre_deudor',$this->name,'FAMSA');
        $first = array_pop($accounts);
        $this->assertInstanceOf(ResumenObject::class, $first);
    }

    /**
     * @return void
     */
    public function testSearchAccounts(): void
    {
        $shortName = substr($this->name, 5);
        $accounts = $this->cc->searchAccounts('nombre_deudor',$shortName,'FAMSA');
        $first = array_pop($accounts);
        $this->assertInstanceOf(ResumenObject::class, $first);
    }

    /**
     * @return string
     */
    private function getTestName(): string
    {
        $query = "select max(nombre_deudor) as nm
from resumen
where cliente = 'FAMSA'
limit 1";
        $stq = $this->pdo->query($query);
        $result = $stq->fetch(PDO::FETCH_ASSOC);
        return $result['nm'];
    }
}
