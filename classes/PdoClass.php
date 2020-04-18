<?php

namespace cobra_salsa;

use ConfigClass;
use mysqli;
use PDO;

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
    protected $dsn = 'mysql:dbname=cobraribemi;host=localhost';

    /**
     *
     * @var string
     */
    protected $db = 'cobraribemi';

    /**
     *
     * @var string
     */
    protected $username = "gmbs";

    /**
     *
     * @var string
     */
    protected $passwd = "DeathSta1";

    /**
     * @var PDO
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
    protected $queryAdmin = "SELECT count(1) FROM nombres WHERE ticket=:ticket
            AND iniciales=:capt AND tipo='admin'";

    /**
     *
     * @var string
     */
    protected $queryUser = "SELECT count(1) FROM nombres WHERE ticket=:ticket
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
    protected $queryTipo = 'SELECT tipo FROM nombres WHERE ticket=:ticket
            AND iniciales=:capt limit 1';

    public function __construct() {
        $config = new ConfigClass();
        $this->db = $config->dbName;
        $this->dsn = 'mysql:dbname=' . $this->db . ';host=localhost';
        $this->pdo = new PDO($this->dsn, $this->username, $this->passwd);
    }

    /**
     * @param $queryCheck
     * @return PDO
     */
    private function dbConnect($queryCheck) {
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
        $stc = $this->pdo->prepare($queryCheck);
        $stc->bindParam(':ticket', $ticket);
        $stc->bindParam(':capt', $capt);
        $stc->execute();
        $count = $stc->fetch();
        if ($count[0] != 1) {
            $redirector = 'Location: index.php';
            header($redirector);
        }
        $stt = $this->pdo->prepare($this->queryTipo);
        $stt->bindParam(':ticket', $ticket);
        $stt->bindParam(':capt', $capt);
        $stt->execute();
        $tipo = $stt->fetch();
        $this->tipo = $tipo['tipo'];
        return $this->pdo;
    }

    /**
     * @returns PDO
     */
    public function dbConnectAdmin() {
        $queryCheck = $this->queryAdmin;
        return $this->dbConnect($queryCheck);
    }

    /**
     * @returns mysqli
     */
    public function dbConnectAdminMysqli() {

        if ($this->dbConnectAdmin()) {
            $this->con = new mysqli('localhost', $this->username, $this->passwd, $this->db);
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
            $this->con = new mysqli('localhost', $this->username, $this->passwd, $this->db);
        } else {
            $this->con = false;
        }
        return $this->con;
    }

    /**
     * @returns PDO
     */
    public function dbConnectUser() {
        $queryCheck = $this->queryUser;
        return $this->dbConnect($queryCheck);
    }

    /**
     * @returns PDO
     */
    public function dbConnectNobody() {
        return $this->pdo;
    }

}
