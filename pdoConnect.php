<?php

/**
 * Description of pdoConnect
 *
 * @author gmbs
 */
class pdoConnect
{
    protected $dsn        = 'mysql:dbname=cobra;host=localhost';
    protected $username   = "root";
    protected $passwd     = "4sale";
    /**
     * @var PDO
     */
    protected $pdo;
    protected $queryadmin = "SELECT count(1) FROM nombres WHERE ticket=:ticket
            AND iniciales=:capt AND tipo='admin';";
    protected $queryuser  = "SELECT count(1) FROM nombres WHERE ticket=:ticket
            AND iniciales=:capt;";

    public function __construct()
    {
        $this->pdo = new PDO($this->dsn, $this->username, $this->passwd);
    }
    /**
     * @returns PDO
     */

    private function dbConnect($querycheck)
    {
        $ticket = filter_input(INPUT_COOKIE, 'auth');
        $capt   = filter_input(INPUT_GET, 'capt');
        if (empty($capt)) {
            $redirector = "Location: index.php";
            header($redirector);
        }
        $stc   = $this->pdo->prepare($querycheck);
        $stc->bindParam(':ticket', $ticket);
        $stc->bindParam(':capt', $capt);
        $stc->execute();
        $count = $stc->fetch();
        if ($count[0] != 1) {
            $redirector = 'Location: index.php';
            header($redirector);
        }
        return $this->pdo;
    }
    /**
     * @returns PDO
     */
    public function dbConnectAdmin()
    {
        $querycheck = $this->queryadmin;
        $pdo        = $this->dbConnect($querycheck);
        return $pdo;
    }

    /**
     * @returns PDO
     */
    public function dbConnectUser()
    {
        $querycheck = $this->queryuser;
        $pdo        = $this->dbConnect($querycheck);
        return $pdo;
    }
}