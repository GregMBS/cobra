<?php

namespace gregmbs\cobra;

class StatusClass
{
    /**
     *
     * @var \PDO
     */
    protected $pdo;
    
    /**
     * 
     * @param \PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    
    /**
     * 
     * @param int $procid
     */
    public function killProc($procid) {
        $idi = (int) $procid;
        $queryu = "KILL $idi";
        $this->pdo->query($queryu);
    }
    
    /**
     * 
     * @return array
     */
    public function getProcesslist() {
       $querymain = "show processlist";
       $result = $this->pdo->query($querymain);
       return $result;
    }
    
    /**
     * 
     * @return array
     */
    public function getTables() {
        $querytab = "SELECT * FROM information_schema.`TABLES` T 
where table_schema = $this->dbName
order by data_length desc";
        $result = $this->pdo->query($querytab);
        return $result;
    }
}
