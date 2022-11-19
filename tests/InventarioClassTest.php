<?php

use cobra_salsa\InventarioClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/PdoClass.php';
require_once __DIR__ . '/../classes/InventarioClass.php';


class InventarioClassTest extends TestCase
{

    /**
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * @var InventarioClass
     */
    protected InventarioClass $cc;

    protected function setUp(): void
    {
        $pc = new PdoClass();
        $this->pdo = $pc->dbConnectNobody();
        $this->cc = new InventarioClass($this->pdo);
    }

    public function testGetInventarioReport()
    {
        $report = $this->cc->getInventarioReport('FAMSA');
        $this->assertIsArray($report);
        $first = array_pop($report);
        $this->assertIsArray($first);
        $keys = array_keys($first);
        $expected = ['id_cuenta'	,
            'numero_de_cuenta'	,
            'nombre_deudor'	,
            'cliente'	,
            'segmento'	,
            'disposicion'	,
            'producto'	,
            'subproducto'	,
            'saldo_total'	,
            'queue'	,
            'saldo_descuento_1'	,
            'saldo_descuento_2'	,
            'domicilio_deudor'	,
            'colonia_deudor'	,
            'ciudad_deudor'	,
            'estado_deudor'	,
            'cp_deudor'	,
            'tel_casa'	,
            'tel_cel'	,
            'ejecutivo_asignado_call_center'	,
            'ejecutivo_asignado_domiciliario'	,
            'gestiones'	,
            'contactos'	,
            'fecha_de_asignacion'	,
            'fecha_de_ultimo_pago'	,
            'monto_ultimo_pago'
        ];
        $this->assertEquals($expected, $keys);
    }

    public function testListClients()
    {
        $report = $this->cc->listClients();
        $this->assertIsArray($report);
        $this->assertContains('FAMSA', $report);
    }
}
