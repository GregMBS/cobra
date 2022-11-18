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
    protected PDO $pdo;
    
    /**
     * @var ConfigObject $config
     */
    public ConfigObject $config;
    
    /**
     * 
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo) {
        $this->config = new ConfigObject();
        $this->pdo = $pdo;
    }
}
