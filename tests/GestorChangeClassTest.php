<?php

use cobra_salsa\GestorChangeClass;
use cobra_salsa\ResumenObject;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/GestorChangeClass.php';
require_once __DIR__ . '/../classes/ResumenObject.php';

class GestorChangeClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var GestorChangeClass
     */
    protected $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new GestorChangeClass($this->pdo);
    }

    public function testListCuentas()
    {
        $report = $this->cc->listCuentas(['0-9902']);
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertInstanceOf(ResumenObject::class, $first);

    }

    public function testListGestores()
    {
        $report = $this->cc->listGestores();
        $this->assertIsArray($report);
        $this->assertContains('gmbs', $report);
    }

    /**
     * @depends testListCuentas
     */
    public function testChangeGestor()
    {
        $original = $this->cc->listCuentas(['0-9902']);
        $first = array_pop($original);
        $changed = $this->cc->changeGestor($first->id_cuenta, 'gmbs', 'test');
        $this->assertEquals($first->id_cuenta, $changed->id_cuenta);
        $this->assertEquals('gmbs', $changed->ejecutivo_asignado_call_center);
        $this->assertEquals('test', $changed->status_de_credito);
        $final = $this->cc->changeGestor($first->id_cuenta, $first->ejecutivo_asignado_call_center, $first->status_de_credito);
        $final->fecha_de_actualizacion = $first->fecha_de_actualizacion;
        $this->assertEquals($first, $final);
    }
}
