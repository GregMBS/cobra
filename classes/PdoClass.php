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
    protected $dsn;

    /**
     *
     * @var string
     */
    protected $db = 'cobrarbm';

    /**
     *
     * @var string
     */
    protected $username;

    /**
     *
     * @var string
     */
    protected $passwd;

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
    public $tipo;

    /**
     *
     * @var string
     */
    protected $queryTipo = 'SELECT tipo FROM nombres WHERE ticket=:ticket
            AND iniciales=:capt limit 1';

    public function __construct() {
        $config = new ConfigObject();
        $this->db = $config->dbName;
        $this->dsn = 'mysql:dbname=' . $this->db . ';host=localhost';
        $this->username = getenv('DB_USERNAME') ?: 'gmbs';
        $this->passwd = getenv('DB_PASSWORD') ?: 'DeathSta1';
        try {
            $this->pdo = new PDO($this->dsn, $this->username, $this->passwd);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log('Database connection failed: ' . $e->getMessage());
            header('Location: error.php');
            exit;
        }
    }

    /**
     * @param string $queryCheck
     * @return PDO
     */
    private function dbConnect($queryCheck) {
        $ticket = filter_input(INPUT_COOKIE, 'auth', FILTER_SANITIZE_STRING);
        $capt = filter_input(INPUT_GET, 'capt', FILTER_SANITIZE_STRING) ?: filter_input(INPUT_POST, 'capt', FILTER_SANITIZE_STRING);

        if (empty($capt)) {
            header('Location: index.php');
            exit;
        }

        $this->capt = $capt;
        $stc = $this->pdo->prepare($queryCheck);
        $stc->bindParam(':ticket', $ticket, PDO::PARAM_STR);
        $stc->bindParam(':capt', $capt, PDO::PARAM_STR);
        $stc->execute();

        $count = $stc->fetchColumn();
        if ($count != 1) {
            header('Location: index.php');
            exit;
        }

        $stt = $this->pdo->prepare($this->queryTipo);
        $stt->bindParam(':ticket', $ticket, PDO::PARAM_STR);
        $stt->bindParam(':capt', $capt, PDO::PARAM_STR);
        $stt->execute();

        $tipo = $stt->fetch();
        $this->tipo = $tipo['tipo'] ?? '';
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
