<?php

namespace cobra_salsa;

class StatusClass
{
    /**
     *
     * @var \PDO
     */
    protected $pdo;
    
    /**
     *
     * @var string
     */
    private $dbName = 'cobra4';
        
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
     * @param int $id
     */
    public function killProc($id) {
        $idi = (int) $id;
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
