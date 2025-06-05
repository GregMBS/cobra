<?php

use cobra_salsa\GestorAdminClass;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../classes/GestorAdminClass.php';
require_once __DIR__ . '/../classes/PdoClass.php';

class GestorAdminClassTest extends TestCase
{
    protected $pdo;
    protected $gestorAdmin;

    protected function setUp(): void
    {
        // Use an in-memory SQLite database for testing, or mock PDO as needed
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->exec("CREATE TABLE `nombres` (
  `USUARIA` varchar(20) NOT NULL UNIQUE,
  `INICIALES` varchar(20) DEFAULT NULL,
  `COMPLETO` varchar(255) DEFAULT NULL,
  `TIPO` varchar(255) DEFAULT NULL,
  `TICKET` varchar(255) DEFAULT NULL,
  `camp` int NOT NULL DEFAULT '0',
  `turno` varchar(255) DEFAULT NULL,
  `authcode` varchar(6) DEFAULT NULL,
  `passw` varchar(255) NOT NULL DEFAULT 'adarc',
  `policy` tinyint NOT NULL DEFAULT '0',
  `id` int primary key
  )");
        $this->gestorAdmin = new GestorAdminClass($this->pdo);
    }

    public function testAddGestor()
    {
        $usuaria = 'testuser';
        $completo = 'Test User';
        $passw = 'password123';
        $tipo = 'admin';
        $iniciales = 'TU';
        $this->gestorAdmin->addToNombres($completo, $tipo, $usuaria, $iniciales, $passw);
        
        $stmt = $this->pdo->query("SELECT * FROM nombres LIMIT 1");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($usuaria, $row['USUARIA']);
        $this->assertEquals($completo, $row['COMPLETO']);
        $this->assertEquals($tipo, $row['TIPO']);
        $this->assertEquals($iniciales, $row['INICIALES']);
    }

    public function testListGestores()
    {
        $this->gestorAdmin->addToNombres('User One', 'admin', 'user1', 'A', 'pw1');
        $this->gestorAdmin->addToNombres('User Two', 'user', 'user2', 'B', 'pw2');
        $list = $this->gestorAdmin->getNombres();
        $this->assertCount(2, $list);
        $this->assertEquals('User One', $list[0]['COMPLETO']);
    }

    public function testUpdateOpenParams()
    {
        $this->gestorAdmin->addToNombres('User One', 'admin', 'user1', 'A', 'pw1');
        $this->gestorAdmin->updateOpenParams('User 1', 'user', 'user1');
        
        $stmt = $this->pdo->query("SELECT * FROM nombres WHERE usuaria = 'user1'");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals('User 1', $row['COMPLETO']);
        $this->assertEquals('user', $row['TIPO']);
    }

    public function testDeleteGestor()
    {
        $this->gestorAdmin->addToNombres('User One', 'admin', 'user1', 'A', 'pw1');
        $this->gestorAdmin->deleteFromNombres('user1');

        $stmt = $this->pdo->query("SELECT * FROM nombres WHERE usuaria = 'user1'");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertFalse($row);
    }
        
}