<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/ConfigClass.php';

class StatusClass extends ConfigClass
{
    /**
     *
     * @var PDO
     */
    protected $pdo;

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
        $query = "KILL $idi";
        $this->pdo->query($query);
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
        $stm = $this->pdo->prepare($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
}
