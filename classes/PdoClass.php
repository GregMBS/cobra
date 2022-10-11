<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/BaseClass.php';
require_once __DIR__ . '/ConfigObject.php';

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
    protected $host = 'localhost';

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
    public $tipo = '';

    /**
     *
     * @var string
     */
    protected $queryTipo = 'SELECT tipo FROM nombres WHERE ticket=:ticket
            AND iniciales=:capt limit 1';

    public function __construct() {
        $config = new ConfigObject();
        $this->db = $config->dbName;
        $this->dsn = 'mysql:dbname=' . $this->db . ';host=' . $this->host;
        $this->pdo = new PDO($this->dsn, $this->username, $this->passwd);
    }

    /**
     * @param string $queryCheck
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
        } else {
	    $stt = $this->pdo->prepare($this->queryTipo);
            $stt->bindParam(':ticket', $ticket);
            $stt->bindParam(':capt', $capt);
            $stt->execute();
            $tipo = $stt->fetch();
            $this->tipo = $tipo['tipo'];
        }
        return $this->pdo;
    }

    /**
     * @returns PDO
     */
    public function dbConnectAdmin() {
        $query = $this->queryAdmin;
        return $this->dbConnect($query);
    }

    /**
     * @returns PDO
     */
    public function dbConnectUser() {
        $query = $this->queryUser;
        return $this->dbConnect($query);
    }

    /**
     * @returns PDO
     */
    public function dbConnectNobody() {
        return $this->pdo;
    }

}
