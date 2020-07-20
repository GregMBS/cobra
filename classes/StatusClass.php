<?php

namespace cobra_salsa;

use PDO;

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
    public function killProc($id)
    {
        $idi = (int)$id;
        $queryu = "KILL $idi";
        $this->pdo->query($queryu);
    }

    /**
     *
     * @return array
     */
    public function getProcesslist()
    {
        $query = "show processlist";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * @return array
     */
    public function getTables()
    {
        $query = "SELECT * FROM information_schema.`TABLES` T 
where table_schema = $this->dbName
order by data_length desc";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
}
