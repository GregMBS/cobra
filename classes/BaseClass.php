<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace gregmbs\cobra;

require_once 'config.php';

/**
 * Description of ActivarClass
 *
 * @author gmbs
 */
class BaseClass {

    /**
     * @var \PDO $pdo
     */
    protected $pdo;
    
    /**
     * @var \ConfigClass $config
     */
    public $config;
    
    /**
     * 
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->config = new \ConfigClass();
        $this->pdo = $pdo;
    }
}
