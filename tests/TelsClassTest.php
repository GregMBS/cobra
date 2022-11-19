<?php


use cobra_salsa\TelsClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/TelsClass.php';

class TelsClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var TelsClass
     */
    protected TelsClass $cc;

    /**
     * @var string[]
     */
    private array $marcados = [
        'cliente',
        'nombre_deudor',
        'numero_de_cuenta',
        'tel 1',
        'tel_1_marcado',
        'tel 2',
        'tel_2_marcado',
        'tel 3',
        'tel_3_marcado',
        'tel 4',
        'tel_4_marcado',
        'tel 1 alterno',
        'tel_1_alterno_marcado',
        'tel 2 alterno',
        'tel_2_alterno_marcado',
        'tel 3 alterno',
        'tel_3_alterno_marcado',
        'tel 4 alterno',
        'tel_4_alterno_marcado',
        'tel 1 laboral',
        'tel_1_laboral_marcado',
        'tel 2 laboral',
        'tel_2_laboral_marcado',
        'tel 1 ref 1',
        'tel_1_ref_1_marcado',
        'tel 1 ref 2',
        'tel_1_ref_2_marcado',
        'tel 1 ref 3',
        'tel_1_ref_3_marcado',
        'tel 1 ref 4',
        'tel_1_ref_4_marcado'
    ];

    /**
     * @var string[]
     */
    private array $contactos = [
        'cliente',
        'nombre_deudor',
        'numero_de_cuenta',
        'tel 1',
        'tel_1_contacto',
        'tel 2',
        'tel_2_contacto',
        'tel 3',
        'tel_3_contacto',
        'tel 4',
        'tel_4_contacto',
        'tel 1 alterno',
        'tel_1_alterno_contacto',
        'tel 2 alterno',
        'tel_2_alterno_contacto',
        'tel 3 alterno',
        'tel_3_alterno_contacto',
        'tel 4 alterno',
        'tel_4_alterno_contacto',
        'tel 1 laboral',
        'tel_1_laboral_contacto',
        'tel 2 laboral',
        'tel_2_laboral_contacto',
        'tel 1 ref 1',
        'tel_1_ref_1_contacto',
        'tel 1 ref 2',
        'tel_1_ref_2_contacto',
        'tel 1 ref 3',
        'tel_1_ref_3_contacto',
        'tel 1 ref 4',
        'tel_1_ref_4_contacto'
    ];

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new TelsClass($this->pdo);
    }

    public function testGetDates()
    {
        $report = $this->cc->getDates();
        $this->assertInstanceOf(DatePeriod::class, $report);
    }

    public function testGetMercadosReport()
    {
        $report = $this->cc->getMercadosReport('2020-07-01', '2020-07-31');
        $this->assertIsArray($report);
        $first = array_pop($report);
        $keys = array_keys($first);
        $this->assertEquals($this->marcados, $keys);
    }

    public function testGetContactosReport()
    {
        $report = $this->cc->getContactosReport('2020-07-01', '2020-07-31');
        $this->assertIsArray($report);
        $first = array_pop($report);
        $keys = array_keys($first);
        $this->assertEquals($this->contactos, $keys);
    }
}
