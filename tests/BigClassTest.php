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

    private $fields = [
        "numero_de_cuenta",
        "NOMBRE",
        "CLIENTE",
        "SEGMENTO",
        "saldo_total",
        "saldo_descuento_1",
        "saldo_descuento_2",
        "queue",
        "Auto",
        "C_CVGE",
        "C_CVBA",
        "C_CONT",
        "C_CVST",
        "D_FECH",
        "C_HRIN",
        "C_HRFI",
        "C_TELE",
        "C_MSGE",
        "CUENTA",
        "C_OBSE1",
        "C_OBSE2",
        "C_CONTAN",
        "C_NSE",
        "C_VISIT",
        "C_ATTE",
        "C_CNIV",
        "C_CARG",
        "C_CFAC",
        "C_CPTA",
        "C_RCON",
        "AUTH",
        "CARGADO",
        "CUANDO",
        "D_PROM",
        "C_PROM",
        "N_PROM",
        "C_CALLE1",
        "C_CALLE2",
        "C_CNP",
        "C_EMAIL",
        "C_NTEL",
        "C_NDIR",
        "C_FREQ",
        "C_CTIPO",
        "C_COWN",
        "C_CSTAT",
        "C_CREJ",
        "C_CPAT",
        "C_ACCION",
        "C_MOTIV",
        "C_CAMP",
        "D_PROM1",
        "N_PROM1",
        "D_PROM2",
        "N_PROM2",
        "C_EJE",
        "error",
        "D_PROM3",
        "N_PROM3",
        "D_PROM4",
        "N_PROM4",
        "PONDERACION",
        "CALLE",
        "COLONIA",
        "direccion_nueva",
        "email_deudor",
        "fecha_de_ultimo_pago",
        "monto_ultimo_pago"
    ];

    public function testGetProms()
    {
        $report = $this->cc->getProms($this->bio);
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertIsArray($first);
        $keys =array_keys($first);
        $this->assertEquals($this->fields, $keys);
    }

    public function testGetGestionGestores()
    {
        $report = $this->cc->getGestionGestores();
        $first = array_pop($report);
        $this->assertIsArray($first);
        $this->assertArrayHasKey('c_cvge', $first);
        $this->assertArrayHasKey(0, $first);
    }

    public function testGetGestionClientes()
    {
        $report = $this->cc->getGestionClientes();
        $first = array_pop($report);
        $this->assertIsArray($first);
        $this->assertArrayHasKey('c_cvba', $first);
        $this->assertArrayHasKey(0, $first);
    }

    public function testGetGestiones()
    {
        $report = $this->cc->getGestiones($this->bio);
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertIsArray($first);
        $keys =array_keys($first);
        $this->assertEquals($this->fields, $keys);
    }

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new BigClass($this->pdo);
        $this->bio = new BigInputObject('2020-07-01', '2020-07-31', 'todos', 'todos');
    }
}
