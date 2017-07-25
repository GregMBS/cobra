<?php

namespace cobra_salsa;

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
    protected $dsn = 'mysql:dbname=cobramunoz;host=localhost';

    /**
     *
     * @var string
     */
    protected $db = 'cobramunoz';

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

    /**
     * @returns \PDO
     */
    private function dbConnect($querycheck) {
        $ticket = filter_input(INPUT_COOKIE, 'auth');
        $capt = filter_input(INPUT_GET, 'capt');
        if (empty($capt)) {
            $capt = filter_input(INPUT_POST, 'capt');
        }
        if (empty($capt)) {
            $redirector = "Location: index.php";
            header($redirector);
        }
        $this->capt = $capt;
        $stc = $this->pdo->prepare($querycheck);
        $stc->bindParam(':ticket', $ticket);
        $stc->bindParam(':capt', $capt);
        $stc->execute();
        $count = $stc->fetch();
        if ($count[0] != 1) {
            $redirector = 'Location: index.php';
            header($redirector);
        }
        $stt = $this->pdo->prepare($this->querytipo);
        $stt->bindParam(':ticket', $ticket);
        $stt->bindParam(':capt', $capt);
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
        $pdo = $this->dbConnect($querycheck);
        return $pdo;
    }

    /**
     * @returns mysqli
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
     * @returns mysqli
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
        $pdo = $this->dbConnect($querycheck);
        return $pdo;
    }

    /**
     * @returns \PDO
     */
    public function dbConnectNobody() {
        $pdo = $this->pdo;
        return $pdo;
    }

}
