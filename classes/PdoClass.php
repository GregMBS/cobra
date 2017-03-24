<?php

namespace gregmbs\cobra;

use mysqli;

require_once __DIR__ . '/BaseClass.php';

/**
 * Description of PdoClass
 *
 * @author gmbs
 */
class PdoClass {

    /**
     *
     * @var string
     */
    protected $dsn = 'mysql:dbname=cobrademo;host=localhost';

    /**
     *
     * @var string
     */
    protected $db = 'cobrademo';

    /**
     *
     * @var string
     */
    protected $username = "root";

    /**
     *
     * @var string
     */
    protected $passwd = "DeathSta1";

    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var mysqli
     */
    protected $con;

    /**
     *
     * @var string
     */
    protected $queryadmin = "SELECT count(1) FROM nombres WHERE ticket=:ticket
            AND iniciales=:capt AND tipo='admin'";

    /**
     *
     * @var string
     */
    protected $queryuser = "SELECT count(1) FROM nombres WHERE ticket=:ticket
            AND iniciales=:capt";

    /**
     *
     * @var string
     */
    public $capt;

    /**
     *
     * @var string
     */
    public $tipo;

    /**
     *
     * @var string
     */
    protected $querytipo = 'SELECT tipo FROM nombres WHERE ticket=:ticket
            AND iniciales=:capt limit 1';

    public function __construct() {
        $config = new \ConfigClass();
        $this->db = $config->dbName;
        $this->dsn = 'mysql:dbname=' . $this->db . ';host=localhost';
        $this->pdo = new \PDO($this->dsn, $this->username, $this->passwd);
    }

    private function startOver() {
            $redirector = "Location: index.php";
            header($redirector);
    }
    
    private function getCapt() {
        $capt = filter_input(INPUT_GET, 'capt');
        if (empty($capt)) {
            $capt = filter_input(INPUT_POST, 'capt');
        }
        if (empty($capt)) {
            $this->startOver();
        }
        $this->capt = $capt;
    }
    
    /**
     * @returns \PDO
     */
    private function dbConnect($querycheck) {
        $ticket = filter_input(INPUT_COOKIE, 'auth');
        $this->getCapt();
        $stc = $this->pdo->prepare($querycheck);
        $stc->bindParam(':ticket', $ticket);
        $stc->bindParam(':capt', $this->capt);
        $stc->execute();
        $count = $stc->fetch();
        if ($count[0] != 1) {
            $this->startOver();
        }
        $stt = $this->pdo->prepare($this->querytipo);
        $stt->bindParam(':ticket', $ticket);
        $stt->bindParam(':capt', $this->capt);
        $stt->execute();
        $tipo = $stt->fetch();
        $this->tipo = $tipo['tipo'];
        return $this->pdo;
    }

    /**
     * @returns \PDO
     */
    public function dbConnectAdmin() {
        $querycheck = $this->queryadmin;
        $this->pdo = $this->dbConnect($querycheck);
        return $this->pdo;
    }

    /**
     * @returns \mysqli
     */
    public function dbConnectAdminMysqli() {

        if ($this->dbConnectAdmin()) {
            $this->con = new \mysqli('localhost', $this->username, $this->passwd, $this->db);
        } else {
            $this->con = false;
        }
        return $this->con;
    }

    /**
     * @returns \mysqli
     */
    public function dbConnectUserMysqli() {

        if ($this->dbConnectUser()) {
            $this->con = new \mysqli('localhost', $this->username, $this->passwd, $this->db);
        } else {
            $this->con = false;
        }
        return $this->con;
    }

    /**
     * @returns \PDO
     */
    public function dbConnectUser() {
        $querycheck = $this->queryuser;
        $this->pdo = $this->dbConnect($querycheck);
        return $this->pdo;
    }

    /**
     * @returns \PDO
     */
    public function dbConnectNobody() {
        return $this->pdo;
    }

}