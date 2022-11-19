<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/ConfigObject.php';

class StatusClass extends ConfigObject
{
    /**
     *
     * @var PDO
     */
    protected PDO $pdo;

    /**
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     *
     * @param int $id
     */
    public function killProc(int $id)
    {
        $query = "KILL $id";
        $this->pdo->query($query);
    }

    /**
     *
     * @return array
     */
    public function getProcesslist(): array
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
    public function getTables(): array
    {
        $query = "SELECT * FROM information_schema.`TABLES` T 
where table_schema = '$this->dbName'
order by data_length desc";
        $stm = $this->pdo->prepare($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
}
