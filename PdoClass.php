<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PdoClass
 *
 * @author gmbs
 */
class PdoClass {

    private $dsn = 'mysql:dbname=cobra4;host=localhost';
    private $user = 'root';
    private $password = '4sale';

    function getDB() {
        try {
            $pdo = new PDO($this->dsn, $this->user, $this->password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $pdo;
    }

}
