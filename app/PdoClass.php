<?php

namespace App;

use PDO;
use Illuminate\Http\Request;

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

    private function dbConnect($querycheck, Request $r)
    {
        $ticket = $r->session()->get('auth', '');
        $capt   = $this->getCapt($ticket);
        if (empty($capt)) {
            $redirect = redirect("index", 403);
            return $redirect;
        }
        $this->capt = $capt;
        $stc   = $this->pdo->prepare($querycheck);
        $stc->bindParam(':ticket', $ticket);
        $stc->bindParam(':capt', $capt);
        $stc->execute();
        $count = $stc->fetch();
        if ($count[0] != 1) {
            $redirect = redirect("index", 403);
            return $redirect;
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
    public function dbConnectAdmin(Request $r)
    {
        $querycheck = $this->queryadmin;
        $pdo        = $this->dbConnect($querycheck, $r);
        return $pdo;
    }

    /**
     * @returns \PDO
     */
    public function dbConnectUser(Request $r)
    {
        $querycheck = $this->queryuser;
        $pdo        = $this->dbConnect($querycheck, $r);
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

    /**
     * 
     * @param string $capt
     * @return string
     */
    public function getUserType($capt)
    {
        $tipo	 = '';
        $query	 = "SELECT tipo FROM nombres 
                WHERE iniciales = :capt 
                LIMIT 1";
        $stq	 = $this->pdo->prepare($query);
        $stq->bindParam(':capt', $capt);
        $stq->execute();
        $result	 = $stq->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $tipo = $result['tipo'];
        }
        return $tipo;
    }
    
    /**
     *
     * @param string $cookie
     * @return string|mixed
     */
    public function getCapt($cookie) {
        $capt = '';
        $query = "SELECT iniciales FROM users
                    WHERE ticket = :cookie
                    LIMIT 1";
        $stc = $this->pdo->prepare($query);
        $stc->bindParam(':cookie', $cookie);
        $stc->execute();
        $user = $stc->fetch(\PDO::FETCH_ASSOC);
        if ($user) {
            $capt = $user['iniciales'];
        }
        return $capt;
    }
    
}
