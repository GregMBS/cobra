<?php

namespace App;

use PDO;

/**
 * Description of PdoClass
 *
 * @author gmbs
 */
class PdoClass
{
	protected $dsn		 = 'mysql:dbname=cobra;host=localhost';
	protected $username	 = "root";
	protected $passwd	 = "DeathSta1";
    /**
     * @var \PDO
     */
    protected $pdo;

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
    protected $queryuser  = "SELECT count(1) FROM nombres WHERE ticket=:ticket
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

    public function __construct()
    {
        $this->pdo = new \PDO($this->dsn, $this->username, $this->passwd);
    }
    /**
     * @returns \PDO
     */

    private function dbConnect($querycheck)
    {
        $ticket = filter_input(INPUT_COOKIE, 'auth');
        $capt   = filter_input(INPUT_GET, 'capt');
        if (empty($capt)) {
            $capt   = filter_input(INPUT_POST, 'capt');
        }
        if (empty($capt)) {
            $redirector = "Location: index.php";
            header($redirector);
        }
        $this->capt = $capt;
        $stc   = $this->pdo->prepare($querycheck);
        $stc->bindParam(':ticket', $ticket);
        $stc->bindParam(':capt', $capt);
        $stc->execute();
        $count = $stc->fetch();
        if ($count[0] != 1) {
            $redirector = 'Location: index.php';
            header($redirector);
        }
        $stt   = $this->pdo->prepare($this->querytipo);
        $stt->bindParam(':ticket', $ticket);
        $stt->bindParam(':capt', $capt);
        $stt->execute();
        $tipo = $stt->fetch();
        $this->tipo=$tipo['tipo'];
        return $this->pdo;
    }
    /**
     * @returns \PDO
     */
    public function dbConnectAdmin()
    {
        $querycheck = $this->queryadmin;
        $pdo        = $this->dbConnect($querycheck);
        return $pdo;
    }

    /**
     * @returns \PDO
     */
    public function dbConnectUser()
    {
        $querycheck = $this->queryuser;
        $pdo        = $this->dbConnect($querycheck);
        return $pdo;
    }

    /**
     * @returns \PDO
     */
    public function dbConnectNobody()
    {
        $pdo        = $this->pdo;
        return $pdo;
    }

    public function getUserType($capt)
    {
        $tipo	 = '';
        $query	 = "SELECT tipo FROM nombres "
            ."WHERE iniciales = :capt "
                ."LIMIT 1";
                $stq	 = $this->pdo->prepare($query);
                $stq->bindParam(':capt', $capt);
                $stq->execute();
                $result	 = $stq->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $user) {
                    $tipo = $user['tipo'];
                }
                return $tipo;
    }
}