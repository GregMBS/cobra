<?php

namespace cobra_salsa;

use PDO;
use PDOStatement;

class StatusClass
{
    /**
     *
     * @var PDO
     */
    protected $pdo;
    
    /**
     *
     * @var string
     */
    private $dbName = 'cobraribemi';
        
    /**
     * 
     * @param PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    
    /**
     * 
     * @param int $id
     */
    public function killProc($id) {
        $idi = (int) $id;
        $queryu = "KILL $idi";
        $this->pdo->query($queryu);
    }

    /**
     *
     * @return false|PDOStatement
     */
    public function getProcesslist() {
       $querymain = "show processlist";
        return $this->pdo->query($querymain);
    }

    /**
     *
     * @return false|PDOStatement
     */
    public function getTables() {
        $querytab = "SELECT * FROM information_schema.`TABLES` T 
where table_schema = $this->dbName
order by data_length desc";
        return $this->pdo->query($querytab);
    }
}
