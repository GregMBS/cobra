<?php

namespace cobra_salsa;

use PDO;

require_once __DIR__ . '/ConfigObject.php';

/**
 * Description of BaseClass
 *
 * @author gmbs
 */
class BaseClass {

    /**
     * @var PDO $pdo
     */
    protected $pdo;
    
    /**
     * @var ConfigObject $config
     */
    public $config;
    
    /**
     * 
     * @param PDO $pdo
     */
    public function __construct($pdo) {
        $this->config = new ConfigObject();
        $this->pdo = $pdo;
    }
}
